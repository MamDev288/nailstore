/**
 * Created by hungluong on 7/24/17.
 */

$(document).ready(function () {
    $(document).on('click', '.btn-doimatkhau', function (e) {
        e.preventDefault();
        $("#modal-doimatkhau").modal('show');
    });

    $(document).on('click', '.btn-thuchiendoimatkhau', function (e) {
        e.preventDefault();
        if($("#mat-khau-cu").val() == ''){
            alertify.error("Chưa nhập mật khẩu cũ");
            $("#mat-khau-cu").focus();
        }else if($("#mat-khau-moi").val().length < 6){
            alertify.error("Mật khẩu mới phải ít nhất 6 kí tự");
            $("#mat-khau-moi").focus();
        }else if($("#nhap-lai-matkhaumoi").val() != $("#mat-khau-moi").val()){
            alertify.error("Nhập lại mật khẩu mới không trùng khớp");
            $("#nhap-lai-matkhaumoi").focus();
        }else if ($("#mat-khau-cu").val() === $("#mat-khau-moi").val()){
            alertify.error("Mật khẩu mới không được giống mật khẩu cũ");
            $("#mat-khau-moi").focus();
        }
        else{
            $.ajax({
                url: 'index.php?r=site/doimatkhau',
                data: $("#form-doimatkhau").serializeArray(),
                dataType:'json',
                type: 'post',
                beforeSend: function () {
                    Metronic.blockUI({target: "#modal-doimatkhau .modal-content"});
                    $('.thongbao').html('');
                },
                success: function (data) {
                    alertify.success(data.message);
                    window.location = 'index.php?r=site/logout';
                },
                error: function (r1, r2) {
                    alertify.error(r1.responseText);
                },
                complete: function () {
                    Metronic.unblockUI("#modal-doimatkhau .modal-content");
                }
            })
        }
    })

    $('#xem-mat-khau-cu').on('click', function(e){
        e.preventDefault()
        if ($('#mat-khau-cu').attr('type') === 'password' ){
            $('#mat-khau-cu').attr('type', 'text')
        } else {
            $('#mat-khau-cu').attr('type', 'password')
        }
    })

    $('#xem-mat-khau-moi').on('click', function(e){
        e.preventDefault()
        if ($('#mat-khau-moi').attr('type') === 'password' ){
            $('#mat-khau-moi').attr('type', 'text')
        } else {
            $('#mat-khau-moi').attr('type', 'password')
        }
    })

    $('#xem-mat-khau-nhap-lai').on('click', function(e){
        e.preventDefault()
        if ($('#nhap-lai-matkhaumoi').attr('type') === 'password' ){
            $('#nhap-lai-matkhaumoi').attr('type', 'text')
        } else {
            $('#nhap-lai-matkhaumoi').attr('type', 'password')
        }
    })

    if ($("#modal-doimatkhau").is(':visible') === 'false'){
        $('#mat-khau-cu').val('')
        $('#mat-khau-moi').val('')
        $('#nhap-lai-matkhaumoi').val('')
    }

});