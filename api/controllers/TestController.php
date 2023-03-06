<?php

namespace api\controllers;

use api\models\User;
use yii\web\Controller;
use yii\web\Response;

class TestController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionSendFirebase($key = null){
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $auth = 'AAAAYILQ6Vg:APA91bHNoVObEFSo3FbxCIdfJSyDE8lsg-zeSJINZa_af8ecVL1ZrVX5iL4G9SF7Ez7odnBiqNdxYz_H78zgPDSEnVi-JfmbVhrxZGKNwTVD8SzdJt6pMt8CyLp8fK5esbRly82CTugB';
        if($key == null || $key == "")
            $key =\backend\models\User::findOne(2224)->token_mobile;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "notification": {
        "title": "Test message",
        "body": "Test message",
        "text": "Test message"
    },
    "to": "'.$key.'" 
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: key='.$auth
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
    public function actionCheck($auth = null,$key = null){

    }
}