<?php

namespace api\services;

use api\models\ThongBao;

class FirebaseServices
{
    public const SEND_TO_ALL_USER = "/topics/all";
    public const API_FCM = "https://fcm.googleapis.com/fcm/send";
    public static function senDataRealTime($toUser,$token,$message){
        $header = self::genHeader($token);
        $tokens = "";
        if(is_array($toUser))
            $tokens = array_map(function ($user){
                return $user->token_mobile ?? null;
            },$toUser);
        else
            $tokens = $toUser->token_mobile;
//        var_dump($tokens);
        $dataSend = self::genDataRealTimeSend($message,$tokens);
        return self::sendFCM($dataSend,$header);
    }
    public static function sendToOneUser($toUser,$token,$title,$body,$uid, $className = null, $objectId = null){
        $header = self::genHeader($token);
        $notification =self::createNotificationContent($title,$body);
        $tokens = "";
        if(!is_null($toUser)){
            if(is_array($toUser))
                $tokens = array_map(function ($user){
                    return $user->token_mobile ?? null;
                },$toUser);
            else
                $tokens = $toUser->token_mobile;
//        var_dump($tokens);
            $dataSend = self::genDataSend($notification,$tokens);
            $noti = new ThongBao();
            $noti->noi_dung = $body;
            $noti->title = $title;
            $noti->class_name = $className;
            $noti->object_id = $objectId;
            if(is_array($toUser)){
                foreach ($toUser as $user){
                    $noti->user_id = $user->id;
                    $noti->isNewRecord = true;
                    $noti->id = null;
                    $noti->user_created = $uid;
                    $noti->save();
                }
            }else{
                $noti->user_id = $toUser->id;
                $noti->user_created = $uid;
                $noti->save();
            }
            return self::sendFCM($dataSend,$header);
        }
        return false;
    }
    public static function genHeader($token){
        return  [
            "Content-Type:application/json",
            "Authorization:key=".$token
        ];
    }
    public static function genDataRealTimeSend($message,$toUser){
        if(is_array($toUser)){
            return [
                "data" => $message,
                "registration_ids" => $toUser
            ];
        }
        return  [
            "data" => $message,
            "to" => $toUser == null  ? self::SEND_TO_ALL_USER : $toUser
        ];
    }
    public static function genDataSend($notification,$toUser){
        if(is_array($toUser)){
            return [
                "notification" => $notification,
                "registration_ids" => $toUser
            ];
        }
        return  [
            "notification" => $notification,
            "to" => $toUser == null  ? self::SEND_TO_ALL_USER : $toUser
        ];
    }
    public static function createNotificationContent($title,$body){
        return  [
            "title"=> $title,
            "body"=> $body,
        ];
    }
    public static function sendFCM($dataSend,$header){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::API_FCM,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataSend),
            CURLOPT_HTTPHEADER => $header
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

}