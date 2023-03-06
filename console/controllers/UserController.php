<?php

namespace console\controllers;

use backend\services\PhongBanService;
use backend\services\UserService;
use backend\services\VaiTroService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet;
use yii\console\Controller;

class UserController extends Controller
{

    public function actionUpdateVaiTroUser()
    {
        $phongBanNhanViens = PhongBanService::getAllNhanVienInAllPhongBan(['nhan_vien_id', 'truong_phong']);
        foreach ($phongBanNhanViens as $phongBanNhanVien){
            if($user = UserService::getUserById($phongBanNhanVien->nhan_vien_id)){
                if($phongBanNhanVien->truong_phong == 1){
                    VaiTroService::createVaiTroUser($phongBanNhanVien->nhan_vien_id, 'Trưởng phòng');
                    VaiTroService::deleteVaiTroUser($phongBanNhanVien->nhan_vien_id, 'Nhân viên');
                }else{
                    VaiTroService::deleteVaiTroUser($phongBanNhanVien->nhan_vien_id, 'Trưởng phòng');
                    VaiTroService::createVaiTroUser($phongBanNhanVien->nhan_vien_id, 'Nhân viên');
                }

            }


        }
        return true;
    }

    public function actionUpdateUserPassword()
    {
        $phongBanNhanViens = PhongBanService::getAllNhanVienInAllPhongBan(['nhan_vien_id', 'truong_phong']);
        foreach ($phongBanNhanViens as $phongBanNhanVien){
            if($user = UserService::getUserById($phongBanNhanVien->nhan_vien_id)){
                $user->password_hash = "Pacific@123";
                $user->save(false);
            }
        }
        return true;
    }

    public function actionExportNhanVien(){
        $spreadsheet = IOFactory::load(\Yii::getAlias('@root') . '/files_excel/templates/users-templates.xlsx');
        $phongBanNhanViens = PhongBanService::getAllNhanVienInAllPhongBan(['nhan_vien_id', 'truong_phong', 'tenphongban']);
        $nhanViens = [];
        foreach ($phongBanNhanViens as $phongBanNhanVien){
            if($phongBanName = ($phongBanNhanVien->tenphongban ?? null)){
                if(!isset($nhanViens[$phongBanName])){
                    $nhanViens[$phongBanName] = [];
                }
                if($user = UserService::getUserById($phongBanNhanVien->nhan_vien_id)) {
                    $nhanViens[$phongBanName][] = [
                        'hoten' => $user->hoten,
                        'username' => $user->username,
                        'password' => 'Pacific@123'
                    ];
                }
            }
        }
        $index = 0;
        foreach ($nhanViens as $phongBan => $data){
            $sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $phongBan);
            $spreadsheet->addSheet($sheet,$index);
            $spreadsheet->setActiveSheetIndex($index);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->getCell('A1')->setValue('STT');
            $worksheet->getCell('B1')->setValue('Họ tên');
            $worksheet->getCell('C1')->setValue('Tài khoản');
            $worksheet->getCell('D1')->setValue('Mật khẩu');
            $spreadsheet->getActiveSheet()->getStyle('A1:D1')->getFont()
                ->setBold(true);
            foreach ($data as $k => $item){
                $cell = $k + 2;
                $worksheet->getCell('A'.$cell)->setValue($k + 1);
                $worksheet->getCell('B'.$cell)->setValue($item['hoten']);
                $worksheet->getCell('C'.$cell)->setValue($item['username']);
                $worksheet->getCell('D'.$cell)->setValue($item['password']);
            }
            $spreadsheet->getActiveSheet()->getStyle('A1:D'.(count($data) + 2))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('A1:A'.(count($data) + 2))->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $index ++;
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('danh-sach-nhan-su.xlsx');
    }
}