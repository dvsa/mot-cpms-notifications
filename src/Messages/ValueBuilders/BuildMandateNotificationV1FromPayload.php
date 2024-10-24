<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xxCannotCreateMandateNotificationV1;
use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use DVSA\CPMS\Queues\MultipartMessages\ValueBuilders\PayloadDecoderFactory;
use stdClass;

class BuildMandateNotificationV1FromPayload implements PayloadDecoderFactory
{
    /**
     * builds a Mandate Notification V1 from a decoded JSON data block
     *
     * @param  stdClass $data
     *         the decoded data
     * @return MandateNotificationV1
     *         the populated entity
     */
    public function __invoke($data)
    {
        return self::from($data);
    }

    /**
     * builds a Mandate Notification V1 from a decoded JSON data block
     *
     * @param  stdClass $data
     *         the decoded data
     * @return MandateNotificationV1
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
            'mandate_reference',
            'entity_version',
        ];

        if (!is_object($data)) {
            throw E4xxCannotCreateMandateNotificationV1::newFromBadData("did not get PHP object to decode", $data);
        }

        foreach ($expectedFields as $expectedField) {
            if (!property_exists($data, $expectedField)) {
                throw E4xxCannotCreateMandateNotificationV1::newFromBadData("field '{$expectedField}' missing", $data);
            }
        }

        return new MandateNotificationV1(
            $data->origin,
            $data->notification_id,
            $data->acknowledge_by,
            $data->scheme,
            $data->scope,
            $data->event_type,
            $data->event_cause,
            $data->event_date,
            $data->mandate_reference,
            $data->entity_version
        );
    }
}
