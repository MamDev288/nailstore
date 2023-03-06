$(document).ready(function (){
    $.ajax({
        url: 'index.php?r=san-pham/load-danh-sach-san-pham',
        datatType: 'json',
        type: 'post',
        beforeSend: function (){
            Metronic.blockUI({animate: true});
        },
        success: function (data){
            $.each(data, function (k, obj){
                if($(".table-san-pham").find('#block-san-pham-'+ obj.model.id).length == 0){
                    $(".table-san-pham").find('#'+obj.viTri).append(
                        obj.modelHtml
                    )
                }
            });

            setTimeout(function (){
                $( ".table-san-pham tbody tr td.allow-move" ).sortable({
                    connectWith: ".san-pham tbody tr td.allow-move",
                    handle: ".move-block",
                    cancel: ".portlet-toggle",
                    placeholder: "portlet-placeholder ui-corner-all"
                });
            }, 1000);
        },
        complete: function (){
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            console.log(r1.responseText)
        }
    });

    $(document).on('click', '.btn-them-san-pham', function (e){
        $("#form-san-pham").reset;
        $("#modal-form-san-pham").modal('show');
    });

    $(document).on("sortupdate", ".san-pham tbody tr td.allow-move", function (event, ui) {
        console.log(event.target);
        var $idSanPham = event.target.innerHTML.match(/block-san-pham-\d+/g)[0].replace("block-san-pham-","");
        $.ajax({
            url: 'index.php?r=san-pham/update-trang-thai',
            data: {
                sanPham: $idSanPham,
                newPosition: event.target.id
            },
            dataType: 'json',
            type: 'post',
            success: function (data){
                $('.thongbao').html(data.content);
            }
        })
    });

    if($("#sanpham-quan_id").length > 0)
        $("#sanpham-quan_id").select2();

    $(document).on('change', '#sanpham-quan_id', function (e){
        $.ajax({
            url: 'index.php?r=danh-muc/load-child',
            datatType: 'json',
            type: 'post',
            data: {
                parent: $("#sanpham-quan_id").val(),
                type: 'Đường phố'
            },
            beforeSend: function (){
                $.blockUI();
                $("#sanpham-duong_pho_id").empty();
            },
            success: function (data){
                $("#sanpham-duong_pho_id").append('<option>-- Chọn đường phố --</option>')
                $.each(data, function (k, obj){
                    $("#sanpham-duong_pho_id").append('<option value="'+obj.id+'">'+obj.name+'</option>');
                });
                $("#sanpham-duong_pho_id").select2();
            },
            complete: function (){
                $.unblockUI();
            },
            error: function (r1, r2) {
                console.log(r1.responseText);
            }
        });
    })

    $(document).on('change', '#chon-chi-nhanh', function (e){
        $.ajax({
            url: 'index.php?r=chi-nhanh/load-nhan-su',
            datatType: 'json',
            type: 'post',
            data: {
                parent: $("#chon-chi-nhanh").val(),
            },
            beforeSend: function (){
                $.blockUI();
                $("#sanpham-nguoi_tao_id").empty();
                $("#modal-form-san-pham").css('z-index', 1);
            },
            success: function (data){
                $("#sanpham-nguoi_tao_id").append('<option>-- Chọn người đăng --</option>');

                $.each(data, function (k, obj){
                    $("#sanpham-nguoi_tao_id").append('<option value="'+obj.user_id+'">'+obj.hoten+'</option>')
                })
            },
            complete: function (){
                $.unblockUI();
                $("#modal-form-san-pham").css('z-index', '10050');
            },
            error: function (r1, r2) {
                console.log(r1.responseText);
            }
        });
    });

    $(document).on('change', '#sanpham-tuan, #sanpham-type_san_pham, #nhom-san-pham, #sanpham-title, #sanpham-quan_id, #sanpham-duong_pho_id, #chon-chi-nhanh, #sanpham-nguoi_tao_id', function (){
        if($(this).val() != '')
            $(this).parent().parent().find('.error').addClass('hidden');
        else
            $(this).parent().parent().find('.error').removeClass('hidden');
    })

    $(document).on('click', '.btn-luu-san-pham', function (e){
        if($("#sanpham-title").val().trim() == '' ||
            $("#sanpham-quan_id").val() == '' ||
            $("#sanpham-duong_pho_id").val() == '' ||
            $("#chon-chi-nhanh").val() == '' ||
            $("#sanpham-nguoi_tao_id").val() == '' ||
            $("#sanpham-tuan").val() == '' ||
            $("#sanpham-type_san_pham").val() == '' ||
            $("#nhom-san-pham").val() == ''
        ){
            $.alert({
                title: 'Thông báo',
                content: '<div class="alert alert-danger"><i class="fa fa-warning"></i> Vui lòng điền đầy đủ thông tin vào các ô có chứa dấu *</div>'
            });
        }
        else{
            $('.error').addClass('hidden');
            var dataSanPham = new FormData($('#form-san-pham')[0]);
            $.ajax({
                url: 'index.php?r=san-pham/save',
                datatType: 'json',
                type: 'post',
                data: dataSanPham,
                contentType: false,
                processData: false,
                beforeSend: function (){
                    $.blockUI();
                },
                success: function (data){

                },
                complete: function (){
                    $.unblockUI();
                },
                error: function (r1, r2) {
                    console.log(r1.responseText);
                }
            });
        }
    });

    $(document).on('change', '#sanpham-type_san_pham', function (e){
        if($("#sanpham-type_san_pham").val() != ''){
            if($("#sanpham-type_san_pham").val() == 'Sản phẩm mới')
                $("#nhom-san-pham").html('<option>-- Chọn Giỏ --</option><option value="1">Giỏ 1</option><option value="2">Giỏ 2</option>');
            else if($("#sanpham-type_san_pham").val() == 'Sản phẩm tiềm năng')
                $("#nhom-san-pham").html('');
            else if($("#sanpham-type_san_pham").val() == 'Giao dịch')
                $("#nhom-san-pham").html('<option>-- Chọn GD --</option><option value="Sale công ty">Sale công ty</option><option value="Sale ngoài">Sale ngoài</option>');
        }
    })

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4e50651b5057b999b79f', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('sanPhamChannel');
    channel.bind('addNewSanPham', function(data) {
        $.ajax({
            url: 'index.php?r=san-pham/load-san-pham',
            data: {
                sanPham: data.message
            },
            dataType: 'json',
            type: 'post',
            success: function (data){
                if($(".table-san-pham").find('#block-san-pham-'+ data.model.id).length == 0){
                    $(".table-san-pham").find('#'+data.viTri).append(
                        data.modelHtml
                    )
                }
            }
        })
    });
})
