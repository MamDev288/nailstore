function changeKhuVuc($type, $object) {
    $.ajax({
        type: "POST",
        url: 'index.php?r=danh-muc/get-khu-vuc',
        data: { value: $type},
        dataType: 'json',
        beforeSend: function() {
            Metronic.blockUI();
        },
        success:function( response ) {
            if(response != ''){
                $object.html('<option value="">-- Chọn --</option>');
                $.each(response, function (k, value) {
                    $object.append('<option value="'+ value.id+'">'+value.name +'</option>');
                });
            }
        },complete: function(response) {
            Metronic.unblockUI();
        },
    });
}

$(document).ready(function () {
    $('#sanpham-quan_id, #sanpham-duong_pho_id, #sanpham-huong').select2();

    $(document).on('keypress','#sanpham-duong, #sanpham-so_can, #sanpham-so_tang, #sanpham-dien_thoai_chu_nha',function (event) {
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57)) {
            event.preventDefault();
        }
    });

    $(document).on('keypress','#sanpham-chieu_dai, #sanpham-chieu_rong, #sanpham-gia, #sanpham-dien_tich',function (event) {
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57  || keycode == 46)) {
            event.preventDefault();
        }
    });

    $(document).on('change', '#sanpham-quan_id', function () {
        $('#sanpham-duong_pho_id').val('').trigger('change');
        $('#sanpham-duong_pho_id').empty();
        changeKhuVuc($(this).val(), $('#sanpham-duong_pho_id'));
    });
})
