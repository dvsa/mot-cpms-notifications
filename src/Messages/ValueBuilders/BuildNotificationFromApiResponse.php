<?php

namespace DVSA\CPMS\Notifications\Messages\ValueBuilders;

use DVSA\CPMS\Notifications\Exceptions\E4xx_NoFactoryForApiResponse;
use DVSA\CPMS\Notifications\Exceptions\E4xx_UnsupportedApiResponse;
use DVSA\CPMS\Queues\MultipartMessages\ValueBuilders\PayloadDecoderFactory;

class BuildNotificationFromApiResponse implements PayloadDecoderFactory
{
    /**
     * builds a notification from the data returned by
     * the CPMS Notifications API
     *
     * @param  array $data
     *         the decoded data
     * @return object
     *         the populated entity
     */
    public function __invoke($data)
    {
        return self::from($data);
    }

    /**
     * builds a notification from the data returned by
     * the CPMS Notifications API
     *
     * @param  array $data
     *         the decoded data
     * @return object
     *         the populated entity
     */
    public static function from($data)
    {
        // make sure we have a notification_type
        if (!is_array($data)) {
            $msg = "bad API response; expected an array; received type '" . gettype($data) . "'";
            throw E4xx_UnsupportedApiResponse::newFromBadResponse($msg, $data);
        }
        if (!isset($data['notification_type'])) {
            $msg = "bad API response; missing field 'notification_type'";
            throw E4xx_UnsupportedApiResponse::newFromBadResponse($msg, $data);
        }

        // what type of notification are we building?
        $factoryName = __NAMESPACE__ . "\\Build" . $data['notification_type'] . "FromApiResponse";

        // does the factory exist?
        if (!class_exists($factoryName)) {
            $msg = "no factory '{$factoryName}' exists to process data of type '{$data['notification_type']}'";
            throw new E4xx_NoFactoryForApiResponse($msg);
        }

        // let's get this done
        $factory = new $factoryName;
        return $factory($data);
    }
}