# CHANGELOG

## develop branch

## 4.1.1 - Thu 7th April 2016

### Fixes

* Increase robustness of value builders
  - Added data input checks to `BuildMandateNotificationV1FromApiResponse`
  - Added data input checks to `BuildMandateNotificationV1FromPayload`
  - Added data input checks to `BuildPaymentNotificationV1FromApiResponse`
  - Added data input checks to `BuildPaymentNotificationV1FromPayload`

## 4.1.0 - Tue 5th April 2016

### New

* Added support for Middleware modules on queues
  * Bump minimum required version of `cpms/cpms-queues`

## 4.0.0 - Tue 29th March 2016

### New

* Added `entity_version` field to notifications
  * Added to `MandateNotificationV1`
  * Added to `PaymentNotificationV1`

## 3.0.1 - Wed 23rd March 2016

### Fixes

* Bump `ramsey/uuid` library to avoid notification ID collisions

## 3.0.0 - Thu 17th March 2016

This release breaks backwards-compatibility.

* Added support for different event causes and types per notification type
  - Added `PaymentNotificationV1EventCauses` class
  - Added `PaymentNotificationV1EventTypes` class
  - Added `MandateNotificationV1EventCauses` class
  - Added `MandateNotificationV1EventTypes` class
  - Dropped the `NotificationEventCauses` and `NotificationEventTypes` classes

## 2.5.0 - Wed 27th January 2016

### New

* Add support for connecting to Amazon SQS via a HTTP proxy
  * Use latest `cpms-queues` component

## 2.4.0 - Tue 19th January 2016

### New

* Add support for sending a Direct Debit payment's mandate reference in a payment notification
  * Added optional `parent_reference` and `getParentReference()` to `PaymentNotificationV1`
  * Updated `BuildMessageFromPaymentNotificationV1`, `BuildPaymentNotificationV1FromApiResponse` and `BuildPaymentNotificationV1FromPayload`

### Fixes

* Improve robustness of notification values
  * Ensure invalid dates are rejected by `MandateNotificationV1::__construct()`
  * Ensure invalid dates are rejected by `PaymentNotificationV1::__construct()`
  * Added `E4xx_CannotCreateMandateNotificationV1` exception
  * Added `E4xx_CannotCreatePaymentNotificationV1` exception
* Improve robustness of handling notifications received from the CPMS API
  * Added `E4xx_NoFactoryForApiResponse` exception
  * Added `E4xx_UnsupportedApiResponse` exception

## 2.3.1 - Wed 6th January 2016

* Updated composer.json to use AWS git repositories for dependencies

## 2.3.0 - Fri 18th December 2015

### New

* Added support for building notifications from data received from `cpms/payment-service`
  * Added `BuildMandateNotificationV1FromApiResponse`
  * Added `BuildNotificationFromApiResponse`
  * Added `BuildPaymentNotificationV1FromApiResponse`

## 2.2.0 - Tue 15th December 2015

### New

* Added new event causes for Mandate Notifications

## 2.1.0 - Mon 14th December 2015

### New

* Added MandateNotificationV1 support
  * `MandateNotificationV1` value object
  * `BuildMessageFromMandateNotificationV1` factory
  * `BuildMandateNotificationV1FromPayload` factory

## 2.0.0 - Tue 8th December 2015

### New

* Added `event_cause` field to `PaymentNotificationV1` object
* Added support for validating the `event_cause` field
  * Added `NotificationEventCauses` class

## 1.1.0 - Mon 7th December 2015

### New

* Added support for validating the `event_type` field
  * Added `NotificationEventTypes` class

## 1.0.0 - Wed 11th November 2015

### New

* Added `BuildAcknowledgementDeadlineDate` value builder
* Added `E5xx_CannotGenerateNotificationId` exception
* Added `GenerateNotificationId` value builder
  * Wraps `Ramsey\Uuid` library
* Added PaymentNotificationV1 support
  * `PaymentNotificationV1` value object
  * `BuildMessageFromPaymentNotificationV1` factory
  * `BuildPaymentNotificationV1FromPayload` factory
* Added `MapNotificationTypes` mapper
* Added '01-payment-notification-example.php' to show how to send and receive a PaymentNotificationV1 via a real Amazon SQS queue
