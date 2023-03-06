<?php
namespace backend\helpers;

class ConstHelper{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const GIOI_TINH_LABEL = [
        0 => 'Nam',
        1 => 'Nữ'
    ];

    const BUTTON_LABEL_CLOSE = 'Đóng';
    const BUTTON_LABEL_BACK = 'Quay lại';
    const BUTTON_LABEL_SAVE = 'Lưu';
    const BUTTON_LABEL_CREATE = 'Thêm';
    const BUTTON_LABEL_EDIT = 'Sửa';

    const DAY_THU2 = 'Thứ 2';
    const DAY_THU3 = 'Thứ 3';
    const DAY_THU4 = 'Thứ 4';
    const DAY_THU5 = 'Thứ 5';
    const DAY_THU6 = 'Thứ 6';
    const DAY_THU7 = 'Thứ 7';
    const DAY_CHUNHAT = 'Chủ nhật';
    const LOAI_HOP_DONG = 'Loại hợp đồng';
    const TEN_HOP_DONG = 'Tên hợp đồng';

    const TYPE_CA_NGAY = 1;
    const TYPE_NUA_NGAY = 2;
    const TYPE_TAT_CA_NGAY = 0;

    const NGHIPHEP_STATUS_CHO_DUYET = "Chờ duyệt";
    const NGHIPHEP_STATUS_DUYET = "Duyệt";
    const NGHIPHEP_STATUS_TU_CHOI = "Từ chối";
    const NGHIPHEP_STATUS_HUY = "Hủy";

    const NGHIPHEP_LOAI_NGHI_CO_LUONG = "Nghỉ có lương";
    const NGHIPHEP_LOAI_NGHI_KHONG_LUONG = "Nghỉ không lương";

    const FOOTER_EMAIL = "footer_email";

    const YOUR_NAME = '[your_name]';
    const YOUR_MOBILE_PHONE = '[your_mobile_phone]';
    const YOUR_TELEPHONE = '[your_telephone]';
    const YOUR_EMAIL = '[your_email]';

    const LOAIHOPDONG_DONVITINH_THANG = "Tháng";
    const LOAIHOPDONG_DONVITINH_NAM = "Năm";
    const LOAIHOPDONG_DONVITINH_VOTHOIHAN = "Vô thời hạn";
    
    const TITLE_THONG_BAO_TD = "Thông báo từ hệ thống";
    const TITLE_THONG_BAO_NGHI_PHEP = "Thông báo từ hệ thống";
}