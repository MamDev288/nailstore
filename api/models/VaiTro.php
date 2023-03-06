<?php

namespace api\models;

use common\models\myActiveRecord;
use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 *
 * @property PhanQuyen[] $phanQuyens
 * @property Vaitrouser[] $vaitrousers
 */
class VaiTro extends ActiveRecord
{
    const QUAN_LY = 'Quản lý';
    const KHACH_HANG = 'Khách hàng';
    const NHAN_VIEN = 'Nhân viên';

    public static function tableName()
    {
        return '{{%vai_tro}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getPhanQuyens()
    {
        return $this->hasMany(PhanQuyen::className(), ['vai_tro_id' => 'id']);
    }

    public function getVaitrousers()
    {
        return $this->hasMany(Vaitrouser::className(), ['vaitro_id' => 'id']);
    }
}
