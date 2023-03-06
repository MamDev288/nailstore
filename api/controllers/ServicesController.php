<?php

namespace api\controllers;

use api\models\ChamCong;
use api\models\OTPUser;
use api\models\QuanLyUser;
use api\models\TempSecret;
use api\models\User;
use api\models\UserVaiTro;
use api\models\Vaitrouser;
use api\services\ChamCongServices;
use backend\services\DanhMucService;
use backend\services\NghiPhepService;
use common\models\myAPI;
use yii\helpers\Html;
use yii\web\HttpException;

class ServicesController extends AndinCoreApiController
{
    public function actionGetTempSecret() {
        $tempSecret = str_replace(['_', '-'], 'a',\Yii::$app->security->generateRandomString(32)) ;
        $secret = new TempSecret();
        $secret->key = $tempSecret;
        $secret->expire = time() + 600;// Tạo private key hạn 10p
        if(!$secret->save()) {
            throw new HttpException(500, Html::errorSummary($secret));
        }
        return [
            'data' => $tempSecret
        ];
    }

    public function actionLogin() {
        $code = (isset($_POST['code'])?$_POST['code']:500);
        switch ($code){
            case 500 :
                $code = 500;
                break;
            case 401:
                $code = 401;
                break;
            default:
                $code = 500;
        }
        if($_POST['username'] == null || $_POST['password'] == null) {
            throw new HttpException($code, 'Tên đăng nhập hoặc mật khẩu không hợp lệ');
        }
        $user = User::findOne(['username' => $_POST['username']]);
        if($user == null) {
            throw new HttpException($code, 'Tên đăng nhập hoặc mật khẩu không hợp lệ');
        }
        if($user->status != 10) {
            throw new HttpException($code, "Tài khoản đã bị khóa");
        }
        if (!\Yii::$app->security->validatePassword($_POST['password'], $user->password_hash))
            throw new HttpException($code, 'Tên đăng nhập hoặc mật khẩu không hợp lệ');

        $user->updateAttributes(['auth_key' => 'AndinJSC_' . \Yii::$app->security->generateRandomString(18)]);
//        $user->updateAttributes(['secret_key' => str_replace(['_', '-'], 'a',\Yii::$app->security->generateRandomString(32))]);
        if(isset($_POST["token_mobile"])){
            if($_POST["token_mobile"] != "" && $_POST["token_mobile"] != null){
                $user->updateAttributes(["token_mobile"=>$_POST["token_mobile"]]);
            }
        }
        $user = UserVaiTro::find()->select(['id','username','hoten','ngay_sinh','email','dien_thoai','anh_nguoi_dung','secret_key','auth_key','trinh_do_id','ten_trinh_do','ngay_chinh_thuc','ten_phong_ban','truong_phong','phong_ban_id','ten_vai_tro','count_noti'])
            ->andFilterWhere(['id' => $user->id])->one();
        $user->ngay_sinh = myAPI::covertYMD2DMY($user->ngay_sinh);
        return [
            'message' => 'Đăng nhập thành công',
            'user' => $user
        ];
    }
    //Thiếu send email
    public function actionQuenMatKhau(){
        if(!isset($_POST['email']))
            $this->error500('Không tìm thấy tài khoản của bạn');
        if($_POST['email'] == "")
            $this->error500('Không tìm thấy tài khoản của bạn');
        $user = User::findOne(['email'=>$_POST['email'],'status'=>10]);
        if(is_null($user))
            $this->error500('Không tìm thấy tài khoản của bạn');
        if(is_null(OTPUser::find()->andFilterWhere(['user_id'=>$user->id,'is_used'=>1])->andFilterWhere(['>=','exp_otp',time()])->one())){
            if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                $this->error500('Email của bạn không có hoặc không đúng định dạng, vui lòng liên hệ quản trị viên hệ thống để được hỗ trợ');
            }
            $otp = new OTPUser();
            $otp->user_id = $user->id;
            if(!$otp->save())
                $this->error500(Html::errorSummary($otp));
            $email = explode('@',$user->email);
            $replace_email = substr($email[0],0,3).'****@'.$email[1];
            return [
                'message'=>'Đã gửi mã xác thực tới email '.$replace_email.'!'
            ];
        }
        return null;
    }

    public function actionCheckOtp(){
        if(!isset($_POST['email']))
            $this->error500('Email không đúng vui lòng thử lại!');
        if($_POST['email'] == "")
            $this->error500('Email không đúng vui lòng thử lại!');
        if(!isset($_POST['key_otp']))
            $this->error500('OTP không đúng vui lòng thử lại!');
        if($_POST['key_otp'] == "")
            $this->error500('OTP không đúng vui lòng thử lại!');
        $user_forget = User::findOne(['email'=>$_POST['email'],'status'=>10]);
        if(is_null($user_forget))
            $this->error500('Email không đúng vui lòng thử lại');
        $check_OTP = OTPUser::find()
            ->andFilterWhere(['user_id'=>$user_forget->id,'otp'=>$_POST['key_otp'],'is_used'=>0])->one();
        if(is_null($check_OTP))
            $this->error500('OTP không đúng vui lòng thử lại!');
        if(time() - $check_OTP->exp_otp > 120) {
            $this->error500('Mã OTP đã hết hạn');
        }
        $secet_key = \Yii::$app->security->generateRandomString(32);
        $check_OTP->updateAttributes([
            'is_used'=>1,
            'secret_key' => $secet_key,
            'exp_key' => time() + 60,
        ]);
        return [
            'key'=>$secet_key,
            'message' => ""
        ];

    }

    public function actionDoiPassOtp(){
        if(!isset($_POST['email']))
            $this->error500('Email không đúng vui lòng thử lại!');
        if($_POST['email'] == "")
            $this->error500('Email không đúng vui lòng thử lại!');
        if(!isset($_POST['new_pass']))
            $this->error500('Vui lòng điền mật khẩu mới');
        if(!$this->checkLeght($_POST['new_pass'],6,32))
            $this->error500('Mật khẩu phải có độ dài lớn hơn 6 và nhỏ hơn 32 kí tự');
        if(!isset($_POST['key_otp']))
            $this->error500('Thời gian đổi mật khẩu của bạn đã hết!');
        if($_POST['key_otp'] == "")
            $this->error500('Thời gian đổi mật khẩu của bạn đã hết!');
        $user_forget = User::findOne(['email'=>$_POST['email'],'status'=>10]);
        if(is_null($user_forget))
            $this->error500('Email không đúng vui lòng thử lại');
        $check_OTP = OTPUser::find()
            ->andFilterWhere(['user_id'=>$user_forget->id,'secret_key'=>$_POST['key_otp'],'is_used'=>1])
            ->one();
        if(is_null($check_OTP))
            $this->error500('Có lỗi sảy ra vui lòng thử lại!');
        if(time() - $check_OTP->exp_key > 60)
            $this->error500('Thời gian đổi mật khẩu của bạn đã hết!');
        $user_forget->updateAttributes(['password_hash'=>\Yii::$app->security->generatePasswordHash($_POST['new_pass'])]);
        $check_OTP->updateAttributes(['exp_key'=>0]);
        return ['message'=>'Đổi mật khẩu thành công!'];
    }

    public function actionLoadUser(){
        return [
            'info'=>QuanLyUser::findOne(['id'=>$_POST['uid']]),
            'setting' => (!is_null(ChamCongServices::getOldRecUser($_POST['uid'])) ? "TRUE" : "FASLE"),
            "timeNghiPhep" => NghiPhepService::CreateListTime(),
            "listLyDo"=>DanhMucService::getAllLyDoXinNghi(),
            "kieuDiMuonVeSom"=>NghiPhepService::CreateTypeOff(),
            "kieuDiMuonVeSomDacBiet"=>"Dài Ngày",
            "khoangThoiGianDiMuonVeSom"=>NghiPhepService::CreateMinutesSoonOrLate(),
            "getContentDiMuonVeSomOther"=>NghiPhepService::getContentDiMuonVeSomOther()
        ];
    }
    public function actionLoadUserNew(){
        return [
            'info'=>QuanLyUser::findOne(['id'=>$_POST['uid']]),
            'setting' => (!is_null(ChamCongServices::getOldRecUser($_POST['uid'])) ? "TRUE" : "FASLE"),
            "timeNghiPhep" => NghiPhepService::CreateListTime(),
            "listLyDo"=>DanhMucService::getAllLyDoXinNghi(),
            "kieuDiMuonVeSom"=>NghiPhepService::CreateTypeOff(),
            "kieuDiMuonVeSomDacBiet"=>"Dài Ngày",
            "khoangThoiGianDiMuonVeSom"=>NghiPhepService::CreateMinutesSoonOrLate(),
            "getContentDiMuonVeSomOther"=>NghiPhepService::getContentDiMuonVeSomOther(),
            "duLieuChamCong"=> ChamCongController::loadDataChamCong()
        ];
    }
    public function actionDangKi()
    {
        $User = new  User();
        $User->status = 1;
        $arrFildes = ['username','email','hoten', 'dien_thoai','password'];
        foreach ($arrFildes as $item){
            if(!isset($_POST[$item])){
                throw new HttpException(500,'Vui lòng nhập đầy đủ '.$User->getAttributeLabel($item));

            }
            else{
                if($_POST[$item] != ""){
                    $User->{$item} = $_POST[$item];
                }else
                    throw new HttpException(500,'Vui lòng nhập đầy đủ '.$User->getAttributeLabel($item));

            }
        }

        if($User->save()){
           $vaitro =  new Vaitrouser();
           $vaitro->user_id = $User->id;
           $vaitro->vaitro_id = User::USERNOVERIFY;
           if(!$vaitro->save()){
               throw new HttpException(500, Html::errorSummary($vaitro));
           }
        }else{
            throw new HttpException(500, Html::errorSummary($User));

        }
        return ['message'=>'Đăng kí tài khoản thành công!'];
    }
    public function actionDangXuat()
    {   if(isset($_POST['uid'])){
            $user = User::findOne($_POST['uid']);
            if(!is_null($user)){
                $user->updateAttributes(['auth_key'=>null,"token_mobile"=>null]);
            }
        }
       return ["message"=>"OK~"];
    }
    public function actionGetInfoPhone()
    {
        
    }
}