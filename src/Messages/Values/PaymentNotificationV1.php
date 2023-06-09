<?php

namespace DVSA\CPMS\Notifications\Messages\Values;

use DateTime;
use DVSA\CPMS\Notifications\Exceptions\E4xx_CannotCreatePaymentNotificationV1;

class PaymentNotificationV1
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
     * the ID for this payment
     * @var string
     */
    private $receiptReference;

    /**
     * the value of this payment or refund, in pounds
     * @var float
     */
    private $amount;

    /**
     * is this payment linked to something else (for example, a direct debit
     * mandate?)
     *
     * if so, this property will contain the parent reference
     *
     * @var string
     */
    private $parentReference;

    /**
     * the Payment entity's 'version' field at the time this notification
     * was raised
     *
     * this can be used to detect out-of-order delivery of notifications
     *
     * @var int
     */
    private $entityVersion;

    /**
     * create a new Payment Notification
     *
     * @param string   $origin
     *        the name of the system that generated this payment notification
     * @param string   $notificationId
     *        the unique ID of this message
     * @param DateTime|string $acknowledgeBy
     *        the date/time when this message times out
     * @param string   $scheme
     *        the name of the scheme that this notification is for
     * @param string   $scope
     *        the name of the payment scope that this payment is for
     * @param string   $eventType
     *        the type of event
     * @param string   $eventCause
     *        the cause of the event that triggered this notification
     * @param DateTime|string $eventDate
     *        the date/time when this event happened
     * @param string   $receiptReference
     *        the ID of the payment that this applies to
     * @param float    $amount
     * @param string|null $parentReference
     *        the ID of what this payment is linked to (e.g. a mandate_reference)
     * @param int $entityVersion
     *        the 'version' field from the underlying Payment entity
     */
    public function __construct($origin, $notificationId, $acknowledgeBy, $scheme, $scope, $eventType, $eventCause, $eventDate, $receiptReference, $amount, $parentReference = null, $entityVersion = null)
    {
        $this->origin = $origin;
        $this->notificationId = $notificationId;

        $this->ensureDateTime($acknowledgeBy, 'acknowledgeBy');
        if ($acknowledgeBy instanceof DateTime) {
            $this->acknowledgeBy = clone $acknowledgeBy;
        }
        else {
            $this->acknowledgeBy = new DateTime($acknowledgeBy);
        }

        $this->scheme = $scheme;
        $this->scope  = $scope;
        $this->eventType = $eventType;
        $this->eventCause = $eventCause;

        $this->ensureDateTime($eventDate, 'eventDate');
        if ($eventDate instanceof DateTime) {
            $this->eventDate = $eventDate;
        }
        else {
            $this->eventDate = new DateTime($eventDate);
        }

        $this->receiptReference = $receiptReference;
        $this->amount = $amount;

        $this->parentReference = $parentReference;
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
            throw new E4xx_CannotCreatePaymentNotificationV1($msg);
        }

        // at this point, we have a string, but that does not mean it is a
        // valid DateTime value
        try {
            $temp = new DateTime($data);
        }
        catch (\Exception $e) {
            $msg = "illegal value for \${$paramName} parameter: " . var_export($data, true);
            throw E4xx_CannotCreatePaymentNotificationV1::newFromException($e, $msg);
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
     * what is the ID for this payment?
     *
     * @return string
     */
    public function getReceiptReference()
    {
        return $this->receiptReference;
    }

    /**
     * what is the monetary value of this event?
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * is this payment linked to something else (e.g. a mandate_reference)?
     * if so, this is the ID of the parent entity
     *
     * @return string|null
     */
    public function getParentReference()
    {
        return $this->parentReference;
    }

    /**
     * what was the value of the Payment's 'version' field when this
     * notification was raised?
     *
     * @return int
     */
    public function getEntityVersion()
    {
        return $this->entityVersion;
    }
}