$(document).ready(function () {
    $("#ajaxCrudModal").on('shown.bs.modal', function (e) {
        setTimeout(function(){
            $("#danhmuc-parent_id").select2();
        }, 100);
    });

    $(document).on('change','#danhmuc-type',function (e) {
        var type = $('#danhmuc-type option:selected').text();
        if(type === 'Đường phố'){
            $('#parent_id').removeClass('hidden');
            $('#duong_pho').removeClass('hidden');
        }else {
            $('#parent_id').addClass('hidden');
            $('#duong_pho').addClass('hidden');
        }
    });
})