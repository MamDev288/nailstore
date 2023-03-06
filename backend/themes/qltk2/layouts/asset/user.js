$(document).ready(function () {
    $(document).on('click', '.btn-ho-so-ca-nhan', function (e) {
        e.preventDefault()
        loadForm('index.php?r=user/load-form-ho-so-ca-nhan', {
                id: $(this).attr('data-value'),
                urlloadform: ''
            }, 'l',
            function () {
            },
            function () {
            }, {
                btnSave: {
                    class: 'btn btn-primary btn-luu-thong-tin-ca-nhan',
                    text: '<i class="fa fa-save"></i> Lưu',
                    action: true,
                    ajax: false,
                    data: {},
                    mess: 'Cập nhật hồ sơ người dùng thành công'
                },
            })
    })

    $(document).on('click', '.btn-luu-thong-tin-ca-nhan', function () {
        $.ajax({
            type: 'POST',
            url: 'index.php?r=user/luu-thong-tin-ca-nhan',
            data: {
                id: $('#id_user').val(),
                hoten: $('#user-hoten').val(),
                ngay_sinh: $('#user-ngay_sinh').val(),
                dien_thoai: $('#user-dien_thoai').val(),
                email: $('#user-email').val(),
                so_tai_khoan: $('#user-so_tai_khoan').val(),
                chu_tai_khoan: $('#user-chu_tai_khoan').val(),
                cmnd: $('#user-cmnd').val(),
                dia_chi: $('#user-dia_chi').val()
            },
            dataType: 'json',
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
