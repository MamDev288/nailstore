$(document).ready(function () {
    $(document).on('click','.btn-duyet-phieu', function (e){
        e.preventDefault()
        console.log('hádkjhasd')
        loadForm('index.php?r=duyet-don-dang-ki-tuyen-dung/loadformduyetphieu',{ id: $(this).attr('data-value'),
                urlloadform: '../ke-hoach-tuyen-dung/form_pop_up'}, 'm',
            function (){},
            function () {},{
                btnSave:{
                    class:'btn btn-primary',
                    text:'<i class="fa fa-check-circle"></i> Duyệt',
                    action:true,
                    ajax: true,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 'KH đã duyệt',
                        type: 'Kế hoạch'
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                },
                somethingElse:{
                    class:'btn btn-danger',
                    text:'<i class="fa fa-ban"></i> Không duyệt',
                    action:true,
                    ajax: true,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 'KH không duyệt',
                        type: 'Kế hoạch'
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                }
            })
    })

    $(document).on('click','.btn-delete', function (e){
        e.preventDefault()
        loadForm('index.php?r=tuyen-dung-dk-nhu-cau-ns/delete', { id: $(this).attr('data-value') }, 'm',
            function (){},
            function () {}, {
                cancel: {
                    class:'btn btn-danger',
                    text:'<i class="fa fa-trash"></i> Xóa',
                    action:true,
                    ajax: true,
                    data:{
                        id: $(this).attr('data-value'),
                        trangThai: 'dong-y-xoa'
                    },
                    mess:'Xóa phiếu tuyển dụng thành công'
                }
            })
    })
    $(document).on('click','.btn-lap-ke-hoach-tuyen-dung', function (e){
        e.preventDefault()
        loadForm('index.php?r=ke-hoach-tuyen-dung/lap-ke-hoach', { id: $(this).attr('data-value') }, 'xl',
            function (){},
            function () {}, {
                btnSave:{
                    class:'btn btn-primary btn-luu-ke-hoach-tuyen-dung',
                    text:'<i class="fa fa-check-circle"></i> Lưu lại',
                    action:true,
                    ajax: false,
                    data:{id: $(this).attr('data-value'),
                    },
                    mess:'Lập kế hoạch thành công'
                },
            })
    })

    $(document).on('click','.btn-xem-chi-tiet-kh-tuyen-dung', function (e){
        e.preventDefault()
        loadForm('index.php?r=ke-hoach-tuyen-dung/xem-ke-hoach-tuyen-dung', { id: $(this).attr('data-value') }, 'xl',
            function (){},
            function () {}, {
            })
    })
    $(document).on('click','.btn-sua-ke-hoach-tuyen-dung', function (e){
        e.preventDefault()
        loadForm('index.php?r=ke-hoach-tuyen-dung/sua-ke-hoach-tuyen-dung', { id: $(this).attr('data-value') }, 'xl',
            function (){},
            function () {}, {
                btnSave:{
                    class:'btn btn-primary btn-luu-ke-hoach-tuyen-dung',
                    text:'<i class="fa fa-check-circle"></i> Lưu lại',
                    action:true,
                    ajax: false,
                    data:{id: $(this).attr('data-value'),
                    },
                    mess:'Sửa thành công kế hoạch tuyển dụng'
                },
            })
    })

    $(document).on('click', '.btn-luu-ke-hoach-tuyen-dung', function(e){
        e.preventDefault()
        var form_data = new FormData()
        // var hinhThucDangKi = []
        form_data.append('id', $('#quanlytuyendungnhucaunsuser-id').val())
        form_data.append('hinhThucDangKy',$('input[name="KhHinhThucDangKy[]"]:checked').map(function() {return this.value;}).get());
        // $('input[name="KhHinhThucDangKy[]"]:checked').each(function() {
        //     form_data.append('hinhThucDangKy',this.value)
        // });
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
            },
            success: function (data) {
                alertify.success(data.message);
                $.pjax.reload({container: "#crud-datatable-pjax"});
            },
            error: function (r1){
                alertify.error(r1.responseText);
            }
        })
    })
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
