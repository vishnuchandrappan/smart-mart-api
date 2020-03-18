<?php

namespace App\Traits;

use App\Http\Responses\ErrorResponse;
use Twilio\Rest\Client;

trait OtpTrait
{
    public function send($phone, $message, $otp)
    {
        $sid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $token = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $number = config('app.twilio')['TWILIO_NUMBER'];

        $client = new Client($sid, $token);
        try{
            $client->messages->create(
                $phone,
                array(
                    'from' => $number,
                    'body' => $message." : ".$otp
                )
                );
        }
        catch(\Exception $e){
            return new ErrorResponse('OTP could not be sent',500);
        }
    }
}