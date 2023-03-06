<?php

namespace api\controllers;

use api\models\BaoHiemNhanSu;
use api\models\ChiTietPhuCap;
use api\models\HopDongNhanSu;
use api\models\LichSuCongTac;
use api\models\MoiQuanHe;
use api\models\PhongBanNhanVien;
use api\models\QuanLyChiTietBaoHiemNhanSu;
use api\models\QuanLyHopDongNhanSu;
use api\models\QuanLyThongTin;
use api\models\User;
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;

class TaiKhoanController extends AndinCoreApiController
{
    public function actionChiTiet(){

    }

    public static function get_extension_image($imagetype)
    {
        if (empty($imagetype)) {
            return false;
        }

        switch ($imagetype) {
            case 'image/bmp':return '.bmp';
            case 'image/cis-cod':return '.cod';
            case 'image/gif':return '.gif';
            case 'image/ief':return '.ief';
            case 'image/jpeg':return '.jpg';
            case 'image/pipeg':return '.jfif';
            case 'image/tiff':return '.tif';
            case 'image/x-cmu-raster':return '.ras';
            case 'image/x-cmx':return '.cmx';
            case 'image/x-icon':return '.ico';
            case 'image/x-portable-anymap':return '.pnm';
            case 'image/x-portable-bitmap':return '.pbm';
            case 'image/x-portable-graymap':return '.pgm';
            case 'image/x-portable-pixmap':return '.ppm';
            case 'image/x-rgb':return '.rgb';
            case 'image/x-xbitmap':return '.xbm';
            case 'image/x-xpixmap':return '.xpm';
            case 'image/x-xwindowdump':return '.xwd';
            case 'image/png':return '.png';
            case 'image/x-jps':return '.jps';
            case 'image/x-freehand':return '.fh';
            default:return false;
        }
    }

    public function actionDoiThongTinCaNhan(){
        if(!$this->checkNull('hoten'))
        {
            $this->error500('Vui lòng điền họ và tên');
        }
        $hoten = ($_POST['hoten']);
        $user = User::findOne($_POST['uid']);
        $user->updateAttributes(['hoten'=>$hoten]);
        if($this->checkNull('email'))
        {
            $user->updateAttributes(['email'=>$_POST['email']]);
        }
//        $file = UploadedFile::getInstance([$])
        if($this->checkNull('base64_avatar') && $_POST['base64_avatar'] != ""){

                $image = base64_decode(str_replace('PLUSICON', '+', str_replace('RIGHTDASH', '/', $_POST['base64_avatar'])));
                $link = '/images/'.rand(1,time())*time().'.'.$_POST['extension'];
                $user->updateAttributes(['anh_nguoi_dung'=>$link]);
                file_put_contents(\Yii::getAlias('@root').$link, $image);

        }
        return [
            'message'=>'Lưu thành đổi thành công',
            'data'=>['hoten'=>$user->hoten,
                'anh_nguoi_dung'=>$user->anh_nguoi_dung,
                'email'=>$user->email,]
        ];

    }

    public function actionDoiMatKhau(){
        if(!$this->checkNull('old_pass'))
        {
            $this->error500('Vui lòng điền mật khẩu mới');
        }
        if(!$this->checkNull('new_pass'))
        {
            $this->error500('Vui lòng điền mật khẩu mới');
        }
        if(!$this->checkLeght($_POST['new_pass'],6,32)){
            $this->error500('Mật khẩu phải có độ dài từ 6 đến 32 kí tự');
        }
        $user = User::findOne($_POST['uid']);
        if(!\Yii::$app->security->validatePassword($_POST['old_pass'],$user->password_hash))
        {
            throw new HttpException(500,'Mật khẩu cũ của bạn không đúng, vui lòng kiểm tra lại');
        }
        if($_POST['old_pass'] != $_POST['new_pass']){
            $user->updateAttributes(['password_hash'=>\Yii::$app->security->generatePasswordHash($_POST['new_pass'])
            ]);
        }
        return ['message'=>'Đổi mật khẩu thành công'];

    }

    public function actionVoHieuHoa(){
        User::findOne($_POST['uid'])->updateAttributes(['status'=>0]);
        return [
            'message'=>'Vô hiệu hoá tài khoản thành công'
        ];
    }

    public function actionThongTinCaNhan(){
        $user = QuanLyThongTin::findOne(['id'=>$_POST['uid']]);
        $moi_quan_he = MoiQuanHe::findAll(['nhan_su_id'=>$_POST['uid'],'active'=>1]);
        $lich_su = LichSuCongTac::findAll(['user_id'=>$_POST['uid'],'active'=>1]);
//        $bao_hiem = QuanLyChiTietBaoHiemNhanSu::findAll(['nhan_vien_id'=>$_POST['uid']]);
        return [
            'data'=>$user,
            'moi_quan_he'=>$moi_quan_he,
            'lich_su_cong_tac'=>$lich_su,
//            'bao_hiem'=>$bao_hiem,

        ];
    }
    public function actionGetBaoHiem(){
//        $user = QuanLyThongTin::findOne(['id'=>$_POST['uid']]);
//        $moi_quan_he = MoiQuanHe::findAll(['nhan_su_id'=>$_POST['uid'],'active'=>1]);
//        $lich_su = LichSuCongTac::findAll(['user_id'=>$_POST['uid'],'active'=>1]);
        $bao_hiem = QuanLyChiTietBaoHiemNhanSu::findAll(['nhan_vien_id'=>$_POST['uid']]);
        foreach ($bao_hiem as $item){
            if($item->so_tien_dong == null)
                $item->so_tien_dong  = "0";
            else
                $item->so_tien_dong = "$item->so_tien_dong";
            if($item->doanh_nghiep_dong == null)
                $item->doanh_nghiep_dong  = "0";
            else
                $item->doanh_nghiep_dong = "$item->doanh_nghiep_dong";
            if($item->tong_nop == null)
                $item->tong_nop  = "0";
            else
                $item->tong_nop = "$item->tong_nop";
            if($item->nguoi_lao_dong_dong == null)
                $item->nguoi_lao_dong_dong  = "0";
            else
                $item->nguoi_lao_dong_dong = "$item->nguoi_lao_dong_dong";
        }
        return [
//            'data'=>$user,
//            'moi_quan_he'=>$moi_quan_he,
//            'lich_su_cong_tac'=>$lich_su,
            'data'=>$bao_hiem,

        ];
    }
    public function actionChiTietHopDong(){
        $hop_dong = QuanLyHopDongNhanSu::findOne(['nhan_su_id'=>$_POST['uid']]);
        $phu_cap = ChiTietPhuCap::findAll(['nhan_vien_id'=>$_POST['uid']]);
        return [
            'data'=>($hop_dong==null?['id'=>0]:$hop_dong),
            'phu_cap'=>$phu_cap,
        ];
    }

}