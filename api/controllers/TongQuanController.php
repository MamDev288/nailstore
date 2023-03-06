<?php

namespace api\controllers;

use api\models\ChamCong;
use api\models\User;
use function GuzzleHttp\Promise\all;

class TongQuanController extends AndinCoreApiController
{
    public function actionGetData(){
        $tongNhanVienCongTy = count(User::findAll(['status'=>10]));
        $quenCheckinCongTy = ChamCong::findAll(['trang_thai'=>'Quên checkin, checkout','date'=>date('Y-m-d')]);
        $diMuonVeSomCongTy = ChamCong::findAll(['trang_thai'=>'Đi muộn, về sớm','date'=>date('Y-m-d')]);

        $diMuonVeSomCaNhan = ChamCong::find()->andFilterWhere(['trang_thai'=>'Đi muộn, về sớm','nhan_vien_id'=>$_POST['uid'],'month(date)'=>date('m'),'year(date)'=>date('Y')])->all();
        $diQuenCheckCaNhan = ChamCong::find()->andFilterWhere(['trang_thai'=>'Quên checkin, checkout','nhan_vien_id'=>$_POST['uid'],'month(date)'=>date('m'),'year(date)'=>date('Y')])->all();
        $timecheck = ChamCong::findOne(['nhan_vien_id'=>$_POST['uid'],'date'=>date('Y-m-d')]);
        if(is_null($timecheck)){
            $timecheck = new ChamCong();
            $timecheck->date = date('Y-m-d');
            $timecheck->nhan_vien_id = $_POST['uid'];
            $timecheck->save();
        }
        $timecheck->ra1 = (($timecheck->ra1)==null?null:date('H:i',strtotime($timecheck->ra1)));
        $timecheck->ra2 = (($timecheck->ra2)==null?null:date('H:i',strtotime($timecheck->ra2)));
        $timecheck->vao1 = (($timecheck->vao1)==null?null:date('H:i',strtotime($timecheck->vao1)));
        $timecheck->vao2 = (($timecheck->vao2)==null?null:date('H:i',strtotime($timecheck->vao2)));
        $countTimeLate = 0;
        $checkInCountCongTy = 0;
        $checkOutCountCongTy = 0;
        $checkInCount = 0;
        $checkOutCount = 0;
        //region Giờ chuẩn
        foreach ($diMuonVeSomCongTy as $item){
            if($item->vao1){
                $checkInCountCongTy++;
            }
            if($item->vao2){
                $checkInCountCongTy++;
            }
            if($item->ra1){
                $checkOutCountCongTy++;
            }
            if($item->ra2){
                $checkOutCountCongTy++;
            }
        }
        foreach ($diQuenCheckCaNhan as $item){
            if($item->vao1){
                $checkOutCount++;
            }
            if($item->vao2){
                $checkOutCount++;
            }
            if($item->ra1){
                $checkInCount++;
            }
            if($item->ra2){
                $checkInCount++;
            }
        }
        foreach ($diMuonVeSomCaNhan as $item){
            $timeVaoChuan1 = strtotime(date($item->date.' 08:00:59'));
            $timeRaChuan1 = strtotime(date($item->date.' 11:45:00'));
            $timeVaoChuan2 = strtotime(date($item->date.' 13:00:59'));
            $timeRaChuan2 = strtotime(date($item->date.' 15:30:00'));
            $vaoMuon1 = strtotime($item->vao1)-$timeVaoChuan1;
            $raSom1 = $timeRaChuan1 - strtotime($item->ra1);
            $vaoMuon2 = strtotime($item->vao2)-$timeVaoChuan2;
            $raSom2 = $timeRaChuan2 - strtotime($item->ra2);
            if($vaoMuon1 > 0){
                $countTimeLate+= intval($vaoMuon1/60);
            }
            if($raSom1 > 0){
                $countTimeLate+= intval($raSom1/60);
            }
            if($vaoMuon2 > 0){
                $countTimeLate+= intval($vaoMuon2/60);
            }
            if($raSom2 > 0){
                $countTimeLate+= intval($raSom2/60);
            }
        }
        //endregion Giờ chuẩn
        return [
            'pacific'=>[
                'tong_nhan_vien'=>$tongNhanVienCongTy,
                'xin_nghi'=>0,
                'quen_check'=>count($quenCheckinCongTy),
                'quen_checkin'=>$checkInCountCongTy,
                'quen_checkout'=>$checkOutCountCongTy,
                'di_muon_ve_som'=>count($diMuonVeSomCongTy),
            ],
            'ca_nhan'=>[
                'in_month'=>[
                    'xin_nghi'=>0,
                    'so_phut_di_muon'=>$countTimeLate,
                    'quen_checkin'=>$checkInCount,
                    'quen_checkout'=>$checkOutCount
                ],
                'today'=>$timecheck,
            ]
        ];
    }

}