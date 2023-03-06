<?php

namespace console\controllers;

use backend\services\PhongBanService;
use backend\services\VaiTroService;
use yii\console\Controller;

class VaiTroController extends Controller
{
    /**
     * Cập nhật vai trò trưởng phòng cho người dùng
     * @param $nhanVienId
     * @param $startDate
     * @param $endDate
     * @return boolean
     */
    public function actionUpdateVaiTroTruongPhongUser()
    {
        $truongPhongs = VaiTroService::getALlTruongPhong();
        foreach ($truongPhongs as $truongPhong){
            VaiTroService::deleteVaiTroUser($truongPhong->user_id,'Trưởng phòng');
            VaiTroService::createVaiTroUser($truongPhong->user_id, 'Nhân viên');
        }
        $phongBans = PhongBanService::getAllPhongBan(['truong_phong_id']);
        foreach ($phongBans as $phongBan){
            VaiTroService::deleteVaiTroUser($phongBan->truong_phong_id,'Nhân viên');
            VaiTroService::createVaiTroUser($phongBan->truong_phong_id, 'Trưởng phòng');
        }
        return true;
    }
}