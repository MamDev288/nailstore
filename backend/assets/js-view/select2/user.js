let url = 'index.php?r=phong-ban-nhan-vien/add-user';
let formid = "#phong-ban-nhan-vien-add";
let datainput = {type: 'them_nhan_vien_phong_ban'};
function loadformAjax(url,formid,datainput,sizeBtn ='l') {
    $(document).ready(function () {//

        $(document).on('click', '.btn-save', function (e) {
            e.preventDefault();

            loadForm( datainput,sizeBtn, function (data) {

            }, function () {
                $.ajax({
                    url: url,
                    data: $(formid).serializeArray(),
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function () {
                        $('.thongbao').html('');
                    },
                    success: function (data) {

                    },
                    error: function (r1, r2) {
                        $('.thongbao').html(r1.responseText)
                    },
                })

            })
        });
    });
}
loadformAjax('index.php?r=phong-ban-nhan-vien/add-user',"#phong-ban-nhan-vien-add",{type: 'them_nhan_vien_phong_ban',});