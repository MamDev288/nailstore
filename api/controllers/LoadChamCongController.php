<?php

namespace api\controllers;

use api\models\ChamCong;
use api\models\QuanLyChamCongTheoNgay;
use api\models\User;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;

class LoadChamCongController extends Controller
{
    public function actionSaveData(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        require dirname(dirname(dirname(__FILE__))).'/zklib/zklib.php';
        $zk = new ZKLib("192.168.1.201", 4370);
        $ret = $zk->connect();
//        $zk->setTime(time());
//        $seri = $zk->serialNumber();
        $data = $zk->getAttendance();
//        VarDumper::dump($data,10,true);
//        exit();
        foreach ($data as $item){
            $user = User::findOne(['uid_may_cham_cong'=>$item[1],'status'=>10]);
//            print_r($user);
            if(is_null($user) ||$user->uid_may_cham_cong != $item[1])
                continue;
            $dateRec = date('Y-m-d',strtotime($item[3]));
            $lastRec = null;
            $lastRecView = QuanLyChamCongTheoNgay::findOne(['uid_may_cham_cong'=>$item[1],'date'=>$dateRec]);
            if(is_null($lastRecView)){
                $lastRec = new ChamCong();
                $lastRec->date = $dateRec;
                $lastRec->nhan_vien_id = $user->id;
                if($lastRec->save()){
                    $lastRecView = QuanLyChamCongTheoNgay::findOne(['uid_may_cham_cong'=>$item[1]]);
                }else{
                    continue;
                }
            }else{
                $lastRec = ChamCong::findOne($lastRecView->id);
            }

            $hour = date('H',strtotime($item[3]));
            switch ($hour){
                case $hour >= 8  && $hour < 13:
                    if(($lastRecView->vao1 == null) && $hour < 10){
                        $lastRec->updateAttributes(['vao1'=>$item[3]]);
                    }elseif (($lastRecView->ra1 == null ) && $hour >10){
                        $lastRec->updateAttributes(['ra1'=>$item[3]]);
                    }
                    break;
                case $hour > 12 && $hour < 18 :
                    if(($lastRecView->vao2 == null) && $hour < 15){
                        $lastRec->updateAttributes(['vao2'=>$item[3]]);
                    }elseif (($lastRecView->ra2 == null) && $hour >=15){
                        $lastRec->updateAttributes(['ra2'=>$item[3]]);
                    }
                    break;
                default:
                    break;
            }
        }
                VarDumper::dump(QuanLyChamCongTheoNgay::find()->orderBy(['id'=>SORT_DESC])->all(),20    ,true);
exit();
//        return QuanLyChamCongTheoNgay::find()->orderBy(['id'=>SORT_DESC])->all();
//        echo count($data);
    }


}