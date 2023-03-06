$(document).ready(function () {
    // $("#crud-datatable-pjax").on('pjax:success', function() {
    //     $('#quanlykhachhangsearch-tu_ngay').datepicker($.extend({}, $.datepicker.regional['vi'], {"dateFormat":"dd/mm/yy","changeMonth":true,"yearRange":"2015:2025","changeYear":true}));
    //     $('#quanlykhachhangsearch-den_ngay').datepicker($.extend({}, $.datepicker.regional['vi'], {"dateFormat":"dd/mm/yy","changeMonth":true,"yearRange":"2015:2025","changeYear":true}));
    // });

    $(document).on('click', '.btn-huy-khoi-phuc-hoat-dong', function (e) {
        e.preventDefault();
        var $uid = $(this).attr('data-value');
        $.alert({
            title: 'Thông báo',
            icon: 'fa fa-warning',
            type: 'red',
            text: 'Bạn có chắc chắn muốn thực hiện việc này?',
            buttons: {
                btnAccept: {
                    text: '<i class="fa fa-check-circle-o"></i> Đồng ý',
                    action: function () {
                        SaveObject('user/change-status', {uid: $uid}, function (data) {
                            $.pjax({container: "#crud-datatable-pjax"});
                        });
                    },
                    btnClass: 'btn-primary'
                },
                btnCancel: {
                    text: '<i class="fa fa-ban"></i> Huỷ'
                }
            }
        })
    });

    $(document).on('click', '.btn-them-nhan-vien', function (e) {
        e.preventDefault();
        $("#modal-nhanvien").modal('show');
    });

    $(document).on('click', '.btn-them-khach', function (e) {
        e.preventDefault();

        loadForm({type: 'them_khach_hang'}, 'l', function (data) {
            setTimeout(function () {
                $("#user-nhu_cau_quan, #user-nhu_cau_huong").select2();
            }, 500);
        }, function () {
            if($("#user-hoten").val().trim() == ''){
                $.alert('Chưa nhập họ tên khách hàng');
                return false;
            }else if($("#user-dien_thoai").val().trim() == ''){
                $.alert('Chưa nhập điện thoại khách hàng');
                return  false;
            }else
                SaveObject('user/luu-khach-hang', $("#form-khach-hang").serializeArray(), function (data) {
                    $.pjax.reload({container: '#crud-datatable-pjax'});
                })
        })
    });

    $(document).on('click', '.btn-sua-khach-hang', function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-value');
        loadForm({type: 'sua_khach_hang', user_id: $id}, 'l', function (data) {
            setTimeout(function () {
                $("#user-nhu_cau_quan, #user-nhu_cau_huong").select2();
            }, 400);
        }, function () {
            if($("#user-hoten").val().trim() == ''){
                $.alert('Chưa nhập họ tên khách hàng');
                return false;
            }else if($("#user-dien_thoai").val().trim() == ''){
                $.alert('Chưa nhập điện thoại khách hàng');
                return  false;
            }else
                SaveObject('user/luu-khach-hang', $("#form-khach-hang").serializeArray(), function (data) {
                    $.pjax.reload({container: '#crud-datatable-pjax'});
                })
        })
    });

    $(document).on('click', '.btn-xoa-khach-hang', function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-value');
        $.alert({
            title: 'Thông báo',
            icon: 'fa fa-warning',
            type: 'red',
            text: 'Bạn có chắc chắn muốn thực hiện việc này?',
            content:'Bạn có chắc chắn muốn thực hiện việc này?',
            buttons: {
                btnAccept: {
                    text: '<i class="fa fa-check-circle-o"></i> Đồng ý',
                    action: function () {
                        SaveObject('user/xoa', {id: $id}, function (data) {
                            $.pjax({container: "#crud-datatable-pjax"});
                        })
                    },
                    btnClass: 'btn-primary'
                },
                btnCancel: {
                    text: '<i class="fa fa-ban"></i> Huỷ'
                }
            }
        })
    });
    $(document).on('click','.btn-xem-chi-tiet-khach-hang-cua-toi',function (e) {
        e.preventDefault();
        viewData('user/xem-chi-tiet-khach-hang-cua-toi',{id: $(this).attr('data-value')},'l')
    });
    $(document).on('click','.btn-xem-chi-tiet-khach-hang-chia-se',function (e) {
        e.preventDefault();
        viewData('user/xem-chi-tiet-khach-hang-chia-se',{id: $(this).attr('data-value')},'l')
    });

    $(document).on('click','.btn-chia-se-khach-hang',function (e) {
        e.preventDefault();
        loadForm({user_id: $(this).attr('data-value'),type: 'chia_se_khach_hang'},'l',function (data) {},function () {
            var $loi = 0;
            var $message = '';

            if ($("#chiasekhachhang-nguoi_nhan_id").val()==''){
                $message += '<p>Vui lòng chọn người nhận</p>';
                $loi++;
            }
            if($loi == 0){
                SaveObject("user/chia-se-khach-hang", $("#form-chia-se-khach-hang").serializeArray(), function (data) {
                    $.pjax.reload({container: "#crud-datatable-pjax"});
                });
            }else {
                $.alert($message);
                return false;
            }
        })
    });

    $(document).on('click', '.btn-so-san-pham-da-xem', function (e) {
        e.preventDefault();
        var $user_id = $(this).attr('data-value');
        viewData('user/view-so-san-pham', {user_id: $user_id}, 'l', function (data) {
        });
    });

    $(document).on('click','.danh-sach-san-pham-phu-trach',function (e) {
        e.preventDefault();
        loadForm({id: $(this).attr('data-value'), type: 'danh_sach_san_pham_phu_trach'}, 'xl', function (data) {}, function () {
            // SaveObject('user/luu-san-pham-phu-hop', $("#form-tim-san-pham-phu-hop").serializeArray(), function (data) {
            //     $.pjax.reload({container: '#crud-datatable-pjax'});
            // })

            $.ajax({
                url: 'index.php?r=san-pham/update-nhu-cau-khach-hang',
                data: $("#form-danh-sach-nhu-cau").serializeArray(),
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    $('.thongbao').html('');
                    Metronic.blockUI();
                },
                success: function (data) {
                    if (data.huong != 'false'){
                        $("#user-nhu_cau_gia_tu").val(data.gia_tu);
                        $("#user-nhu_cau_gia_den").val(data.gia_den);
                        $("#user-nhu_cau_dien_tich_tu").val(data.dien_tich_tu);
                        $("#user-nhu_cau_dien_tich_den").val(data.dien_tich_den);
                        $("#san_pham").val(data.id_san_pham);
                        $("#ngay_xem").val(data.ngay_xem);

                        $("#user-nhu_cau_quan").select2('val', data.quan);
                        $("#user-nhu_cau_huong").select2('val', data.huong);

                    }
                },
                error: function (r1, r2) {
                    $('.thongbao').html(r1.responseText)
                },
                complete: function () {
                    Metronic.unblockUI();
                }
            })
        });
    });


    // $(document).on('click','.danh-sach-san-pham-phu-trach',function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: 'index.php?r=san-pham/danh-sach-san-pham-phu-trach',
    //         data: {id: $(this).attr('data-value'), type: 'danh_sach_san_pham_phu_trach'},
    //         dataType: 'json',
    //         type: 'post',
    //         beforeSend: function () {
    //             $("#danh-sach").html('');
    //             $('.thongbao').html('');
    //             Metronic.blockUI();
    //         },
    //         success: function (data) {
    //             $("#nhap-tay").remove();
    //             $(".danh-sach-san-pham-phu-trach").remove();
    //             $("#danh-sach").html(data.content);
    //         },
    //         error: function (r1, r2) {
    //             $('.thongbao').html(r1.responseText)
    //         },
    //         complete: function () {
    //             Metronic.unblockUI();
    //         }
    //     })
    // });

    $(document).on('click', '.btn-so-lan-da-chia-se', function (e) {
        e.preventDefault();
        var $user_id = $(this).attr('data-value');
        viewData('user/view-danh-sach-nguoi-da-nhan-chia-se', {user_id: $user_id}, 'l', function (data) {
        });
    });

    $(document).on('click','.btn-tim-san-pham',function (e) {
        e.preventDefault();
        loadForm({user_id: $(this).attr('data-value'), type: 'tim_san_pham_phu_hop'}, 'xl', function (data) {}, function () {
            SaveObject('user/luu-san-pham-phu-hop', $("#form-tim-san-pham-phu-hop").serializeArray(), function (data) {
                $.pjax.reload({container: '#crud-datatable-pjax'});
            })
        });
    });

    $(document).on('click', '.btn-danh-sach-san-pham-trong-kho', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'index.php?r=san-pham/danh-sach-san-pham-trong-kho',
            data: {chu_nha: $("#chu_nha").val(), dia_chi: $("#dia_chi").val()},
            dataType: 'json',
            type: 'post',
            beforeSend: function () {
                $("#san-pham-trong-kho").html('');
                $('.thongbao').html('');
                Metronic.blockUI();
            },
            success: function (data) {
                $("#san-pham-trong-kho").html(data.content);
            },
            error: function (r1, r2) {
                $('.thongbao').html(r1.responseText)
            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    });

});
