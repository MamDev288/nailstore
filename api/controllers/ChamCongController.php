<?php

namespace api\controllers;

use api\models\ChamCong;
use api\DTOS\Request\ChamCongMobile;
use api\models\UserPhoneInfo;
use api\services\ChamCongServices;
use api\services\UserPhoneInfoServices;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class ChamCongController extends AndinCoreApiController
{
    public function actionGetChamCong()
    {
        $nam = date('Y');
        $thang = date('m');
        if (isset($_POST['thang'])) {
            if (is_numeric($_POST['thang']) && $_POST['thang'] != "")
                $thang = $_POST['thang'];

        }
        if (isset($_POST['nam'])) {
            if (is_numeric($_POST['nam']) && $_POST['nam'] != "")
                $nam = $_POST['nam'];
        }
        $data_cham_cong = ChamCong::find()
            ->andFilterWhere(['month(date)' => $thang, 'year(date)' => $nam])
            ->andFilterWhere(['nhan_vien_id' => $_POST['uid']])
            ->orderBy(['date(date)' => SORT_ASC])
            ->all();
        $data = null;
        foreach ($data_cham_cong as $item) {
            /**
             * @var $item ChamCong
             */
            $data[$item->date]['check_in_morning'] = $this->datetime2Hi($item->vao1);
            $data[$item->date]['check_out_morning'] = $this->datetime2Hi($item->ra1);
            $data[$item->date]['check_in_afternoon'] = $this->datetime2Hi($item->vao2);
            $data[$item->date]['check_out_afternoon'] = $this->datetime2Hi($item->ra2);
            $data[$item->date]['type'] = $item->trang_thai;
            $data[$item->date]['note'] = $item->ghi_chu;
        }
        return ['data' => $data];
    }

    public function actionChamCong()
    {
        $iP = \Yii::$app->request->getRemoteIP();
//        VarDumper::dump($iP);exit();
        $type = $_POST['type'];
        if ($type == ChamCong::DIEN_THOAI) {
            $uniIdPhone = $_POST['uniIdPhone'];
        }

        $saveChamCong = ChamCongServices::ChamCong($uniIdPhone ?? '', $_POST["uid"], $iP, $type);
        if ($saveChamCong != "") {
            throw new HttpException(500, $saveChamCong);
        } else {
            return ["message" => "Chấm công thành công!", "data" => ChamCongServices::formatTime(ChamCongServices::getDataChamCongNow($_POST["uid"]))];
        }
    }

    public function actionSetInfoPhone()
    {

        $uniIdPhone = $_POST['uniIdPhone'];
        $phoneName = (isset($_POST['phoneName']) ? $_POST['phoneName'] : "UNKNOW");
        $userId = $_POST["uid"];
        $data = UserPhoneInfoServices::SetNewPhone($uniIdPhone, $userId,$phoneName);
        if ($data == null) {
            throw new HttpException(500, "Không lưu được thiết bị vui lòng kiểm tra lại!");
        }
        return ["message" => "Cập nhật thiết bị thành công!", "data" => $data];
    }

    public function actionLoadChamCong()
    {
        return self::loadDataChamCong();
    }
    public static function loadDataChamCong(){
//        if (is_null(ChamCongServices::getOldRecUser($_POST["uid"]))) {
//            throw new HttpException(500, "Bạn chưa có thông tin thiết bị chấm công trên hệ thống");
//        }
        ChamCongServices::checkNgayNghi();
        $userId = $_POST["uid"];
        $data = ChamCongServices::getDataChamCongNow($userId);
        return [
            "typeChamCong" => ChamCongServices::getStatusCheck($data),
            "dataChamCong" => ChamCongServices::formatTime($data),
            "timeNow" => date("H:i"),
            "dateNow" => date("d/m/Y")
        ];
    }
    public function actionGetTime(){
        return [
            "timeNow"=>date("H:i"),
            "dateNow"=>date("d/m/Y")
        ];
    }
    public function actionXoaThietBi(){

        if(UserPhoneInfoServices::deletePhoneUniId(0,$_POST['uid']))
            return ["message"=>"Xoá thiết bị thành công"];
        else
            throw new HttpException(500,"Tài khoản của bạn chưa thể xoá thiết bị");
    }
    public function actionGetThietBi(){
        return UserPhoneInfoServices::CheckInfoPhone($_POST['uniIdPhone']);
    }
}