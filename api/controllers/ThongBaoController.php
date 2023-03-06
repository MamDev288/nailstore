<?php

namespace api\controllers;

use api\models\ThongBao;
use common\models\myAPI;

class ThongBaoController extends AndinCoreApiController
{
    public function actionGetThongBao(){
        $thongbao = ThongBao::find()->select(['id','title','created','is_seen','type'])->andFilterWhere(['user_id'=>$_POST['uid'],'active'=>1]);
        if(isset($_POST['is_seen'])) {
            if (!is_null($_POST['is_seen'])) {
                $thongbao->andFilterWhere(['is_seen' => $_POST['is_seen']]);
            }
        }
        $count = ceil($thongbao->count()/20);
        $thongbao = $thongbao->
        offset(((isset($_POST['page'])?$_POST['page']:1)-1)*20)
            ->limit(20)->orderBy(['id'=>SORT_DESC])->all();
        foreach ($thongbao as $item){
            $item->created = date('H:i d/m/Y',strtotime($item->created));
        }
        return [
            'so_trang'=>$count,
            'data' => $thongbao,
            ];
    }
    public function actionDocThongBao(){
        if(!isset($_POST['id']))
            $this->error500('Không tìm thấy nội dung thông báo');
        $thong_bao = ThongBao::findOne($_POST['id']);
        if(is_null($thong_bao))
            $this->error500('Không tìm thấy nội dung thông báo');
        if($thong_bao->id == 0)
            $this->error500('Thông báo đã được xoá bởi quản trị viên');
        if($thong_bao->user_id != $_POST['uid'])
            $this->error500('Bạn không có quyền truy cập thông báo này!');
        if($thong_bao->is_seen == 0)
            $thong_bao->updateAttributes(['is_seen'=>1,'time_seen'=>date('Y-m-d H:i:s')]);
        $thong_bao->created = date('H:i d/m/Y',strtotime($thong_bao->created));
        return $thong_bao;
   }

}