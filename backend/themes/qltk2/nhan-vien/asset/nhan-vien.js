$(document).ready(function () {

    $(document).on('click','.btn-delete', function (e){
        e.preventDefault()
        loadForm('index.php?r=nhan-vien/delete', { id: $(this).attr('data-value') }, 'm',
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
                    mess:'Xóa phiếu nhân viên thành công'
                }
            })
    })

    // $(document).on('click', '.btn-sua-nhan-vien', function (e){
    //     loadForm('index.php?r=nhan-vien/load-form-update',{ id: $(this).attr('data-value'),
    //             urlloadform: '../tuyen-dung-dk-nhu-cau-ns/form_pop_up'}, 'xl',
    //         function (){},
    //         function () {},{
    //             btnSave:{
    //                 class:'btn btn-success btn-luu-nhan-vien',
    //                 text:'<i class="fa fa-check-circle"></i> Lưu',
    //                 action:true,
    //                 ajax: false,
    //                 data:{id: $(this).attr('data-value')},
    //                 mess:'Cập nhật trạng thái phiếu dụng thành công'
    //             }
    //         })
    // })

    $(document).on('change', '#nhanvien-retypenewpassword', function (){
        if($("#nhanvien-newpassword").val() != $("#nhanvien-retypenewpassword").val()) {
            alertify.error("Nhập lại mật khẩu mới không trùng khớp");
            $("#nhap-lai-matkhaumoi").focus();
            $(".btn-luu-nhan-vien").prop('disabled', true)
        } else {
            $(".btn-luu-nhan-vien").prop('disabled', false)
        }
    })

    // $(document).on('click', '.btn-luu-nhan-vien', function (e){
    //     e.preventDefault()
    //     var form_data = new FormData()
    //     // var hinhThucDangKi = []
    //     form_data.append('id', $('#id_user').val())
    //     form_data.append('hoten', $('#nhanvien-hoten').val())
    //     form_data.append('dien_thoai', $('#nhanvien-dien_thoai').val())
    //     form_data.append('email', $('#nhanvien-email').val())
    //     form_data.append('ngay_sinh', $('#nhanvien-ngay_sinh').val())
    //     form_data.append('cmnd', $('#nhanvien-cmnd').val())
    //     form_data.append('ngay_cap', $('#nhanvien-ngay_cap').val())
    //     form_data.append('username', $('#nhanvien-username').val())
    //     form_data.append('password_hash', $('#nhanvien-newpassword').val())
    //     form_data.append('newavatar', $('#nhanvien-newavatar')[0].files[0])
    //     $.ajax({
    //         type: 'POST',
    //         url: 'index.php?r=nhan-vien/sua-nhan-vien',
    //         data: form_data,
    //         dataType: 'json',
    //         processData: false,  // tell jQuery not to process the data
    //         contentType: false,
    //         beforeSend: function () {
    //         },
    //         success: function (data) {
    //             alertify.success(data.message);
    //             $.pjax.reload({container: "#crud-datatable-pjax"});
    //         },
    //         error: function (r1){
    //             alertify.error(r1.responseText);
    //         }
    //     })
    // })

})

