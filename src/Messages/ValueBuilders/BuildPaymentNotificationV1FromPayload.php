<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xxCannotCreatePaymentNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use DVSA\CPMS\Queues\MultipartMessages\ValueBuilders\PayloadDecoderFactory;
use stdClass;

class BuildPaymentNotificationV1FromPayload implements PayloadDecoderFactory
{
    /**
     * builds a Payment Notification from a decoded JSON data block
     *
     * @param  stdClass $data
     *         the decoded data
     * @return PaymentNotificationV1
     *         the populated entity
     */
    public function __invoke($data)
    {
        return self::from($data);
    }

    /**
     * builds a Payment Notification from a decoded JSON data block
     *
     * @param  stdClass $data
     *         the decoded data
     * @return PaymentNotificationV1
     *         the populated entity
     */
    public static function from($data)
    {
        static $expectedFields = [
            'origin',
            'notification_id',
            'acknowledge_by',
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

        if (!is_object($data)) {
            throw E4xxCannotCreatePaymentNotificationV1::newFromBadData("did not get PHP object to decode", $data);
        }

        foreach ($expectedFields as $expectedField) {
            if (!property_exists($data, $expectedField)) {
                throw E4xxCannotCreatePaymentNotificationV1::newFromBadData("field '{$expectedField}' missing", $data);
            }
        }

        return new PaymentNotificationV1(
            $data->origin,
            $data->notification_id,
            $data->acknowledge_by,
            $data->scheme,
            $data->scope,
            $data->event_type,
            $data->event_cause,
            $data->event_date,
            $data->receipt_reference,
            $data->amount,
            $data->parent_reference,
            $data->entity_version
        );
    }
}
