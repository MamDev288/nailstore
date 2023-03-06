$(document).ready(function () {
    //
    var $prefix = 'index.php?r=';
    function getTreeNhom(controllerAction, idTree) {
        $(idTree).jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" :  function (operation, node, node_parent, node_position, more) {},
                'data' : {
                    'url' : function (node) {
                        return controllerAction;
                    },
                    'dataType': 'json',
                    'data' : function (node) {
                        return { 'parent' : node.id };
                    },
                    'timeout': 50000
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo3" },
            "plugins" : ["state", "types"]
        });
    }

    $(document).on("click", ".jconfirm-box", function (e) {
        e.preventDefault();
        $("select").select2("close");
      });
    getTreeNhom($prefix +'user/getnhom','#tree_nhomtaisan');
    $(document).on('change', '#daily-type', function () {
        var type = $(this).val();
        $.ajax({
            url: $prefix +'daily/getparent',
            data: {type: type},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $("#khuvuctructhuoc").html('');
            },
            success: function (data) {
                $("#khuvuctructhuoc").html(data.formcapdo);
            }

        })
    });

    $(document).on('change', '#cap-trunguong', function () {
        $.ajax({
            url: $prefix + 'daily/getkhuvuc',
            data: {type: 'tinh', id: $(this).val()},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $("#captinhtructhuoc").empty();
            },
            success: function (data) {
                $("#captinhtructhuoc").append('<option>Chọn Tỉnh....</option>');
                $.each(data, function (k, obj) {
                    $("#captinhtructhuoc").append("<option value='"+obj.id+"'>"+obj.name+"</option>");
                })
            }
        })
    });

    $(document).on('change', '#captinhtructhuoc', function () {
        $.ajax({
            url: 'index.php?r=daily/getkhuvuc',
            data: {type: 'quan', id: $(this).val()},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $("#capquantructhuoc").empty();
            },
            success: function (data) {
                $("#capquantructhuoc").append('<option>Chọn Quận/huyện....</option>');
                $.each(data, function (k, obj) {
                    $("#capquantructhuoc").append("<option value='"+obj.id+"'>"+obj.name+"</option>");
                })
            }
        })
    });
    $(document).on('click', '.parent_name', function (e){
        e.preventDefault();
        $.ajax({
            url: $prefix + 'user/xem-chi-tiet',
            dataType: 'json',
            type: 'post',
            data: {
                user: $('.parent_name').attr('id')
            },
            beforeSend: function (){
                $("#block-thong-tin-thanh-vien").html('');
            },
            success: function (data){
                $("#block-thong-tin-thanh-vien").html(data.content);
                $("#block-bang-thanh-vien-tuyen-duoi").html(data.tuyenDuoi);
                $("#block-hoa-hong-nhan-vien").html(data.hoaHong);
            },
            error: function (r1, r2){
                $.alert(r1.responseText)
            }
        });
        return false;
    })

    // $(document).on('click', '.jstree-node', function (e){
    //     e.preventDefault();
    //     $.ajax({
    //         url: $prefix + 'user/xem-chi-tiet',
    //         dataType: 'json',
    //         type: 'post',
    //         data: {
    //             user: $(this).attr('id')
    //         },
    //         beforeSend: function (){
    //             $("#block-thong-tin-thanh-vien").html('');
    //         },
    //         success: function (data){
    //             $("#block-thong-tin-thanh-vien").html(data.content);
    //             $("#block-bang-thanh-vien-tuyen-duoi").html(data.tuyenDuoi);
    //             $("#block-hoa-hong-nhan-vien").html(data.hoaHong);
    //         },
    //         error: function (r1, r2){
    //             $.alert(r1.responseText)
    //         }
    //     });
    //     return false;
    // })

    $(document).on('click', '.btn-tuyen-tren', function (e){
        e.preventDefault();
        const id = $(this).attr('data-value');
        const type = $(this).attr('data-type');

        loadForm({type, id},'l',function (data) {
            setTimeout(function () {
                $('#user-parent_id').select2();
            }, 500);
        },function () {
            let loi = 0
            $('.help-block').html('');
            if($('#user-parent_id').val() === ''){
                loi++;
                $('#user-parent_id').parent().find('.help-block').addClass('text-danger').html(
                    $('#user-parent_id').parent().find('label').html() + ' không được để trống'
                )
                $('#user-parent_id').parent().addClass('has-error');
            }

            if(loi === 0){
                SaveObject("../user/luu-tuyen", $("#form-cap-nhat-tuyen").serializeArray(), function (data) {
                    $('#tree_nhomtaisan').jstree(true).refresh();
                });
            }else{
                return false;
            }
        });
    })
});
