<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%cau_hinh_cham_cong}}".
 *
 * @property int $id
 * @property string|null $standard_time thời gian đúng, VD giờ bắt đầu vào làm hoặc giờ tan làm
 * @property string|null $start_time bắt đầu khung giờ checkin hoặc checkout
 * @property string|null $end_time kết thúc khung giờ checkin hoặc checkout
 * @property string|null $type Kiểu chấm công vào hoặc ra
 * @property string|null $shift
 * @property int|null $active
 */
class CauHinhChamCong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cau_hinh_cham_cong}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'shift'], 'string'],
            [['active'], 'integer'],
            [['standard_time', 'start_time', 'end_time'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'standard_time' => 'Standard Time',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'type' => 'Type',
            'shift' => 'Shift',
            'active' => 'Active',
        ];
    }
}
