<?php

namespace DVSA\CPMS\Notifications\Messages\Maps;

use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMandateNotificationV1FromPayload;
use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildPaymentNotificationV1FromPayload;
use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMessageFromMandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\ValueBuilders\BuildMessageFromPaymentNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use DVSA\CPMS\Queues\MultipartMessages\Maps\MultipartMessageMapper;

/**
 * maps between notification messages and their factories
 */
class MapNotificationTypes extends MultipartMessageMapper
{
    /**
     * a list of which factory to use for which message type
     *
     * @var array
     */
    protected $messageTypes = [
        "MANDATE-NOTIFICATION-v1" => BuildMandateNotificationV1FromPayload::class,
        "PAYMENT-NOTIFICATION-v1" => BuildPaymentNotificationV1FromPayload::class,
    ];

    /**
     * a list of which factory to use for which entity
     *
     * @var array
     */
    protected $entities = [
        MandateNotificationV1::class => BuildMessageFromMandateNotificationV1::class,
        PaymentNotificationV1::class => BuildMessageFromPaymentNotificationV1::class,
    ];
}