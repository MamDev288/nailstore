<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%quan_ly_cham_cong_theo_ngay}}".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $nhan_vien_id
 * @property string|null $trang_thai
 * @property string|null $vao1
 * @property string|null $ra1
 * @property string|null $vao2
 * @property string|null $ra2
 * @property float|null $ty_le_cong_phat
 * @property float|null $tong_cong
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $ghi_chu
 * @property string|null $hoten
 * @property int|null $uid_may_cham_cong
 */
class QuanLyChamCongTheoNgay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quan_ly_cham_cong_theo_ngay}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nhan_vien_id', 'uid_may_cham_cong'], 'integer'],
            [['date', 'vao1', 'ra1', 'vao2', 'ra2', 'created', 'updated'], 'safe'],
            [['trang_thai'], 'string'],
            [['ty_le_cong_phat', 'tong_cong'], 'number'],
            [['ghi_chu'], 'string', 'max' => 500],
            [['hoten'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Ngày chấm',
            'nhan_vien_id' => 'Nhân viên',
            'trang_thai' => 'Trạng thái',
            'vao1' => 'Vào 1',
            'ra1' => 'Ra 1',
            'vao2' => 'Vào 2',
            'ra2' => 'Ra 2',
            'ty_le_cong_phat' => 'Tỷ lệ công phạt',
            'tong_cong' => 'Tổng cộng',
            'created' => 'Người tạo',
            'updated' => 'Người sửa',
            'ghi_chu' => 'Ghi Chú',
            'hoten' => 'Họ tên',
            'uid_may_cham_cong' => 'Uid May Cham Cong',
        ];
    }
}
