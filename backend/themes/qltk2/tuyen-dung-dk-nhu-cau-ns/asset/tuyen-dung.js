$(document).ready(function () {
    $(document).on('click', '.btn-duyet-phieu', function (e) {
        e.preventDefault()
        loadForm('index.php?r=duyet-don-dang-ki-tuyen-dung/loadformduyetphieu', {
                id: $(this).attr('data-value'),
                urlloadform: '../tuyen-dung-dk-nhu-cau-ns/form_pop_up'
            }, 'xl',
            function () {
            },
            function () {
            }, {
                btnSave: {
                    class: 'btn btn-success btn-duyet-don-tuyen-dung',
                    text: '<i class="fa fa-check-circle"></i> Lưu',
                    action: true,
                    ajax: false,
                    data: {
                        id: $(this).attr('data-value'),
                        trangThai: 'Đã duyệt',
                        type: 'Tuyền dụng'
                    },
                    mess: 'Cập nhật trạng thái phiếu dụng thành công'
                }
            })
    })

    $(document).on('click', '.btn-delete', function (e) {
        console.log('kjdjkadsjkdskjsdajjsda')
        e.preventDefault()
        loadForm('index.php?r=tuyen-dung-dk-nhu-cau-ns/delete', {id: $(this).attr('data-value')}, 'm',
            function () {
            },
            function () {
            }, {
                cancel: {
                    class: 'btn btn-danger',
                    text: '<i class="fa fa-trash"></i> Xóa',
                    action: true,
                    ajax: true,
                    data: {
                        id: $(this).attr('data-value'),
                        trangThai: 'dong-y-xoa'
                    },
                    mess: 'Xóa phiếu tuyển dụng thành công'
                }
            })
    })
    $(document).on('click', '.btn-lap-ke-hoach-tuyen-dung', function (e) {
        e.preventDefault()
        loadForm('index.php?r=ke-hoach-tuyen-dung/lap-ke-hoach', {id: $(this).attr('data-value')}, 'xl',
            function () {
            },
            function () {
            }, {
                btnSave: {
                    class: 'btn btn-primary btn-luu-ke-hoach-tuyen-dung',
                    text: '<i class="fa fa-check-circle"></i> Lưu lại',
                    action: true,
                    ajax: false,
                    data: {
                        id: $(this).attr('data-value'),
                    },
                    mess: 'Lập kế hoạch thành công'
                },
            })
    })

    $(document).on('click', '.btn-xem-chi-tiet-kh-tuyen-dung', function (e) {
        e.preventDefault()
        loadForm('index.php?r=ke-hoach-tuyen-dung/xem-ke-hoach-tuyen-dung', {id: $(this).attr('data-value')}, 'xl',
            function () {
            },
            function () {
            }, {})
    })
    $(document).on('click', '.btn-sua-ke-hoach-tuyen-dung', function (e) {
        e.preventDefault()
        loadForm('index.php?r=ke-hoach-tuyen-dung/sua-ke-hoach-tuyen-dung', {id: $(this).attr('data-value')}, 'xl',
            function () {
            },
            function () {
            }, {
                btnSave: {
                    class: 'btn btn-primary btn-luu-ke-hoach-tuyen-dung',
                    text: '<i class="fa fa-check-circle"></i> Lưu lại',
                    action: true,
                    ajax: false,
                    data: {
                        id: $(this).attr('data-value'),
                    },
                    mess: 'Sửa thành công kế hoạch tuyển dụng'
                },
            })
    })

    $(document).on('click', '.btn-luu-ke-hoach-tuyen-dung', function (e) {
        e.preventDefault()
        var form_data = new FormData()
        // var hinhThucDangKi = []
        form_data.append('id', $('#quanlytuyendungnhucaunsuser-id').val())
        form_data.append('hinhThucDangKy', $('input[name="KhHinhThucDangKy[]"]:checked').map(function () {
            return this.value;
        }).get());
        form_data.append('kh_nguoi_lap_ke_hoach_id', $('#quanlytuyendungnhucaunsuser-kh_nguoi_lap_ke_hoach_id').val())
        form_data.append('phong_ban_id', $('#quanlytuyendungnhucaunsuser-phong_ban_id').val())
        form_data.append('kh_ngay_lap_ke_hoach', $('#quanlytuyendungnhucaunsuser-kh_ngay_lap_ke_hoach').val())
        form_data.append('kh_de_xuat_cb_pv_chuyen_mon', $('#quanlytuyendungnhucaunsuser-kh_de_xuat_cb_pv_chuyen_mon').val())
        form_data.append('kh_hinh_thuc_tuyen_dung', $('#quanlytuyendungnhucaunsuser-kh_hinh_thuc_tuyen_dung').val())
        form_data.append('kh_tien_trinh_bo_sung_nhan_su', $('#quanlytuyendungnhucaunsuser-kh_tien_trinh_bo_sung_nhan_su').val())
        $.ajax({
            type: 'POST',
            url: 'index.php?r=ke-hoach-tuyen-dung/luu-ke-hoach-tuyen-dung',
            data: form_data,
            dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            beforeSend: function () {
                console.log('ádasas')
            },
            success: function (data) {
                alertify.success(data.message);
                $.pjax.reload({container: "#crud-datatable-pjax"});
            },
            error: function (r1) {
                alertify.error(r1.responseText);
            }
        })
    })

    $(document).on('click', '.btn-duyet-don-tuyen-dung', function (e) {
        e.preventDefault()
        var form_data = new FormData()
        // var hinhThucDangKi = []
        form_data.append('id', $('#duyetdondangkituyendungvaitro-dang_ki_tuyen_dung_nhu_cau_id').val())
        form_data.append('trang_thai', $('#duyetdondangkituyendungvaitro-trang_thai').val())
        form_data.append('ngay_duyet', $('#duyetdondangkituyendungvaitro-ngay_duyet').val())
        form_data.append('ghi_chu', $('#duyetdondangkituyendungvaitro-ghi_chu').val())
        form_data.append('type', 'Tuyển dụng')
        $.ajax({
            type: 'POST',
            url: 'index.php?r=duyet-don-dang-ki-tuyen-dung/loadformduyetphieu',
            data: form_data,
            dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            beforeSend: function () {
                console.log('ádasas')
            },
            success: function (data) {
                alertify.success(data.message);
                $.pjax.reload({container: "#crud-datatable-pjax"});
            },
            error: function (r1) {
                alertify.error(r1.responseText);
            }
        })
    })

    const tuyenDungFormId = '#form-ke-hoach-tuyen-dung';

    function handleChangeForm() {
        $(document).on('change', '#tuyendungdknhucauns-phong_ban_id', function () {
            let tuyenDungWrapClass = '.tuyen-dung-dk-nhu-cau-ns-create';
            if (!$(document).find(tuyenDungWrapClass)) {
                tuyenDungWrapClass = '.tuyen-dung-dk-nhu-cau-ns-update';
            }
            const data = $(`${tuyenDungFormId}`).serialize()

            $.ajax({
                type: 'POST',
                url: 'index.php?r=tuyen-dung-dk-nhu-cau-ns/reload-data',
                data,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (res) {
                    if (res.success) {
                        if(modal) {
                            if ($(modal.footer).find('[type="submit"]')[0]) {
                                var clone = $(modal.footer).find('[type="submit"]').clone();
                                $(modal.footer).find('[type="submit"]').remove();
                                // console.log($(modal.footer).find('[type="submit"]')[0])
                                $(modal.footer).append(clone);
                            }

                            $('body').find(tuyenDungWrapClass).html(res.html);
                            if ($(modal.content).find("form")[0] !== undefined) {
                                modal.setupFormSubmit(
                                    $(modal.content).find("form")[0],
                                    $(modal.footer).find('[type="submit"]')[0]
                                );
                            }

                        }
                    }
                },
                error: function (r1) {
                    alertify.error(r1.responseText);
                }
            })
        })
    }

    handleChangeForm()

})
// $(document).ready(function () {
//     $(document).on('click','.btn-duyet-phieu', function (e){
//         e.preventDefault()
//         loadForm({type: 'duyet_phieu_tuyen_dung', id: $(this).attr('data-value')}, 'm',
//             function (){},
//             function () {})
//     })
//
// })
// {button1:{class:'a'
//     ,text:"a",
//     action:true,
// url:'',
// data:{}},
// mess:''
// ,messerr:''}

// {type: 'duyet_phieu_tuyen_dung', id: $(this).attr('data-value')}
