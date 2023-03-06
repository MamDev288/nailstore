<?php

namespace api\controllers;

use api\models\BangLuong;
use api\models\ChamCongThangNguoiDung;
use api\models\HopDongNhanSu;
use api\models\ThayDoiLuong;
use api\models\User;

class BangLuongController extends AndinCoreApiController
{
    public function actionDuLieuBangLuong(){
        $month = date('m');
        $year = date('Y');
        if(!$this->checkNull('month')){
            $month = $_POST['month'];
        }
        if(!$this->checkNull('year')){
            $year = $_POST['year'];
        }
        $user = User::findOne([$_POST['uid'],'active'=>1]);
        $du_lieu_cham_cong = ChamCongThangNguoiDung::find()->andFilterWhere(['thang'=>$month,'year'=>$year,'nhan_vien_id'=>$_POST['uid']])->one();
        $hopdong = HopDongNhanSu::findOne(['nhan_vien_id'=>$user->id,'active'=>1]);
        $luong_co_ban = $hopdong->getThayDoiLuongs()->andFilterWhere(['active'=>1])->limit(1)->orderBy(['created'=>SORT_DESC])->one();
        /**
         * @var ThayDoiLuong $luong_co_ban
         */
        $bang_luong = BangLuong::find()->andFilterWhere(['thang'=>$month,'year'=>$year,'active'=>1])->one();
        return [
            'cong_chuan'=>23.5,
            'thuc_te'=>$du_lieu_cham_cong->so_ngay_den_du,
            '' => $du_lieu_cham_cong->so_ngay_den_du,

        ];
    }

}