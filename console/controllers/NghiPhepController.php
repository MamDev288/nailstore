<?php

namespace console\controllers;

use backend\models\DuyetNghiPhep;
use backend\models\form\DiMuonVeSomForm;
use backend\models\form\DiMuonVeSomThuongNienForm;
use backend\models\NghiPhep;
use backend\models\TruongHopDacBiet;
use backend\services\NghiPhepService;
use yii\console\Controller;

class NghiPhepController extends Controller
{
    /**
     * Import nghỉ phép loại thường từ excel
     * @param $fileName
     * @param $fromFormat
     * @return bool
     */
    public function actionImportExcelNghiPhepThuong($fileName, $fromFormat = 'Y-m-d')
    {
        return NghiPhepService::importExcelDataNghiPhepThuong($fileName, $fromFormat);
    }

    /**
     * Xóa các nghỉ phép loại thường
     * @param $startDate
     * @param $endDate
     * @param $nhanVienId
     * @return bool
     */
    public function actionDeleteNghiPhepThuong($startDate, $endDate, $nhanVienId = null)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $nghiPheps = NghiPhep::find()->select(['id'])->where(['AND', ['>=', 'nghi_tu_ngay', $startDate], ['<=', 'nghi_tu_ngay', $endDate]])
                ->andWhere(['type' => NghiPhep::NGHI_THUONG])
                ->all();
            $nghiPhepIds = array_map(function (NghiPhep $nghiPhep) {
                return $nghiPhep->id;
            }, $nghiPheps);
            DuyetNghiPhep::deleteAll(['IN', 'nghi_phep_id', $nghiPhepIds]);
            NghiPhep::deleteAll(['IN', 'id', $nghiPhepIds]);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getTraceAsString());
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * Xóa các đơn xin đi muộn về về sớm
     * @param $startDate
     * @param $endDate
     * @param $nhanVienId
     * @return bool
     */
    public function actionDeleteDiMuonVeSom($startDate, $endDate, $nhanVienId = null)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $nghiPheps = DiMuonVeSomForm::find()->select(['id'])->where(['AND', ['>=', 'nghi_tu_ngay', $startDate], ['<=', 'nghi_tu_ngay', $endDate]])
                ->all();
            $nghiPhepIds = array_map(function (NghiPhep $nghiPhep) {
                return $nghiPhep->id;
            }, $nghiPheps);
            DuyetNghiPhep::deleteAll(['IN', 'nghi_phep_id', $nghiPhepIds]);
            NghiPhep::deleteAll(['IN', 'id', $nghiPhepIds]);
            TruongHopDacBiet::deleteAll(['IN','id', $nghiPhepIds]);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getTraceAsString());
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * Xóa các đơn xin đi muộn về về sớm thường niên
     * @param $startDate
     * @param $endDate
     * @param $nhanVienId
     * @return bool
     */
    public function actionDeleteDiMuonVeSomThuongNien($startDate, $endDate, $nhanVienId = null)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $nghiPheps = DiMuonVeSomThuongNienForm::find()->select(['id'])->where(['AND', ['>=', 'nghi_tu_ngay', $startDate], ['<=', 'nghi_tu_ngay', $endDate]])
                ->all();
            $nghiPhepIds = array_map(function (NghiPhep $nghiPhep) {
                return $nghiPhep->id;
            }, $nghiPheps);
            DuyetNghiPhep::deleteAll(['IN', 'nghi_phep_id', $nghiPhepIds]);
            NghiPhep::deleteAll(['IN', 'id', $nghiPhepIds]);
            TruongHopDacBiet::deleteAll(['IN','id', $nghiPhepIds]);
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            var_dump($e->getTraceAsString());
            $transaction->rollBack();
        }
        return false;
    }
}