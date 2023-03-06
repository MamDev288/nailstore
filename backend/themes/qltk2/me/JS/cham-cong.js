$(document).on('ready', function(){
    $(document).on('click', '.btn-cham-cong', function () {
        var formData = new FormData()
        formData.append('uid' , $('#user_logged_id').val())
        formData.append('type' , 'may_tinh')
        // $.ajax({
        //     type: 'GET',
        //     url: 'https://api.ipify.org/?format=json',
        //     data: {},
        //     dataType: 'json',
        //     processData: false,
        //     contentType: false,
        //     beforeSend: function () {
        //     },
        //     success: function (ip){
        //         formData.append('ip', ip.ip)
        $.ajax({
            type: 'POST',
            url: 'api/cham-cong/cham-cong?timestamp=' + Math.floor(Date.now() / 1000),
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function () {
            },
            success: function (data){
                alertify.success(data.message);
                // $.pjax.reload({container: "#crud-datatable-pjax"});
                location.reload();
            },
            error: function (r1) {
                // console.log(JSON.parse(r1.responseText).message)
                alertify.error(JSON.parse(r1.responseText).message);
            }
        })
        //     },
        //     error: function (r1) {
        //         // console.log(JSON.parse(r1.responseText).message)
        //         alertify.error(JSON.parse(r1.responseText).message);
        //     }
        // })
    })
})