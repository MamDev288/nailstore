<?php

namespace api\services;

use api\models\User;

class AutoSendNotiFirebaseServices
{
    public static function checkChamCong(){
        if(CauHinhChamCongServices::getTypeChamCong() != null){
            $data = User::findAll(['status'=>10]);

        }
    }

}