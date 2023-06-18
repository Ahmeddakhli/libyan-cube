<?php

/**
 * FCM Notification Class
 *
 * @author Mohamed Alansary
 */
namespace App\Http\Helpers;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FCMNotification
{
    public static function sendPushNotification($token, $message, $appended_data) {
        // Appending body and title to data
        $appended_data['body'] = $message;
        $appended_data['title'] = 'CRM';

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('CRM');
        $notificationBuilder->setBody($message)
                            ->setSound('default')
                            ->setClickAction('OPEN_ACTIVITY_1');

        $dataBuilder = new PayloadDataBuilder();
        foreach ($appended_data as $key => $value) {
            $dataBuilder->addData([$key => $value]);
        }

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = $token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $numberSuccess = $downstreamResponse->numberSuccess();
        $numberFailure = $downstreamResponse->numberFailure();
        $numberModification = $downstreamResponse->numberModification();

        //return Array - you must remove all this tokens in your database
        $tokensToDelete = $downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $tokensToModify = $downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        $tokensToRetry = $downstreamResponse->tokensToRetry();
        return ['numberSuccess' => $numberSuccess, 'numberFailure' => $numberFailure, 'numberModification' => $numberModification, 'tokensToDelete' => $tokensToDelete, 'tokensToModify' => $tokensToModify, 'tokensToRetry' => $tokensToRetry];
    }
}