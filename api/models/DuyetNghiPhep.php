<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%duyet_nghi_phep}}".
 *
 * @property int $id
 * @property int|null $nghi_phep_id 1: nháp, 2: chờ duyệt, 3: duyệt, 4: từ chối, 5: huỷ
 * @property int|null $trang_thai
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $user_duyet_id
 * @property int|null $duyet_nghi_phep_id
 * @property string|null $ghi_chu
 */
class DuyetNghiPhep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%duyet_nghi_phep}}';
    }
    const _1_NGAY = 24*60*60;
    const _3_NGAY = 24*60*60*3;
    const _5_NGAY = 24*60*60*5;

    const TRANG_THAI =
        [
            1=>'Nháp',
            2=>'Chờ duyệt',
            3=>'Đã duyệt',
            4=>'Từ chối',
            5=>'Huỷ'
        ];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nghi_phep_id', 'trang_thai', 'user_duyet_id', 'duyet_nghi_phep_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ghi_chu'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nghi_phep_id' => 'Nghi Phep ID',
            'trang_thai' => 'Trang Thai',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_duyet_id' => 'User Duyet ID',
            'duyet_nghi_phep_id' => 'Duyet Nghi Phep ID',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

   public function afterSave($insert, $changedAttributes)
   {
       if(!$insert){
           $np = NghiPhep::findOne($this->nghi_phep_id);

           if($this->trang_thai == 4){
               $np->updateAttributes(['trang_thai'=>'Từ chối']);
           }elseif($np->trang_thai == "Từ chối"){
               $np->updateAttributes(['trang_thai'=>'Chờ duyệt']);
           }
           $so_lan_duyet = DuyetNghiPhep::findAll(['nghi_phep_id'=>$this,'trang_thai'=>3]);
           $tong_so_yeu_cau = DuyetNghiPhep::findAll(['nghi_phep_id'=>$this]);
           if(count($so_lan_duyet) == count($tong_so_yeu_cau)){
               NghiPhep::findOne($this->nghi_phep_id)->updateAttributes(['trang_thai'=>'Duyệt']);
           }
           foreach ($tong_so_yeu_cau as $index => $item){
               if($index+1 < count($tong_so_yeu_cau)){
                   if($tong_so_yeu_cau[$index+1]->id == $this->id){
                       $item->updateAttributes(['trang_thai'=>1]);
                       break;
                   }
               }
           }
       }
       parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
   }
}