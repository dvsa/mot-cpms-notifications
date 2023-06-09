<?php

require_once "vendor/autoload.php";

use DVSA\CPMS\Queues\QueueAdapters\AmazonSqs\AmazonSqsQueues;

use DVSA\CPMS\Notifications\Messages\Maps\MapNotificationTypes;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use DVSA\CPMS\Notifications\Ids\ValueBuilders\GenerateNotificationId;

// ==================================================================
//
// Putting it all together
//
// ------------------------------------------------------------------

$queueUrl = "https://sqs.us-west-2.amazonaws.com/600499240829/SH_Test01";

$config = [
    "region" => "us-west-2",
    "queues" => [
        "notifications" => [
            "QueueUrl" => $queueUrl,
            "Middleware" => [
                "MultipartMessage" => [
                    "mapper" => MapNotificationTypes::class,
                ]
            ]
        ],
    ],
	"http" => [
		"proxy" => "http://payment-service.cpmsdev:3128"
	]
];

$queues = new AmazonSqsQueues($config);

for ($seqNo = 0; $seqNo < 10; $seqNo++) {
    $deadline = new DateTime();
    $deadline->add(new DateInterval('PT30M'));
    $entity = new PaymentNotificationV1(
        __FILE__,
        GenerateNotificationId::now(),
        $deadline,
        "TEST SCHEME",
        "TEST SCOPE",
        "example",
        "confirmed",
        new DateTime(),
        "TEST-12345-67890",
        3.1415927,
        null,
        1
    );
    $queues->writeMessageToQueue("notifications", $entity);
}

do {
    $qMessages = $queues->receiveMessagesFromQueue("notifications");
    foreach ($qMessages as $qMessage) {
        var_dump($qMessage->getPayload());
        $queues->confirmMessageHandled($qMessage);
    }
}
while (!empty($qMessages));