<?php

namespace api\controllers;

use api\models\TangCa;
use yii\helpers\Html;
use yii\web\HttpException;

class TangCaController extends AndinCoreApiController
{
    public function actionIndex(){
        $danhSach = TangCa::find()->andFilterWhere(['user_id'=>$_POST['uid']])->andFilterWhere(['<>','active','0']);
        $totalData = $danhSach->count();
        $countPage = ceil($totalData/20);
        $danhSach->offset(($_POST['page']-1)*20)->limit(20)->orderBy(['date'=>SORT_DESC]);
        return[
          'data'=>$danhSach->all(),
          'totalData'=>$totalData,
          'totalPage'=>$countPage,
        ];
    }

    public function actionCreateAndUpdate(){
        $rec = new TangCa();
        $mess = "Tạo mới ";
        $arrFieds = ['time_start','time_end','ly_do'];
        $rec->user_id = $_POST['uid'];
        if(isset($_POST['id'])){
            if(intval($_POST['id']) > 0) {
                $rec = TangCa::findOne([$_POST['id'], 'user_id' => $_POST['uid']]);
                if (is_null($rec))
                    throw new HttpException(500, 'Không tìm thấy yêu cầu tăng ca');
                if ($rec->trang_thai == 0)
                    throw new HttpException(500, 'Không tìm thấy yêu cầu tăng ca');
                $mess = "Cập nhật ";
            }
        }
        foreach ($arrFieds as $item){
            if(isset($_POST[$item])){
                if($_POST[$item] == "")
                    $rec->{$item} = $_POST[$item];
                else
                    throw new HttpException(500,'Vui lòng điền '.$rec->getAttributeLabel($item));
            }else{
                throw new HttpException(500,'Vui lòng điền '.$rec->getAttributeLabel($item));
            }
        }
        if(!$rec->validate() || !$rec->save()){
            throw new HttpException(500,Html::errorSummary($rec));
        }else{
            return[
                'message'=>$mess.'yêu cầu tăng ca thành công!',
                'data'=>$rec,
            ];
        }
    }

    public function actionDelete(){
        if(!isset( $_POST['id'])){
            throw new HttpException(500,'Không tìm thấy yêu cầu tăng ca');
        }
        $rec = TangCa::findOne([$_POST['id'], 'user_id' => $_POST['uid']]);
        if (is_null($rec))
            throw new HttpException(500, 'Không tìm thấy yêu cầu tăng ca');
        if ($rec->trang_thai == 0)
            throw new HttpException(500, 'Không tìm thấy yêu cầu tăng ca');
        $rec->updateAttributes(['status'=>0]);
        return['message'=>'Xoá yêu cầu thành công!'];
    }
}