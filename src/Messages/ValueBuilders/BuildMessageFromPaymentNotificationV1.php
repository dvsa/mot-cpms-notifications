<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Messages\Values\PaymentNotificationV1;
use DVSA\CPMS\Queues\Dates\Formatters\FormatDateTimeToUtcOffset;
use DVSA\CPMS\Queues\MultipartMessages\ValueBuilders\PayloadEncoderFactory;

class BuildMessageFromPaymentNotificationV1 implements PayloadEncoderFactory
{
    /**
     * create a multipart message from a PaymentNotificationV1 entity
     *
     * @param  PaymentNotificationV1 $entity
     *         the entity to turn into a multipart message
     * @return string
     *         the multipart message
     */
    public function __invoke(PaymentNotificationV1 $entity)
    {
        return self::from($entity);
    }

    /**
     * create a multipart message from a PaymentNotificationV1 entity
     *
     * @param  PaymentNotificationV1 $entity
     *         the entity to turn into a multipart message
     * @return string
     *         the multipart message
     */
    public static function from(PaymentNotificationV1 $entity)
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
            'receipt_reference' => $entity->getReceiptReference(),
            'amount' => $entity->getAmount(),
            'parent_reference' => $entity->getParentReference(),
            'entity_version' => $entity->getEntityVersion(),
        ];
        return "PAYMENT-NOTIFICATION-v1\n" . json_encode($payload);
    }
}