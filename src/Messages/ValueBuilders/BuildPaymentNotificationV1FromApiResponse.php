<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xx_CannotCreatePaymentNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use DVSA\CPMS\Queues\MultipartMessages\ValueBuilders\PayloadDecoderFactory;
use stdClass;

class BuildPaymentNotificationV1FromApiResponse implements PayloadDecoderFactory
{
    /**
     * builds a Payment Notification from the data returned by
     * the CPMS Notifications API
     *
     * @param  array $data
     *         the decoded data
     * @return PaymentNotificationV1
     *         the populated entity
     */
    public function __invoke($data)
    {
        return self::from($data);
    }

    /**
     * builds a Payment Notification from the data returned by
     * the CPMS Notifications API
     *
     * @param  array $data
     *         the decoded data
     * @return PaymentNotificationV1
     *         the populated entity
     */
    public static function from($data)
    {
        static $expectedFields = [
            'origin',
            'notification_id',
            'acknowledge_due',
            'scheme',
            'scope',
            'event_type',
            'event_cause',
            'event_date',
            'receipt_reference',
            'amount',
            'parent_reference',
            'entity_version',
        ];

        if (!is_array($data)) {
            throw E4xx_CannotCreatePaymentNotificationV1::newFromBadData("did not get PHP array to decode", $data);
        }

        foreach ($expectedFields as $expectedField) {
            if (!array_key_exists($expectedField, $data)) {
                throw E4xx_CannotCreatePaymentNotificationV1::newFromBadData("field '{$expectedField}' missing", $data);
            }
        }

        return new PaymentNotificationV1(
            $data['origin'],
            $data['notification_id'],
            $data['acknowledge_due'],
            $data['scheme'],
            $data['scope'],
            $data['event_type'],
            $data['event_cause'],
            $data['event_date'],
            $data['receipt_reference'],
            $data['amount'],
            $data['parent_reference'],
            $data['entity_version']
        );
    }
}