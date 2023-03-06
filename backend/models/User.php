<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\web\IdentityInterface;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property string|null $auth_key
 * @property string|null $secret_key
 * @property int|null $status
 * @property string|null $anh_nguoi_dung
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $password
 * @property string|null $hoten
 * @property string|null $dien_thoai
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
 * @property string|null $so_tai_khoan
 * @property int|null $ngan_hang_id
 * @property string|null $chu_tai_khoan
 * @property string|null $token_web
 * @property int|null $gioi_tinh 0 là nam, 1 là nữ
 * @property string|null $mst_ca_nhan
 * @property string|null $hon_nhan
 * @property string|null $tp_gia_dinh
 * @property string|null $tp_ban_than
 * @property string|null $dan_toc
 * @property string|null $ton_giao
 * @property string|null $quoc_tich
 * @property string|null $cmnd
 * @property string|null $ngay_cap_cmnd
 * @property string|null $noi_cap_cmnd
 * @property string|null $ngay_het_han_cmnd
 * @property string|null $so_ho_chieu
 * @property string|null $ngay_cap_ho_chieu
 * @property string|null $ngay_het_han_ho_chieu
 * @property string|null $noi_cap_ho_chieu
 * @property int|null $trinh_do_van_hoa
 * @property string|null $noi_dao_tao
 * @property string|null $khoa
 * @property int|null $chuyen_nganh_id
 * @property string|null $nam_tot_nghiep
 * @property string|null $xep_loai
 * @property int|null $tinh_thanh_tt_id tỉnh thành thường trú
 * @property int|null $quan_huyen_tt_id Quận huyện thường trú id
 * @property int|null $phuong_xa_tt_id Phường xã thường trú
 * @property string|null $dia_chi_cu_the_thuong_tru
 * @property string|null $ma_so_ho_kho Mã sổ hộ khẩu 
 * @property int|null $la_chu_ho
 * @property string|null $dia_chi_shk
 * @property int|null $dia_chi_so_voi_shk Chỗ ở hiện tại có giống với Sổ hộ khẩu không
 * @property int|null $tinh_thanh_hien_tai_id
 * @property int|null $quan_huyen_hien_tai_id
 * @property int|null $xa_phuong_hien_tai_id
 * @property string|null $dia_chi_hien_tai
 * @property string|null $ho_dem
 * @property string|null $ten
 * @property string|null $ten_khac
 * @property string|null $noi_sinh
 * @property int|null $uid_may_cham_cong
 *
// * @property VhFileThayDoiLuong[] $vhFileThayDoiLuongs
// * @property OTPUser[] $oTPUsers
// * @property BangLuong[] $bangLuongs
 * @property BaoHiemNhanSu[] $baoHiemNhanSus
 * @property BaoHiemNhanSu[] $baoHiemNhanSus0
 * @property ChamCong[] $chamCongs
// * @property ChiTietBangLuong[] $chiTietBangLuongs
// * @property ChiTietChamCongThang[] $chiTietChamCongThangs
// * @property ChiTietPhuCap[] $chiTietPhuCaps
 * @property DuyetNghiPhep[] $duyetNghiPheps
// * @property FileHoSo[] $fileHoSos
// * @property FileHoSo[] $fileHoSos0
 * @property HopDongNhanSu[] $hopDongNhanSus
 * @property HopDongNhanSu[] $hopDongNhanSus0
 * @property HopDongNhanSu[] $hopDongNhanSus1
// * @property MoiQuanHe[] $moiQuanHes
 * @property NghiPhep[] $nghiPheps
 * @property NghiPhep[] $nghiPheps0
 * @property PhongBan[] $phongBans
 * @property PhongBanNhanVien[] $phongBanNhanViens
 * @property PhongBanNhanVien[] $phongBanNhanViens0
// * @property ThayDoiLuong[] $thayDoiLuongs
 * @property ThongBao[] $thongBaos
 * @property ThongBao[] $thongBaos0
 * @property TokenNotify[] $tokenNotifies
