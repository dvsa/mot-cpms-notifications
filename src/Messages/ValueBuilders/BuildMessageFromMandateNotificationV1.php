<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Messages\Values\MandateNotificationV1;
use DVSA\CPMS\Queues\Dates\Formatters\FormatDateTimeToUtcOffset;
use DVSA\CPMS\Queues\MultipartMessages\ValueBuilders\PayloadEncoderFactory;

class BuildMessageFromMandateNotificationV1 implements PayloadEncoderFactory
{
    /**
     * create a multipart message from MandateNotificationV1 entity
     *
     * @param MandateNotificationV1 $entity
     *        the entity to turn into a multipart message
     *
     * @return string
     *         the multipart message
     */
    public function __invoke(MandateNotificationV1 $entity)
    {
        return self::from($entity);
    }

    /**
     * create a multipart message from MandateNotificationV1 entity
     *
     * @param MandateNotificationV1 $entity
     *        the entity to turn into a multipart message
     *
     * @return string
     *         the multipart message
     */
    public static function from(MandateNotificationV1 $entity)
    {
        $payload = [
            'origin' => $entity->getOrigin(),
            'notification_id' => $entity->getNotificationId(),
            'acknowledge_by' => FormatDateTimeToUtcOffset::from($entity->getAcknowledgeBy()),
            'scheme' => $entity->getScheme(),
            'scope' => $entity->getScope(),
            'event_type' => $entity->getEventType(),
            'event_cause' => $entity->getEventCause(),
            'event_date' => FormatDateTimeToUtcOffset::from($entity->getEventDate()),
            'mandate_reference' => $entity->getMandateReference(),
            'entity_version' => $entity->getEntityVersion(),
        ];

        return "MANDATE-NOTIFICATION-v1\n" . json_encode($payload);
    }
}
