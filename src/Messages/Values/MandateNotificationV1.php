<?php

namespace DVSA\CPMS\Notifications\Messages\Values;

use DateTime;
use DVSA\CPMS\Notifications\Exceptions\E4xx_CannotCreateMandateNotificationV1;

class MandateNotificationV1
{
    /**
     * name of the system which created this notification
     * @var string
     */
    private $origin;

    /**
     * unique ID of this notification
     * @var string
     */
    private $notificationId;

    /**
     * when does this message need to be acknowledged by?
     *
     * failure to acknowledge in time will result in retrying the message
     *
     * @var DateTime
     */
    private $acknowledgeBy;

    /**
     * which scheme is this notification for?
     * @var string
     */
    private $scheme;

    /**
     * which payment scope is this notification for?
     * @var string
     */
    private $scope;

    /**
     * what kind of event is this?
     * @var string
     */
    private $eventType;

    /**
     * what event caused this notification
     */
    private $eventCause;

    /**
     * when did this event happen?
     * @var DateTime
     */
    private $eventDate;

    /**
     * the ID for this mandate
     *
     * @var string
     */
    private $mandateReference;

    /**
     * the 'version' field from the underlying entity
     *
     * this is used to detect out-of-order delivery of notifications
     *
     * @var int
     */
    private $entityVersion;

    /**
     * create a new Payment Notification
     *
     * @param string   $origin
     *        the name of the system that generated this mandate notification
     * @param string   $notificationId
     *        the unique ID of this message
     * @param DateTime|string $acknowledgeBy
     *        the date/time when this message times out
     * @param string   $scheme
     *        the name of the scheme that this notification is for
     * @param string   $scope
     *        the name of the payment scope that this mandate is for
     * @param string   $eventType
     *        the type of event
     * @param string   $eventCause
     *        the cause of the event that triggered this notification
     * @param DateTime|string $eventDate
     *        the date/time when this event happened
     * @param string   $mandateReference
     *        the ID of the mandate that this applies to
     * @param int      $entityVersion
     *        the 'version' from the underlying Mandate entity
     */
    public function __construct(
        $origin,
        $notificationId,
        $acknowledgeBy,
        $scheme,
        $scope,
        $eventType,
        $eventCause,
        $eventDate,
        $mandateReference,
        $entityVersion
    ) {
        $this->origin = $origin;
        $this->notificationId = $notificationId;

        $this->ensureDateTime($acknowledgeBy, 'acknowledgeBy');
        if ($acknowledgeBy instanceof DateTime) {
            $this->acknowledgeBy = clone $acknowledgeBy;
        } else {
            $this->acknowledgeBy = new DateTime($acknowledgeBy);
        }

        $this->scheme = $scheme;
        $this->scope = $scope;
        $this->eventType = $eventType;
        $this->eventCause = $eventCause;

        $this->ensureDateTime($eventDate, 'eventDate');
        if ($eventDate instanceof DateTime) {
            $this->eventDate = $eventDate;
        } else {
            $this->eventDate = new DateTime($eventDate);
        }

        $this->mandateReference = $mandateReference;
        $this->entityVersion = $entityVersion;
    }

    /**
     * a check to make sure that a piece of data won't generate an error
     * when we use it as a DateTime field
     *
     * @param  mixed $data
     *         the data to check
     * @param  string $paramName
     *         the name of $data, to output in an exception message
     * @return void
     *
     * @throws E4xx_CannotCreateMandateNotificationV1
     *         if $data cannot be used as a DateTime field
     */
    private function ensureDateTime($data, $paramName)
    {
        // our most favourable case
        if ($data instanceof DateTime) {
            return;
        }

        // if it isn't a string, then we know we cannot use it as a DateTime
        if (!is_string($data)) {
            $msg = "illegal value for \${$paramName} parameter: " . var_export($data, true);
            throw new E4xx_CannotCreateMandateNotificationV1($msg);
        }

        // at this point, we have a string, but that does not mean it is a
        // valid DateTime value
        try {
            $temp = new DateTime($data);
        }
        catch (\Exception $e) {
            $msg = "illegal value for \${$paramName} parameter: " . var_export($data, true);
            throw E4xx_CannotCreateMandateNotificationV1::newFromException($e, $msg);
        }
    }

    /**
     * which system generated this message?
     *
     * mostly used for testing / debugging purposes
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * what is the unique ID of this message?
     *
     * NOTE that this ID is independent of any ID assigned by the underlying
     * queueing system
     *
     * you should treat notification IDs as opaque
     *
     * @return string
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }

    /**
     * when is the deadline to acknowledge this notification?
     *
     * @return DateTime
     */
    public function getAcknowledgeBy()
    {
        return clone $this->acknowledgeBy;
    }

    /**
     * which DVSA system is this message intended for?
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * which payment scope was the original payment attempted via?
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * what event is this notice telling you about?
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * what was the cause of the event that triggered this notification
     *
     * @return string
     */
    public function getEventCause()
    {
        return $this->eventCause;
    }

    /**
     * when did this event happen?
     *
     * NOTE that this isn't the date that CPMS received this event, but the
     * date provided by any payment gateway notification or digested report
     *
     * @return DateTime
     */
    public function getEventDate()
    {
        return clone $this->eventDate;
    }

    /**
     * what is the ID for this mandate?
     *
     * @return string
     */
    public function getMandateReference()
    {
        return $this->mandateReference;
    }

    /**
     * what is the 'version' of the Mandate entity?
     *
     * @return int
     */
    public function getEntityVersion()
    {
        return $this->entityVersion;
    }
}