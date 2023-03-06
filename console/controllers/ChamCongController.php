<?php

namespace console\controllers;

use backend\helpers\ConstHelper;
use backend\helpers\DateTimeHelper;
use backend\models\ChamCong;
use backend\models\LuotChamCong;
use backend\services\ChamCongService;
use backend\services\LogService;
use backend\services\NhanVienService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use yii\console\Controller;

class ChamCongController extends Controller
{
    /**
     * Tạo dữ liệu chấm công giả
     * @param $nhanVienId
     * @param $startDate
     * @param $endDate
     * @return boolean
     */
    public function actionCreateDummyData($nhanVienId, $startDate, $endDate)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            ChamCongService::createChamCongDummyData($nhanVienId, $startDate, $endDate);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $transaction->rollBack();
        }
        return false;
    }

    public function actionIndex()
    {
        return true;
    }

    public function actionGetSoNgayNghi($thangNam)
    {
//        echo ChamCongService::calcSoNgayNghi($thangNam, ConstHelper::TYPE_TAT_CA_NGAY);
        echo DateTimeHelper::getSoNgayTrongThang($thangNam) - ChamCongService::calcSoNgayNghi($thangNam);
        return true;
    }

    public function actionImportExcel($fileName, $fromFormat = 'd/m/Y')
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            ChamCongService::importExcelDataChamCong($fileName, $fromFormat);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getTraceAsString());
            $transaction->rollBack();
        }
        return false;
    }

    public function actionDeleteChamCongData($startDate, $endDate, $nhanVienId = null)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            LuotChamCong::deleteAll(['AND', ['>=', 'ngay_cham_cong', $startDate], ['<=', 'ngay_cham_cong', $endDate]]);
            ChamCong::deleteAll(['AND', ['>=', 'date', $startDate], ['<=', 'date', $endDate]]);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $transaction->rollBack();
        }
        return false;
    }

    public function actionCalcChamCong($nhanVienId, $startDate, $endDate)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $days = DateTimeHelper::getNumOfDaysInThePeriod($startDate, $endDate);
            for ($i = 0; $i <= $days; $i++) {
                $chamCong = ChamCong::find()->where(['nhan_vien_id' => $nhanVienId, 'date' => date('Y-m-d', strtotime("$startDate + $i days"))])->one();
                if($chamCong) {
                    ChamCongService::calcDuLieuChamCong($chamCong->id, $chamCong->date);
                }
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * Tính toán dữ liệu chấm công cho tất cả nhân viên trong khoản thời gian
     * @param $startDate
     * @param $endDate
     * @return bool
     */
    public function actionCalcDuLieuChamCongInThePeriod($startDate, $endDate){
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            ChamCongService::calcDuLieuChamCongInThePeriod($startDate, $endDate);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getTraceAsString());
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * Tính toán dữ liệu chấm công cho tất cả nhân viên trong hôm nay
     * @return bool
     */
    public function actionCalcDuLieuChamCongToday(){
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d');
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            ChamCongService::calcDuLieuChamCongInThePeriod($startDate, $endDate);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            $transaction->rollBack();
        }
        return false;
    }
}