// * @property TrangThaiBangLuong[] $trangThaiBangLuongs
 * @property TrangThaiDkNhuCauNs[] $trangThaiDkNhuCauNs
 * @property TrangThaiNghiPhep[] $trangThaiNghiPheps
 * @property TrangThaiNghiPhep[] $trangThaiNghiPheps0
 * @property TuyenDungDkNhuCauNs[] $tuyenDungDkNhuCauNs
 * @property TuyenDungDkNhuCauNs[] $tuyenDungDkNhuCauNs0
 * @property TuyenDungDkNhuCauNs[] $tuyenDungDkNhuCauNs1
 * @property DanhMuc $trinhDo
 * @property User $user
 * @property User[] $users
 * @property Vaitrouser[] $vaitrousers
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const KHACH_HANG = 'Khách hàng';
    const THANH_VIEN = 'Thành viên';
    const GIAM_DOC = 'Giám đốc';
    const PHONG_HCNS = 'Phòng hành chính nhân sự';

    public const XEPLOAI_TRUNGBINH = "Trung bình";
    public const XEPLOAI_KHA = "Khá";
    public const XEPLOAI_GIOI = "Giỏi";


    /**
     * {@inheritdoc}
     */
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
            [['status', 'active', 'user_id', 'trinh_do_id', 'ngan_hang_id', 'gioi_tinh', 'trinh_do_van_hoa', 'chuyen_nganh_id', 'tinh_thanh_tt_id', 'quan_huyen_tt_id', 'phuong_xa_tt_id', 'la_chu_ho', 'dia_chi_so_voi_shk', 'tinh_thanh_hien_tai_id', 'quan_huyen_hien_tai_id', 'xa_phuong_hien_tai_id', 'uid_may_cham_cong'], 'integer'],
            [['created_at', 'updated_at', 'ngay_cap', 'ngay_sinh', 'ngay_nop_ho_so', 'ngay_chinh_thuc', 'ngay_cap_cmnd', 'ngay_het_han_cmnd', 'ngay_cap_ho_chieu', 'ngay_het_han_ho_chieu', 'nam_tot_nghiep'], 'safe'],
            [['ghi_chu', 'noi_cap', 'hon_nhan', 'ton_giao', 'xep_loai'], 'string'],
            [['username', 'password_hash', 'email', 'password', 'hoten', 'so_tai_khoan', 'chu_tai_khoan', 'noi_cap_cmnd', 'noi_cap_ho_chieu', 'ten_khac', 'password'], 'string', 'max' => 100],
            [['password_reset_token'], 'string', 'max' => 45],
            [['auth_key', 'mst_ca_nhan', 'tp_gia_dinh', 'tp_ban_than', 'dan_toc', 'quoc_tich', 'so_ho_chieu', 'ho_dem', 'ten'], 'string', 'max' => 32],
            [['secret_key'], 'string', 'max' => 255],
            [['anh_nguoi_dung', 'token_web'], 'string', 'max' => 300],
            [['dien_thoai', 'cmnd'], 'string', 'max' => 20],
            [['dia_chi'], 'string', 'max' => 200],
            [['noi_dao_tao', 'khoa', 'dia_chi_cu_the_thuong_tru', 'dia_chi_shk', 'dia_chi_hien_tai', 'noi_sinh'], 'string', 'max' => 150],
            [['ma_so_ho_kho'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['trinh_do_id'], 'exist', 'skipOnError' => true, 'targetClass' => DanhMuc::className(), 'targetAttribute' => ['trinh_do_id' => 'id']],
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
            'username' => 'Tài khoản',
            'password_hash' => 'Mật khẩu',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'secret_key' => 'Secret Key',
            'status' => 'Trạng thái',
            'anh_nguoi_dung' => 'Ảnh đại diện',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'password' => 'Password',
            'hoten' => 'Họ tên',
            'dien_thoai' => 'Điện thoại',
            'ngay_cap' => 'Ngày cấp',
            'dia_chi' => 'Địa chỉ',
            'active' => 'Active',
            'ngay_sinh' => 'Ngày sinh',
            'ghi_chu' => 'Ghi chú',
            'user_id' => 'User ID',
            'trinh_do_id' => 'Trình độ chuyên môn',
            'ngay_nop_ho_so' => 'Ngày nộp hồ sơ',
            'noi_cap' => 'Nơi cấp',
            'ngay_chinh_thuc' => 'Ngày chính thức',
            'so_tai_khoan' => 'Số tài khoản',
            'ngan_hang_id' => 'Ngân hàng',
            'chu_tai_khoan' => 'Chủ tài khoản',
            'token_web' => 'Token Web',
            'gioi_tinh' => 'Giới tính',
            'mst_ca_nhan' => 'Mã số thuế cá nhân',
            'hon_nhan' => 'Hôn nhân',
            'tp_gia_dinh' => 'Tp Gia Dinh',
            'tp_ban_than' => 'Tp Ban Than',
            'dan_toc' => 'Dân tộc',
            'ton_giao' => 'Tôn giáo',
            'quoc_tich' => 'Quốc tịch',
            'cmnd' => 'Căn cước công dân',
            'ngay_cap_cmnd' => 'Ngày cấp Cmnd',
            'noi_cap_cmnd' => 'Nơi cấp Cmnd',
            'ngay_het_han_cmnd' => 'Ngày hết hạn Cmnd',
            'so_ho_chieu' => 'Số hộ chiếu',
            'ngay_cap_ho_chieu' => 'Ngày cấp hộ chiếu',
            'ngay_het_han_ho_chieu' => 'Ngày hết hạn hộ chiếu',
            'noi_cap_ho_chieu' => 'Nơi cấp hộ chiếu',
            'trinh_do_van_hoa' => 'Trình độ văn hóa',
            'noi_dao_tao' => 'Nơi đào tạo',
            'khoa' => 'Khoa',
            'chuyen_nganh_id' => 'Chuyên ngành',
            'nam_tot_nghiep' => 'Năm tốt nghiệp',
            'xep_loai' => 'Xếp hạng',
            'tinh_thanh_tt_id' => 'Tinh Thanh Tt ID',
            'quan_huyen_tt_id' => 'Quan Huyen Tt ID',
            'phuong_xa_tt_id' => 'Phuong Xa Tt ID',
            'dia_chi_cu_the_thuong_tru' => 'Địa chỉ thường trú',
            'ma_so_ho_kho' => 'Ma So Ho Kho',
            'la_chu_ho' => 'La Chu Ho',
            'dia_chi_shk' => 'Dia Chi Shk',
            'dia_chi_so_voi_shk' => 'Dia Chi So Voi Shk',
            'tinh_thanh_hien_tai_id' => 'Tinh Thanh Hien Tai ID',
            'quan_huyen_hien_tai_id' => 'Quan Huyen Hien Tai ID',
            'xa_phuong_hien_tai_id' => 'Xa Phuong Hien Tai ID',
            'dia_chi_hien_tai' => 'Địa chỉ hiện tại',
            'ho_dem' => 'Họ đệm',
            'ten' => 'Tên',
            'ten_khac' => 'Tên khác',
            'noi_sinh' => 'Nơi sinh',
            'uid_may_cham_cong' => 'Uid May Cham Cong',
        ];
    }

