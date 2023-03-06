<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property string|null $auth_key
 * @property string|null $secret
 * @property int|null $status
 * @property string|null $anh_nguoi_dung
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $password
 * @property string|null $hoten
 * @property string|null $dien_thoai
 * @property string|null $cmnd
 * @property string|null $ngay_cap
 * @property string|null $dia_chi
 * @property int|null $active
 * @property string|null $ngay_sinh
 * @property string|null $ghi_chu
 * @property int|null $user_id
 * @property int|null $trinh_do_id
 * @property string|null $ngay_nop_ho_so Nếu ngày nộp HS <> null thì coi như đã nộp hồ sơ
 * @property string|null $noi_cap
 * @property string|null $ngay_chinh_thuc
 *
 * @property OTPUser[] $oTPUsers
 * @property FileHoSo[] $fileHoSos
 * @property FileHoSo[] $fileHoSos0
 * @property HopDongNhanSu[] $hopDongNhanSus
 * @property HopDongNhanSu[] $hopDongNhanSus0
 * @property PhongBan[] $phongBans
 * @property PhongBanNhanVien[] $phongBanNhanViens
 * @property PhongBanNhanVien[] $phongBanNhanViens0
 * @property DanhMuc $trinhDo
 * @property User $user
 * @property User[] $users
 * @property Vaitrouser[] $vaitrousers
 * @property VnMoiQuanHe[] $vnMoiQuanHes
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public const USERNOVERIFY = 14;
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'active', 'user_id', 'trinh_do_id'], 'integer'],
            [['created_at', 'updated_at', 'ngay_cap', 'ngay_sinh', 'ngay_nop_ho_so', 'ngay_chinh_thuc'], 'safe'],
            [['ghi_chu', 'noi_cap'], 'string'],
            [['username', 'password_hash', 'email', 'password', 'hoten'], 'string', 'max' => 100],
            [['password_reset_token'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
//            [['secret'], 'string', 'max' => 255],
            [['anh_nguoi_dung'], 'string', 'max' => 300],
            [['dien_thoai', 'cmnd'], 'string', 'max' => 20],
            [['dia_chi'], 'string', 'max' => 200],
            [['username'], 'unique'],
//            [['trinh_do_id'], 'exist', 'skipOnError' => true, 'targetClass' => DanhMuc::className(), 'targetAttribute' => ['trinh_do_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'secret' => 'Secret',
            'status' => 'Status',
            'anh_nguoi_dung' => 'Anh Nguoi Dung',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password' => 'Password',
            'hoten' => 'Hoten',
            'dien_thoai' => 'Dien Thoai',
            'cmnd' => 'Cmnd',
            'ngay_cap' => 'Ngày Cấp',
            'dia_chi' => 'Địa Chi',
            'active' => 'Active',
            'ngay_sinh' => 'Ngay Sinh',
            'ghi_chu' => 'Ghi Chu',
            'user_id' => 'User ID',
            'trinh_do_id' => 'Trinh Do ID',
            'ngay_nop_ho_so' => 'Ngay Nop Ho So',
            'noi_cap' => 'Noi Cap',
            'ngay_chinh_thuc' => 'Ngay Chinh Thuc',
        ];
    }

    /**
     * Gets query for [[OTPUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOTPUsers()
    {
        return $this->hasMany(OTPUser::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[FileHoSos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileHoSos()
    {
        return $this->hasMany(FileHoSo::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[FileHoSos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileHoSos0()
    {
        return $this->hasMany(FileHoSo::className(), ['nhan_su_id' => 'id']);
    }

    /**
     * Gets query for [[HopDongNhanSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHopDongNhanSus()
    {
        return $this->hasMany(HopDongNhanSu::className(), ['nhan_su_id' => 'id']);
    }

    /**
     * Gets query for [[HopDongNhanSus0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHopDongNhanSus0()
    {
        return $this->hasMany(HopDongNhanSu::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PhongBans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBans()
    {
        return $this->hasMany(PhongBan::className(), ['truong_phong_id' => 'id']);
    }

    /**
     * Gets query for [[PhongBanNhanViens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBanNhanViens()
    {
        return $this->hasMany(PhongBanNhanVien::className(), ['nhan_vien_id' => 'id']);
    }

    /**
     * Gets query for [[PhongBanNhanViens0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBanNhanViens0()
    {
        return $this->hasMany(PhongBanNhanVien::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TrinhDo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrinhDo()
    {
        return $this->hasOne(DanhMuc::className(), ['id' => 'trinh_do_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Vaitrousers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVaitrousers()
    {
        return $this->hasMany(Vaitrouser::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[VnMoiQuanHes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVnMoiQuanHes()
    {
        return $this->hasMany(VnMoiQuanHe::className(), ['nhan_su_id' => 'id']);
    }
    public function beforeSave($insert)
    {
        if($insert){
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $this->password = "";
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
