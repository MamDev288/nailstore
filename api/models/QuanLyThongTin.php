<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%quan_ly_thong_tin}}".
 *
 * @property int $id
 * @property string|null $hoten
 * @property string|null $username
 * @property string|null $email
 * @property string|null $anh_nguoi_dung
 * @property string|null $dien_thoai
 * @property string|null $ngay_cap
 * @property string|null $dia_chi
 * @property int|null $active
 * @property string|null $ngay_sinh
 * @property string|null $ghi_chu
 * @property string|null $ten_trinh_do
 * @property string|null $ngay_nop_ho_so Nếu ngày nộp HS <> null thì coi như đã nộp hồ sơ
 * @property string|null $noi_cap
 * @property string|null $ngay_chinh_thuc
 * @property string|null $so_tai_khoan
 * @property string|null $ngan_hang
 * @property string|null $chu_tai_khoan
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
 * @property string|null $chuyen_nganh
 * @property string|null $nam_tot_nghiep
 * @property string|null $xep_loai
 * @property string|null $tinh_thanh_tt
 * @property string|null $quan_huyen_tt
 * @property string|null $phuong_xa_tt
 * @property string|null $dia_chi_cu_the_thuong_tru
 * @property string|null $ma_so_ho_kho Mã sổ hộ khẩu 
 * @property int|null $la_chu_ho
 * @property string|null $dia_chi_shk
 * @property int|null $dia_chi_so_voi_shk Chỗ ở hiện tại có giống với Sổ hộ khẩu không
 * @property string|null $tinh_thanh_hien_tai
 * @property string|null $quan_huyen_hien_tai
 * @property string|null $xa_phuong_hien_tai
 * @property string|null $dia_chi_hien_tai
 */
class QuanLyThongTin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quan_ly_thong_tin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'gioi_tinh', 'trinh_do_van_hoa', 'la_chu_ho', 'dia_chi_so_voi_shk'], 'integer'],
            [['ngay_cap', 'ngay_sinh', 'ngay_nop_ho_so', 'ngay_chinh_thuc', 'ngay_cap_cmnd', 'ngay_het_han_cmnd', 'ngay_cap_ho_chieu', 'ngay_het_han_ho_chieu', 'nam_tot_nghiep'], 'safe'],
            [['ghi_chu', 'noi_cap', 'hon_nhan', 'ton_giao', 'xep_loai'], 'string'],
            [['hoten', 'username', 'email', 'ten_trinh_do', 'so_tai_khoan', 'ngan_hang', 'chu_tai_khoan', 'noi_cap_cmnd', 'noi_cap_ho_chieu', 'chuyen_nganh', 'tinh_thanh_tt', 'quan_huyen_tt', 'phuong_xa_tt', 'tinh_thanh_hien_tai', 'quan_huyen_hien_tai', 'xa_phuong_hien_tai'], 'string', 'max' => 100],
            [['anh_nguoi_dung'], 'string', 'max' => 300],
            [['dien_thoai', 'cmnd'], 'string', 'max' => 20],
            [['dia_chi'], 'string', 'max' => 200],
            [['mst_ca_nhan', 'tp_gia_dinh', 'tp_ban_than', 'dan_toc', 'quoc_tich', 'so_ho_chieu'], 'string', 'max' => 32],
            [['noi_dao_tao', 'khoa', 'dia_chi_cu_the_thuong_tru', 'dia_chi_shk', 'dia_chi_hien_tai'], 'string', 'max' => 150],
            [['ma_so_ho_kho'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hoten' => 'Hoten',
            'username' => 'Username',
            'email' => 'Email',
            'anh_nguoi_dung' => 'Anh Nguoi Dung',
            'dien_thoai' => 'Dien Thoai',
            'ngay_cap' => 'Ngay Cap',
            'dia_chi' => 'Địa Chi',
            'active' => 'Active',
            'ngay_sinh' => 'Ngay Sinh',
            'ghi_chu' => 'Ghi Chu',
            'ten_trinh_do' => 'Ten Trinh Do',
            'ngay_nop_ho_so' => 'Ngay Nop Ho So',
            'noi_cap' => 'Nơi Cấp',
            'ngay_chinh_thuc' => 'Ngay Chinh Thuc',
            'so_tai_khoan' => 'So Tai Khoan',
            'ngan_hang' => 'Ngan Hang',
            'chu_tai_khoan' => 'Chu Tai Khoan',
            'gioi_tinh' => 'Gioi Tinh',
            'mst_ca_nhan' => 'Mst Ca Nhan',
            'hon_nhan' => 'Hon Nhan',
            'tp_gia_dinh' => 'Tp Gia Dinh',
            'tp_ban_than' => 'Tp Ban Than',
            'dan_toc' => 'Dan Toc',
            'ton_giao' => 'Ton Giao',
            'quoc_tich' => 'Quoc Tich',
            'cmnd' => 'Cmnd',
            'ngay_cap_cmnd' => 'Ngay Cap Cmnd',
            'noi_cap_cmnd' => 'Noi Cap Cmnd',
            'ngay_het_han_cmnd' => 'Ngay Het Han Cmnd',
            'so_ho_chieu' => 'So Ho Chieu',
            'ngay_cap_ho_chieu' => 'Ngay Cap Ho Chieu',
            'ngay_het_han_ho_chieu' => 'Ngay Het Han Ho Chieu',
            'noi_cap_ho_chieu' => 'Noi Cap Ho Chieu',
            'trinh_do_van_hoa' => 'Trinh Do Van Hoa',
            'noi_dao_tao' => 'Noi Dao Tao',
            'khoa' => 'Khoa',
            'chuyen_nganh' => 'Chuyen Nganh',
            'nam_tot_nghiep' => 'Nam Tot Nghiep',
            'xep_loai' => 'Xep Loai',
            'tinh_thanh_tt' => 'Tinh Thanh Tt',
            'quan_huyen_tt' => 'Quan Huyen Tt',
            'phuong_xa_tt' => 'Phuong Xa Tt',
            'dia_chi_cu_the_thuong_tru' => 'Dia Chi Cu The Thuong Tru',
            'ma_so_ho_kho' => 'Ma So Ho Kho',
            'la_chu_ho' => 'La Chu Ho',
            'dia_chi_shk' => 'Dia Chi Shk',
            'dia_chi_so_voi_shk' => 'Dia Chi So Voi Shk',
            'tinh_thanh_hien_tai' => 'Tinh Thanh Hien Tai',
            'quan_huyen_hien_tai' => 'Quan Huyen Hien Tai',
            'xa_phuong_hien_tai' => 'Xa Phuong Hien Tai',
            'dia_chi_hien_tai' => 'Dia Chi Hien Tai',
        ];
    }
}