//    /**
//     * Gets query for [[VhFileThayDoiLuongs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getVhFileThayDoiLuongs()
//    {
//        return $this->hasMany(VhFileThayDoiLuong::className(), ['user_id' => 'id']);
//    }

//    /**
//     * Gets query for [[OTPUsers]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getOTPUsers()
//    {
//        return $this->hasMany(OTPUser::className(), ['user_id' => 'id']);
//    }

//    /**
//     * Gets query for [[BangLuongs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getBangLuongs()
//    {
//        return $this->hasMany(BangLuong::className(), ['user_id' => 'id']);
//    }

    /**
     * Gets query for [[BaoHiemNhanSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoHiemNhanSus()
    {
        return $this->hasMany(BaoHiemNhanSu::className(), ['user_created_id' => 'id']);
    }

    /**
     * Gets query for [[BaoHiemNhanSus0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoHiemNhanSus0()
    {
        return $this->hasMany(BaoHiemNhanSu::className(), ['user_updated_id' => 'id']);
    }

    /**
     * Gets query for [[ChamCongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChamCongs()
    {
        return $this->hasMany(ChamCong::className(), ['nhan_vien_id' => 'id']);
    }

//    /**
//     * Gets query for [[ChiTietBangLuongs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getChiTietBangLuongs()
//    {
//        return $this->hasMany(ChiTietBangLuong::className(), ['user_id' => 'id']);
//    }
//
//    /**
//     * Gets query for [[ChiTietChamCongThangs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getChiTietChamCongThangs()
//    {
//        return $this->hasMany(ChiTietChamCongThang::className(), ['user_id' => 'id']);
//    }

//    /**
//     * Gets query for [[ChiTietPhuCaps]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getChiTietPhuCaps()
//    {
//        return $this->hasMany(ChiTietPhuCap::className(), ['nhan_vien_id' => 'id']);
//    }

    /**
     * Gets query for [[DuyetNghiPheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDuyetNghiPheps()
    {
        return $this->hasMany(DuyetNghiPhep::className(), ['user_duyet_id' => 'id']);
    }

//    /**
//     * Gets query for [[FileHoSos]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getFileHoSos()
//    {
//        return $this->hasMany(FileHoSo::className(), ['user_id' => 'id']);
//    }

//    /**
//     * Gets query for [[FileHoSos0]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getFileHoSos0()
//    {
//        return $this->hasMany(FileHoSo::className(), ['nhan_su_id' => 'id']);
//    }

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
     * Gets query for [[HopDongNhanSus1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHopDongNhanSus1()
    {
        return $this->hasMany(HopDongNhanSu::className(), ['nguoi_dai_dien_ky_id' => 'id']);
    }

//    /**
//     * Gets query for [[MoiQuanHes]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getMoiQuanHes()
//    {
//        return $this->hasMany(MoiQuanHe::className(), ['nhan_su_id' => 'id']);
//    }

    /**
     * Gets query for [[NghiPheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNghiPheps()
    {
        return $this->hasMany(NghiPhep::className(), ['nguoi_lam_don_id' => 'id']);
    }

    /**
     * Gets query for [[NghiPheps0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNghiPheps0()
    {
        return $this->hasMany(NghiPhep::className(), ['user_id' => 'id']);
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

//    /**
//     * Gets query for [[ThayDoiLuongs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getThayDoiLuongs()
//    {
//        return $this->hasMany(ThayDoiLuong::className(), ['user_id' => 'id']);
//    }

    /**
     * Gets query for [[ThongBaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThongBaos()
    {
        return $this->hasMany(ThongBao::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ThongBaos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThongBaos0()
    {
        return $this->hasMany(ThongBao::className(), ['user_created' => 'id']);
    }

    /**
     * Gets query for [[TokenNotifies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokenNotifies()
    {
        return $this->hasMany(TokenNotify::className(), ['user_id' => 'id']);
    }

//    /**
//     * Gets query for [[TrangThaiBangLuongs]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getTrangThaiBangLuongs()
//    {
//        return $this->hasMany(TrangThaiBangLuong::className(), ['user_id' => 'id']);
//    }

    /**
     * Gets query for [[TrangThaiDkNhuCauNs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrangThaiDkNhuCauNs()
    {
        return $this->hasMany(TrangThaiDkNhuCauNs::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TrangThaiNghiPheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrangThaiNghiPheps()
    {
        return $this->hasMany(TrangThaiNghiPhep::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TrangThaiNghiPheps0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrangThaiNghiPheps0()
    {
        return $this->hasMany(TrangThaiNghiPhep::className(), ['user_duyet_id' => 'id']);
    }

    /**
     * Gets query for [[TuyenDungDkNhuCauNs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTuyenDungDkNhuCauNs()
    {
        return $this->hasMany(TuyenDungDkNhuCauNs::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TuyenDungDkNhuCauNs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTuyenDungDkNhuCauNs0()
    {
        return $this->hasMany(TuyenDungDkNhuCauNs::className(), ['truong_phong_nguoi_duyet_id' => 'id']);
    }

    /**
     * Gets query for [[TuyenDungDkNhuCauNs1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTuyenDungDkNhuCauNs1()
    {
        return $this->hasMany(TuyenDungDkNhuCauNs::className(), ['de_xuat_nguoi_phong_van_id' => 'id']);
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

    public function getVaiTro(){
        return $this->hasMany(VaiTro::className(), ['id' => 'vaitro_id'])
            ->viaTable('vh_vaitrouser', ['user_id' => 'id']);
    }




    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function beforeSave($insert)
    {

        if ($insert){
            $this->created_at = date("Y-m-d H:i:s");
        }
        else {
            if(!empty($this->password_hash) && $this->getOldAttribute('password_hash') != $this->password_hash){
                $this->setPassword($this->password_hash);
                if(isset(Yii::$app->session)){
                    $session = Yii::$app->session;
                    unset($session['old_id']);
                    unset($session['timestamp']);
                    $session->destroy();
                }
            }
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        if(isset($_POST['Vaitrouser'])) {
            $vaitro = Vaitrouser::findAll(['user_id' => $this->id]);
            foreach ($vaitro as $item) {
                $item->delete();
            }
            foreach ($_POST['Vaitrouser'] as $item) {
                $vaitronguoidung = new Vaitrouser();
                $vaitronguoidung->vaitro_id = $item;
                $vaitronguoidung->user_id = $this->id;
                if(!$vaitronguoidung->save()){
                    throw new HttpException(500, Html::errorSummary($vaitronguoidung));
                }
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function isAccess($arrRoles){
        return !is_null(Vaitrouser::find()->andFilterWhere(['in', 'vaitro', $arrRoles])->andFilterWhere(['user_id' => Yii::$app->user->getId()])->one());
//        return 1;
    }


    public function beforeDelete()
    {
        Vaitrouser::deleteAll(['user_id' => $this->id]);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public static function getNumberNotification(){
        return 0;
    }

}
