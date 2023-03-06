<?php

namespace api\controllers;


use api\models\Cauhinh;
use api\models\TempSecret;
use common\models\myAPI;
use common\models\User;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class AndinCoreApiController extends Controller
{
    public $enableCsrfValidation = false;

//    public $dataPost;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if(!($action->actionMethod == 'actionGetTempSecret')) {
            if (!\Yii::$app->request->isPost)
                exit('AndinJSC!');
//            $content = file_get_contents('php://input');
////            VarDumper::dump($content);exit();
//            if(!empty($content)){
//                throw new HttpException(500,'Phiên bản đã hết hạn sử dụng, hãy cập nhập phiên bản mới để trải nghiệm');
//            }
//            else{
////                $this->dataPost = ($_POST);
//
//            }
//            $cauHinh = Cauhinh::findOne(['ghi_chu'=>'open_test']);
//            if(!is_null($cauHinh))
//            {
////                if(!is_object($this->dataPost)) {
////                    $this->dataPost = json_decode($this->dataPost);
////                }
//                if($cauHinh->content == 1){
//                    goto endHash;
//                }
//            }
            #region Kiểm tra thời gian truy cập (độ trễ là 1 tiếng)
//            if(!isset($_GET['timestamp'])) {
//                throw new HttpException(500, "Múi giờ không hợp lệ");
//            }
            $validateTime = false;
//            for($i = time(), $j = time(); $i < time() + 3600, $j > time() - 3600; $i++, $j--) {
//                if($_GET['timestamp'] == $i || $_GET['timestamp'] == $j) {
//                    $validateTime = true;
//                }
//            }
//            if($_GET['timestamp']  <= time() + 3600  && $_GET['timestamp'] >= time() - 3600) {
//                $validateTime = true;
//            }
//            if(!$validateTime) {
//                throw new HttpException(500, "Múi giờ không hợp lệ");
//            }
            #endregion
//            #region Kiểm tra body_md5
//            if(!isset($_GET['body_encoded'])) {
//                throw new HttpException(500, "Dữ liệu không hợp lệ");
//            }
//
//            $body_encoded = is_object($this->dataPost) ? md5(json_encode($this->dataPost)) : md5($this->dataPost);
//            if($body_encoded != $_GET['body_encoded']) {
//                throw new HttpException(500, "Dữ liệu không hợp lệ");
//            }
//            #endregion
//            #region Kiểm tra signature
//            if(!is_object($this->dataPost)) {
//                $this->dataPost = json_decode($this->dataPost);
//            }
//            $secretKey = null;
//            if (!in_array($action->actionMethod, [
//                'actionDangKiTaiKhoan',
//                'actionLogin',
//                'actionQuenMatKhau',
//                'actionCheckOtp',
//                'actionDoiPassOtp',
//            ])) {
//                if($this->dataPost->uid == null || $this->dataPost->auth == null) {
//                    throw new HttpException(401, "Không xác thực được tài khoản");
//                }
//                $user = User::findOne(['id' => $this->dataPost->uid]);
//                if($user->auth_key != $this->dataPost->auth) {
//                    throw new HttpException(401, "Phiên đăng nhập hết hạn");
//                }
//                $secretKey = $user->secret_key;
//            }
//            else {
//                $secretKey = $this->dataPost->secret_key;
//                if($secretKey==""){
//                    throw new HttpException(401, "Hết phiên đăng nhập tạm thời");
//                }
//                if(TempSecret::find()
//                        ->andFilterWhere(['key' => $secretKey])
//                        ->andFilterWhere(['>', 'expire', time()])
//                        ->one() == null) {
//                    throw new HttpException(401, "Hết phiên đăng nhập tạm thời");
//                }
//            }
////            if(!isset($_GET['signature'])) {
////                throw new HttpException(401, "Chữ ký không hợp lệ vui lòng đăng nhập lại");
////            }
////            $controllerName = \Yii::$app->controller->id;
////            $actionName = \Yii::$app->controller->action->id;
////            $signatureRaw = $controllerName.'/'.$actionName.
////                '?timestamp='.$_GET['timestamp'].
////                '&body_encoded='.$_GET['body_encoded'];
////            $signaturEncoded = hash_hmac('sha256', $signatureRaw  , base64_decode($secretKey));
////            if($signaturEncoded != $_GET['signature']) {
////                throw new HttpException(401, "Chữ ký không hợp lệ vui lòng đăng nhập lại");
////            }
//            #endregion
            endHash:
            if (!in_array($action->actionMethod, [
                'actionDangKiTaiKhoan',
                'actionLogin',
                'actionQuenMatKhau',
                'actionCheckOtp',
                'actionDoiPassOtp','actionDangKi','actionChamCong'
            ])) {
                    $user = User::findOne([
//                    'auth_key' => $_POST['auth'],
                    'id' => $_POST['uid'],
                    'status' => 10,
                ]);
                if(is_null($user))
                    throw new HttpException(401, "Hết hạn phiên đăng nhập, vui lòng thử lại");
                if($user->status != 10) {
                    throw new HttpException(401, "Tài khoản đã bị khóa");
                }

            }
        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    //Check đầu vào theo mảng
    public function checkEmty($arr, $model)
    {
        foreach ($arr as $item) {
            if (!isset($_POST[$item]))
                throw new HttpException(500, 'Vui lòng điền ' . $model->getAttributeLabel($item));
            if (($_POST[$item]) == "" || $_POST[$item] == null)
                throw new HttpException(500, 'Vui lòng điền ' . $model->getAttributeLabel($item));
        }
    }

    //Check số điện thoại
    public function checkSoDienThoai($phone)
    {
        $boolCheck = false;
        if (preg_match('/^[0-9]{10}+$/', $phone)) {
            if (substr($phone, 0, 1) == '0') {
                if (substr($phone, 1, 1) >= 3)
                    $boolCheck = true;
            }

        } elseif (preg_match('/^[0-9]{12}+$/', $phone)) {
            if (substr($phone, 0, 2) == '84')
                if (substr($phone, 2, 2) >= 3)
                    $boolCheck = true;
        } elseif (preg_match('/^[0-9]{13}+$/', $phone)) {
            if (substr($phone, 0, 3) == '840')
                if (substr($phone, 3, 3) >= 3)
                    $boolCheck = true;
        }
        return $boolCheck;
    }

    //Check Họ và Tên và chuẩn hoá
    public function checkFullName($str)
    {
        if ($str == "" || strlen($str) < 3 || !preg_match("/^[a-zA-Z'-]+$/", $str)) {
            throw new HttpException(500,'Vui lòng nhập lại họ và tên');
        }
        return ($str);
    }

    //Update truờng yêu cầu
    public function updateIsset($models, $array)
    {
        $fileds = [];
        foreach ($array as $item) {
            if (!isset($_POST[$item]))
                throw new HttpException(500, 'Vui lòng nhập ' . $models->getAttributeLabel($item));
            if ("" == ($_POST[$item]))
                throw new HttpException(500, 'Vui lòng nhập ' . $models->getAttributeLabel($item));
            $fileds [$item] = $_POST[$item];
        }
        $models->updateAttributes($fileds);
        return $models;
    }

    //Update truờng không yêu cầu
    public function updateNotIsset($models, $array)
    {
        $fileds = [];
        foreach ($array as $item) {
            if (isset($_POST[$item]))
                if ("" != $_POST[$item])
                    $fileds [$item] = $_POST[$item];
        }

        $models->updateAttributes($fileds);
        return $models;
    }

    //Load models theo mảng issert
    public function isertFiledsIsset($models, $array)
    {
        foreach ($array as $item) {
            if (!isset($_POST[$item]))
                throw new HttpException(500, 'Vui lòng nhập ' . $models->getAttributeLabel($item));
            if ("" == ($_POST[$item]))
                throw new HttpException(500, 'Vui lòng nhập ' . $models->getAttributeLabel($item));
            $models->{$item} = $_POST[$item];
        }
        return $models;
    }

    //Load models theo mảng issert không check Rỗng
    public function isertFiledsNotIsset($models, $array)
    {
        foreach ($array as $item) {
            if (isset($_POST[$item]))
                if ("" != $_POST[$item])
                    $models->{$item} = $_POST[$item];
        }
        return $models;
    }

    public function error500($mess){
        throw new HttpException(500,$mess);
    }

    public function checkLeght($str,$min,$max){
        $leght = strlen($str);
        if($leght <= $min && $leght >= $max)
            return false;
        return true;
    }

    public function datetime2Hi($datetime){
        if($datetime == null || $datetime == "")
            return null;
        return date('H:i',strtotime($datetime));
    }

    public function check_base64_image($base64) {
        $img = imagecreatefromstring(base64_decode($base64));
        if (!$img) {
            return false;
        }

        imagepng($img, 'tmp.png');
        $info = getimagesize('tmp.png');

        unlink('tmp.png');

        if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
            return true;
        }

        return false;
    }
    public function checkNull($key){
        if(!isset($_POST[$key]))
            return false;
        if(is_null($_POST[$key]))
            return false;
        return true;
    }
    function validateDateTime($date, $format = 'd/m/Y H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
    public function checkNgayNghi($donNghi){
        if($this->checkNull('nghi_tu_ngay') && $this->checkNull('nghi_den_ngay') && $this->checkNull('ngay_de_nghi'))
        {
//            if($this->validateDateTime($this->dataPost->nghi_tu_ngay))
//            {
//                $this->error500($donNghi->getAttributeLabel('nghi_tu_ngay').' Không hợp lệ');
//            }
//            if($this->validateDateTime($this->dataPost->nghi_tu_ngay))
//            {
//                $this->error500($donNghi->getAttributeLabel('nghi_tu_ngay').' Không hợp lệ');
//            }
//            if($this->validateDateTime($this->dataPost->ngay_de_nghi))
//            {
//                $this->error500($donNghi->getAttributeLabel('ngay_de_nghi').' Không hợp lệ');
//            }
            $_POST['ngay_de_nghi'] = myAPI::convertDMY2YMD($_POST['ngay_de_nghi']);
            $_POST['nghi_tu_ngay'] = myAPI::covertTDMY2YMD($_POST['nghi_tu_ngay']);
            $_POST['nghi_den_ngay'] = myAPI::covertTDMY2YMD($_POST['nghi_den_ngay']);
//            $d1 = new \DateTime($this->dataPost->nghi_tu_ngay);
//            $d2 = new \DateTime($this->dataPost->nghi_den_ngay);
//            $d3 = new \DateTime(myAPI::covertYMD2TDMY($this->dataPost->ngay_de_nghi));
//            $d4 = new \DateTime(date('Y-m-d H:i:s'));
//            if($d4 < $d2 || $d4 < $d1 || $d4 < $d3)
//                $this->error500('Không thể tạo yêu cầu cho quá khứ được :<');
//            if($d1 >= $d2 || $d1 > $d4)
//                $this->error500('Ngày nghỉ từ và đến không hợp lệ, vui lòng kiểm tra lại!');
        }
    }
    public function uploadImage($attribute,$fileFormatAccpect = null,$motherFolder = 'images' , $parentFolder = null, $model = null, $attributeModel =null,$modelUpdate = false )
    {
        if($attribute == "")
            return null;
        if(!isset($_FILES[$attribute]))
            return null;
        if(is_null($_FILES[$attribute]) && empty($_FILES[$attribute]))
            return null;
        $check = getimagesize($_FILES[$attribute]["tmp_name"]);
        if($check !== false) {
            if($fileFormatAccpect != null){
                if($check['mine'] == $fileFormatAccpect){
                    $info = pathinfo($_FILES[$attribute]['name']);
                    $ext = $info['extension']; // get the extension of the file
                    $newname = myAPI::createCode($info['pathinfo']).'-'.time(). '.' .$ext;
                    if($motherFolder == null && $motherFolder == "")
                        return null;
                    $target = $motherFolder.'/'.($parentFolder==null?'':$parentFolder.'/').$newname;
                    try {
                        move_uploaded_file( $_FILES[$attribute]['tmp_name'], $target);
                    }catch (\Exception $exception){
                        throw new HttpException(500,$exception->getMessage());
                    }
                    if($model != null && $attributeModel!= null && $model != "" && $attributeModel!= ""){
                        try
                        {
                            if($modelUpdate){
                                $model->updateAttributes([$attributeModel=>$target]);
                            }else{
                                $model->{$attributeModel} = $target;
                            }
                        }catch (\Exception $exception)
                        {
                            throw new HttpException(500,$exception->getMessage());
                        }
                        return true;
                    }
                    return $target;
                }
            }
        }else{
            return null;
        }
    }
}