function changeKhuVuc($value, $object, $type) {
    $.ajax({
        type: "POST",
        url: 'index.php?r=danh-muc/get-khu-vuc',
        data: {value: $value, type: $type},
        dataType: 'json',
        beforeSend: function () {
            Metronic.blockUI();
        },
        success: function (response) {
            $(".div").append(response)
            if (response != '') {
                $object.html('<option value="">-- Chọn --</option>');
                $.each(response, function (k, value) {
                    $object.append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        }, complete: function (response) {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            console.log(r1.responseText)
        }
    });
}
function changeNhom($value, $object, $type) {
    $.ajax({
        type: "POST",
        url: 'index.php?r=danh-muc/get-nhom',
        data: {value: $value, type: $type},
        dataType: 'json',
        beforeSend: function () {
            Metronic.blockUI();
        },
        success: function (response) {
            $(".div").append(response)
            if (response != '') {
                $object.html('<option value="">-- Chọn --</option>');
                $.each(response, function (k, value) {
                    $object.append('<option value="' + value.code + '">' + value.name + '</option>');
                });
            }
        }, complete: function (response) {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            console.log(r1.responseText)
        }
    });
}

function addItem(item, add, remove) {
    $.ajax({
        url: 'index.php?r=user/add-item',
        data: {
            id: item
        },
        dataType: 'json',
        type: 'post',
        beforeSend: function () {
        },
        success: function (data) {
            $('#' + add + ' #data' + item).remove();
            $('#' + remove + ' #data' + item).remove();
            $('#' + add).append(data.item)
        },
        complete: function () {
        },

    })
}

function loadKhachHang(array, arr_column) {
    $.each(array, function (k, value) {
        if (value.trang_thai_khach_hang === "Khách hàng có nhu cầu" && value.phan_nhom === 1) {
            $('#tuan-' + value.phan_tuan + '-gio-1').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng có nhu cầu" && value.phan_nhom === 2) {
            $('#tuan-' + value.phan_tuan + '-gio-2').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng đã xem" && value.phan_nhom === 1) {
            $('#tuan-' + value.phan_tuan + '-da-xem-1').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng đã xem" && value.phan_nhom === 2) {
            $('#tuan-' + value.phan_tuan + '-da-xem-2').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng đã xem" && value.phan_nhom === 3) {
            $('#tuan-' + value.phan_tuan + '-da-xem-3').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng đã xem" && value.phan_nhom === 4) {
            $('#tuan-' + value.phan_tuan + '-da-xem-4').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng tiềm năng" && value.phan_nhom === 1) {
            $('#tuan-' + value.phan_tuan + '-tiem-nang-1').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng giao dịch" && value.phan_nhom === 1) {
            $('#tuan-' + value.phan_tuan + '-giao-dich-1').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng giao dịch" && value.phan_nhom === 2) {
            $('#tuan-' + value.phan_tuan + '-giao-dich-2').append(arr_column[k]);
        }
        if (value.trang_thai_khach_hang === "Khách hàng chung" && value.phan_nhom === 1) {
            $('#tuan-' + value.phan_tuan + '-khach-hang-chung-1').append(arr_column[k]);
        }
    });
}

function searchKhachHang(dataInput) {
    $.ajax({
        url: 'index.php?r=user/search-khach-hang',
        data: dataInput,
        dataType: 'json',
        type: 'post',
        beforeSend: function () {
            Metronic.blockUI();
        },
        success: function (data) {
            loadKhachHang(data.arr_khach_hang, data.arr_column);
        },
        complete: function () {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            $.alert(r1.responseText)
        }
    })
};

// $(document).ready(function () {
//     var count_click = 0;
//     var remove = '';
//     searchKhachHang({});
//     $('#id-pjax-khach-hang').on('pjax:error', function (event) {
//         event.preventDefault();
//     });
//     // Enable pusher logging - don't include this in production
//     // Enable pusher logging - don't include this in production
//     Pusher.logToConsole = true;
//
//     var pusher = new Pusher('8098a7a4cc508ae9b98a', {
//         cluster: 'ap1'
//     });
//
//     var channel = pusher.subscribe('my-channel');
//     channel.bind('khach-hang', function (data) {
//         addItem(data.item,data.add,data.remove);
//     });
//
//     $(document).on("sortupdate", ".column", function (event, ui) {
//         var add = '';
//         if (count_click === 0){
//              remove = $(this).attr('id');
//         }
//         if (count_click === 1) {
//             add = $(this).attr('id');
//             $('.thong-bao-khach-hang .alert').remove();
//             var trang_thai = $(this).attr("data-value")
//             var phan_tuan = $(this).attr("data-phan-tuan")
//             var phan_nhom = $(this).attr("data-phan-nhom")
//             if ($(this).attr("data-value") === "Khách hàng đã xem") {
//                 loadForm4({type: 'them-san-pham-da-xem', id: ui.item.attr('data-value')}, 'xl', function (data) {
//
//                 }, function () {
//                     var data = $('#form-them-san-pham-da-xem').serializeArray();
//                     data.push({name: 'trang_thai', value: trang_thai});
//                     data.push({name: 'phan_tuan', value: phan_tuan});
//                     data.push({name: 'phan_nhom', value: phan_nhom});
//                     data.push({name: 'id', value: ui.item.attr('data-value')});
//                     data.push({name: 'add', value: ui.item.attr('class')});
//                     data.push({name: 'remove', value: ui.item.attr('class')});
//                     $.ajax({
//                         url: 'index.php?r=user/save-trang-thai',
//                         data: data,
//                         dataType: 'json',
//                         type: 'post',
//                         beforeSend: function () {
//                             Metronic.blockUI();
//                         },
//                         success: function (data) {
//                             addItem( ui.item.attr('data-value'),remove,add);
//
//                         },
//                         complete: function () {
//                             Metronic.unblockUI();
//                         }, error: function (r1, r2) {
//                             $.alert(r1.responseText)
//                         }
//                     })
//                 }, function () {
//                     addItem( ui.item.attr('data-value'),remove,add);
//                 })
//                 return;
//             } else if ($(this).attr("data-value") === "Khách hàng giao dịch") {
//                 loadForm4({type: 'thong-tin-ban-hang', id: ui.item.attr('data-value')}, 'xl', function (data) {
//
//                 }, function () {
//                     $.ajax({
//                         url: 'index.php?r=user/save-trang-thai',
//                         data: {
//                             trang_thai: trang_thai,
//                             phan_tuan: phan_tuan,
//                             phan_nhom: phan_nhom,
//                             id: ui.item.attr('data-value'),
//                             arr_san_pham_da_xem: $('#them-san-pham-da-xem').val()
//                         },
//                         dataType: 'json',
//                         type: 'post',
//                         beforeSend: function () {
//                             Metronic.blockUI();
//                         },
//                         success: function (data) {
//                             loadKhachHang(data.arr_khach_hang, data.arr_column);
//                         },
//                         complete: function () {
//                             Metronic.unblockUI();
//                         }
//                     })
//                 }, function (data) {
//                     $.pjax.reload({container: '#id-pjax-khach-hang', timeout: false,});
//                 })
//                 return;
//             } else
//                 $.ajax({
//                     url: 'index.php?r=user/save-trang-thai',
//                     data: {
//                         trang_thai: $(this).attr("data-value"),
//                         phan_tuan: $(this).attr("data-phan-tuan"),
//                         phan_nhom: $(this).attr("data-phan-nhom"),
//                         id: ui.item.attr('data-value'),
//                         add: add,
//                         remove: remove,
//                     },
//                     dataType: 'json',
//                     type: 'post',
//                     beforeSend: function () {
//                         Metronic.blockUI();
//                     },
//                     success: function (data) {
//
//                     },
//                     complete: function () {
//                         Metronic.unblockUI();
//                     }
//                 })
//             count_click = 0;
//         } else {
//             count_click = 1
//         }
//     })
//
//     $('#nhucaukhachhang-nhu_cau_quan_huyen,#nhucaukhachhang-nhu_cau_phuong_xa,#nhucaukhachhang-nhu_cau_duong_pho').select2();
//     $('#nhucaukhachhang-nhu_cau_huong').select2();
//     $(document).on('change', '.tu_ngay', function () {
//         $.ajax({
//             url: 'index.php?r=user/search-khach-hang',
//             data: $("#form-search").serializeArray(),
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".table-khach-hang .khach-hang").remove();
//                 $(".table-khach-hang").append(data.table_khach_hang)
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-close', function (e) {
//         e.preventDefault()
//         $.ajax({
//             url: 'index.php?r=user/close-khach-hang',
//             data: {
//                 id: $(this).attr('data-value'),
//             },
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".table-khach-hang .khach-hang").remove();
//                 $(".table-khach-hang").append(data.table_khach_hang);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-cham-soc-khach-hang', function (e) {
//         e.preventDefault()
//         loadForm({type: 'them_cham_soc_khach_hang', id: $(this).attr('data-value')}, 'xl', function (data) {
//
//         }, function () {
//             $.ajax({
//                 url: 'index.php?r=user/loadform',
//                 data: $("#form-ban-hang").serializeArray(),
//                 dataType: 'json',
//                 type: 'post',
//                 beforeSend: function () {
//                     Metronic.blockUI();
//                 },
//                 success: function (data) {
//                     $(".thong-tin-khach-hang .view-khach-hang").remove();
//                     $(".thong-tin-khach-hang").append(data.view_thong_tin_khach_hang);
//                 },
//                 complete: function () {
//                     Metronic.unblockUI();
//                 }
//             })
//
//         })
//     })
//     $(document).on('change', '.den_ngay', function () {
//         $.ajax({
//             url: 'index.php?r=user/search-khach-hang',
//             data: $("#form-search").serializeArray(),
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".table-khach-hang .khach-hang").remove();
//                 $(".table-khach-hang").append(data.table_khach_hang);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
// })
// $(document).ready(function () {
//     $(document).on('change', '.tu_ngay_san_pham', function () {
//         $.ajax({
//             url: 'index.php?r=san-pham/search-san-pham',
//             data: $("#form-search-san-pham").serializeArray(),
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".table-san-pham .san-pham").remove();
//                 $(".table-san-pham").append(data.table_san_pham)
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-chi-tiet-san-pham', function (e) {
//         e.preventDefault();
//         viewData('san-pham/xem-chi-tiet-san-pham', {id: $(this).attr('data-value')}, 'xl')
//     })
//     $(document).on('click', '.btn-close-san-pham', function (e) {
//         e.preventDefault()
//         $.ajax({
//             url: 'index.php?r=san-pham/close-san-pham',
//             data: {
//                 id: $(this).attr('data-value'),
//             },
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".table-san-pham .san-pham").remove();
//                 $(".table-san-pham").append(data.table_san_pham);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-sua-khach-hang', function (e) {
//         e.preventDefault()
//         loadForm({id: $(this).attr('data-value'), type: 'sua-khach-hang'}, 'xl', function (data) {
//         }, function () {
//             $.ajax({
//                 url: 'index.php?r=user/save-khach-hang',
//                 data: $("#form-them-khach-hang").serializeArray(),
//                 dataType: 'json',
//                 type: 'post',
//                 beforeSend: function () {
//                     Metronic.blockUI();
//                 },
//                 success: function (data) {
//                 },
//                 complete: function () {
//                     Metronic.unblockUI();
//                 },
//                 error: function (r1, r2) {
//                     $.alert(r1.responseText)
//                 }
//             })
//         })
//     })
//     $(document).on('click', '.btn-xem-lich-su', function (e) {
//         e.preventDefault()
//         $.ajax({
//             url: 'index.php?r=user/lich-su-di-xem',
//             data: {
//                 id: $(this).attr('data-value')
//             },
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".lich-su-di-xem .view-san-pham").remove();
//                 $(".lich-su-di-xem").append(data.view_lich_su_di_xem);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-xoa', function (e) {
//         e.preventDefault();
//         var id = $(this).attr('data-value');
//         $.alert({
//             title: 'Thông báo',
//             icon: 'fa fa-warning',
//             type: 'red',
//             text: 'Bạn có chắc chắn muốn thực hiện việc này?',
//             buttons: {
//                 btnAccept: {
//                     text: '<i class="fa fa-check-circle-o"></i> Đồng ý',
//                     action: function () {
//                         $.ajax({
//                             url: 'index.php?r=user/xoa-khach-hang',
//                             data: {
//                                 id: id,
//                             },
//                             dataType: 'json',
//                             type: 'post',
//                             beforeSend: function () {
//                                 Metronic.blockUI();
//                             },
//                             success: function (data) {
//                                 $.pjax.reload({container: '#id-pjax-khach-hang', timeout: false,});
//                             },
//                             complete: function () {
//                                 Metronic.unblockUI();
//                             },
//                             error: function (r1, r2) {
//                                 $.alert(r1.responseText)
//                             }
//                         })
//                     },
//                     btnClass: 'btn-primary'
//                 },
//                 btnCancel: {
//                     text: '<i class="fa fa-ban"></i> Huỷ'
//                 }
//             }
//         })
//     });
//     $(document).on('change', '.den_ngay_san_pham', function () {
//         $.ajax({
//             url: 'index.php?r=san-pham/search-san-pham',
//             data: $("#form-search-san-pham").serializeArray(),
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".table-san-pham .san-pham").remove();
//                 $(".table-san-pham").append(data.table_san_pham);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('change', '#them-khach-hang', function () {
//         $.ajax({
//             url: 'index.php?r=user/thong-tin-khach-hang',
//             data: {id: $(this).val()},
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".thong-tin-khach-hang .view-khach-hang").remove();
//                 $(".thong-tin-khach-hang").append(data.view_thong_tin_khach_hang);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-xem-chi-tiet', function (e) {
//         e.preventDefault()
//         loadForm1({type: 'xem-chi-tiet-khach-hang', id: $(this).attr('data-value')}, 'xl', function (data) {
//
//         }, function () {
//
//         })
//     })
//     $(document).on('click', '.btn-them-khach-hang', function (e) {
//         e.preventDefault()
//         loadForm({type: 'them-khach-hang'}, 'xl', function (data) {
//
//         }, function () {
//             if ($('#trang_thai_khach_hang').val() == '') {
//                 $('.thong-bao-them-khach-hang .alert').remove();
//                 $('.thong-bao-them-khach-hang').append('<div class="alert alert-danger" role="alert"><i class="fa fa-close text-danger"></i> Vui lòng chọn trạng thái</div>')
//                 return false;
//             } else if ($('.hoten').val() == '') {
//                 $('.thong-bao-them-khach-hang .alert').remove();
//                 $('.thong-bao-them-khach-hang').append('<div class="alert alert-danger" role="alert"><i class="fa fa-close text-danger"></i> Họ tên không được để trống</div>')
//                 return false;
//             } else if ($('.dien-thoai').val() == '') {
//                 $('.thong-bao-them-khach-hang .alert').remove();
//                 $('.thong-bao-them-khach-hang').append('<div class="alert alert-danger" role="alert"><i class="fa fa-close text-danger"></i> Điện thoại không được để trống</div>')
//                 return false;
//             } else
//                 $.ajax({
//                     url: 'index.php?r=user/save-khach-hang',
//                     data: $("#form-them-khach-hang").serializeArray(),
//                     dataType: 'json',
//                     type: 'post',
//                     beforeSend: function () {
//                         Metronic.blockUI();
//                     },
//                     success: function (data) {
//                     },
//                     complete: function () {
//                         Metronic.unblockUI();
//                     },
//                     error: function (r1, r2) {
//                         $.alert(r1.responseText)
//                     }
//                 })
//         })
//     })
//     $(document).on('click', '.btn-them-san-pham', function (e) {
//         e.preventDefault()
//         viewData('san-pham/form-san-pham', {type: $(this).attr('data-value')}, '5xl')
//     })
//     $(document).on('change', '.check-luu-san-pham', function () {
//         $.ajax({
//             url: 'index.php?r=san-pham/check-luu-san-pham',
//             data: {
//                 id: $(this).attr('data-value'),
//                 checked: $(this).attr('checked')
//             },
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-bo-coc', function () {
//         $.ajax({
//             url: 'index.php?r=user/save-bo-coc',
//             data: {
//                 id: $(this).attr('data-value'),
//             },
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $.pjax.reload({container: '#id-pjax-khach-hang', timeout: false,});
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('change', '#them-san-pham-da-xem', function () {
//         $.ajax({
//             url: 'index.php?r=san-pham/thong-tin-san-pham',
//             data: {
//                 id: $(this).val()
//             },
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//             },
//             success: function (data) {
//                 $(".thong-tin-san-pham .view-san-pham").remove();
//                 $(".thong-tin-san-pham").append(data.view_thong_tin_san_pham);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-tim-san-pham', function (e) {
//         e.preventDefault()
//         $.ajax({
//             url: 'index.php?r=san-pham/search-san-pham-theo-nhu-cau',
//             data: $('#form-them-khach-hang').serializeArray(),
//             dataType: 'json',
//             type: 'post',
//             beforeSend: function () {
//                 Metronic.blockUI();
//                 $(".form-chon-san-pham .view-san-pham").remove();
//                 $('.thong-bao-them-khach-hang .alert').remove();
//             },
//             success: function (data) {
//                 if (data.status == 0) {
//                     $('.thong-bao-them-khach-hang').append('<div class="alert alert-danger" role="alert"><i class="fa fa-close text-danger"></i> Vui lòng nhập các thông tin bắt buộc</div>')
//                 }
//                 $(".form-chon-san-pham").append(data.view_chon_san_pham);
//             },
//             complete: function () {
//                 Metronic.unblockUI();
//             },
//             error: function (r1, r2) {
//                 $.alert(r1.responseText)
//             }
//         })
//     })
//     $(document).on('click', '.btn-them-nhu-cau', function (e) {
//         e.preventDefault()
//         loadForm({type: 'them-nhu-cau-khach-hang', id: $(this).attr('data-value')}, 'xl', function (data) {
//
//         }, function () {
//             $.ajax({
//                 url: 'index.php?r=user/save-nhu-cau-khach-hang',
//                 data: $("#form-them-khach-hang").serializeArray(),
//                 dataType: 'json',
//                 type: 'post',
//                 beforeSend: function () {
//                     Metronic.blockUI();
//                 },
//                 success: function (data) {
//                 },
//                 complete: function () {
//                     Metronic.unblockUI();
//                 },
//                 error: function (r1, r2) {
//                     $.alert(r1.responseText)
//                 }
//             })
//
//         })
//     })
//     $(document).on('click', '.btn-them-cham-soc-khach-hang', function (e) {
//         e.preventDefault()
//         loadForm({type: 'them-cham-soc-khach-hang', id: $(this).attr('data-value')}, 'l', function (data) {
//
//         }, function () {
//             $.ajax({
//                 url: 'index.php?r=user/save-cham-soc-khach-hang',
//                 data: $("#form-cham-soc-khach-hang").serializeArray(),
//                 dataType: 'json',
//                 type: 'post',
//                 beforeSend: function () {
//                     Metronic.blockUI();
//                 },
//                 success: function (data) {
//                     $(".cham-soc-khach-hang .cham-soc").remove();
//                     $(".cham-soc-khach-hang").append(data.view_cham_soc_khach_hang);
//                 },
//                 complete: function () {
//                     Metronic.unblockUI();
//                 },
//                 error: function (r1, r2) {
//                     $.alert(r1.responseText)
//                 }
//             })
//
//         })
//     })
//     $(document).on('change', '#nhucaukhachhang-nhu_cau_thanh_pho', function () {
//         $('#nhucaukhachhang-nhu_cau_quan_huyen').val('').trigger('change');
//         $('#nhucaukhachhang-nhu_cau_quan_huyen').empty();
//         changeKhuVuc($(this).val(), $('#nhucaukhachhang-nhu_cau_quan_huyen'), "Quận huyện");
//     });
//     $(document).on('change', '#nhucaukhachhang-nhu_cau_quan_huyen', function () {
//         $('#nhucaukhachhang-nhu_cau_phuong_xa').val('').trigger('change');
//         $('#nhucaukhachhang-nhu_cau_phuong_xa').empty();
//         changeKhuVuc($(this).val(), $('#nhucaukhachhang-nhu_cau_phuong_xa'), "Phường xã");
//     });
//     $(document).on('change', '#nhucaukhachhang-nhu_cau_quan_huyen', function () {
//         $('#nhucaukhachhang-nhu_cau_duong_pho').val('').trigger('change');
//         $('#nhucaukhachhang-nhu_cau_duong_pho').empty();
//         changeKhuVuc($(this).val(), $('#nhucaukhachhang-nhu_cau_duong_pho'), "Đường phố");
//     });
//     $(document).on('change', '#trang_thai_khach_hang', function () {
//         $('#trang_thai_nhom_khach_hang').val('').trigger('change');
//         $('#trang_thai_nhom_khach_hang').empty();
//         changeKhuVuc($(this).val(), $('#trang_thai_nhom_khach_hang'), "Trạng thái nhóm khách hàng");
//     });
//
//
// })
$(document).ready(function () {
    Pusher.logToConsole = true;
    var pusher = new Pusher('8098a7a4cc508ae9b98a', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('khach-hang', function (data) {
        $.ajax({
            url: 'index.php?r=user/load-khach-hang',
            data: {
                khachHang: data.id
            },
            dataType: 'json',
            type: 'post',
            success: function (obj) {
                console.log("#"+data.viTri+' #block-san-pham-' + obj.model.id)
                $("#"+data.viTri+' #block-san-pham-' + obj.model.id).remove();
                if ($(".table-khach-hang").find('#block-san-pham-' + obj.model.id).length == 0) {
                    $(".table-khach-hang").find('#' + obj.viTri).append(
                        obj.modelHtml
                    )
                }
            }
        })
    });
    channel.bind('xoa-khach', function (data) {
        $("#"+data.viTri+' #block-san-pham-' + data.id).remove();
    });
    var count_click = 0;
    $.ajax({
        url: 'index.php?r=user/load-danh-sach-khach-hang',
        datatType: 'json',
        type: 'post',
        beforeSend: function () {
            Metronic.blockUI({animate: true});
        },
        success: function (data) {
            $.each(data, function (k, obj) {
                if ($(".table-khach-hang").find('#block-san-pham-' + obj.model.id).length == 0) {
                    $(".table-khach-hang").find('#' + obj.viTri).append(
                        obj.modelHtml
                    )
                }
            });

            setTimeout(function () {
                $(".column").sortable({
                    connectWith: ".column",
                    handle: ".portlet-header",
                    cancel: ".portlet-toggle",
                    placeholder: "portlet-placeholder ui-corner-all",
                });

                $(".portlet")
                    .addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
                    .find(".portlet-header")
                    .addClass("ui-widget-header ui-corner-all")
                    .prepend("<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");

                $(".portlet-toggle").on("click", function () {
                    var icon = $(this);
                    icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");
                    icon.closest(".portlet").find(".portlet-content").toggle();
                });
            }, 1000);
        },
        complete: function () {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            console.log(r1.responseText)
        }
    });
    $(document).on("sortupdate", ".column", function (event, ui) {
        if (count_click === 1) {
            $.ajax({
                url: 'index.php?r=user/save-trang-thai',
                data: {
                    trang_thai: $(this).attr("data-value"),
                    phan_tuan: $(this).attr("data-phan-tuan"),
                    phan_nhom: $(this).attr("data-phan-nhom"),
                    id: ui.item.attr('data-value'),
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    Metronic.blockUI();
                },
                success: function (data) {

                },
                complete: function () {
                    Metronic.unblockUI();
                }
            })
            count_click = 0;
        } else {
            count_click = 1
        }
    })
        $(document).on('click', '.btn-them-khach-hang', function (e) {
        e.preventDefault();
        $("#form-khach-hang")[0].reset();
        $("#modal-form-khach-hang").modal('show');
    });
    $(document).on('click', '.btn-luu-khach-hang', function (e) {
        if($("#user-type_khach_hang").val().trim() == '' ||
            $("#user-phan_tuan").val() == '' ||
            $("#user-dien_thoai").val() == '' ||
            $("#user-hoten").val() == ''||
            $("#user-nguon_khach_id").val() == ''||
            $("#user-chi_nhanh_nhan_vien_id").val() == ''||
            $("#user-phan_nhom").val() == ''

        ){
            $.alert({
                title: 'Thông báo',
                content: '<div class="alert alert-danger"><i class="fa fa-warning"></i> Vui lòng điền đầy đủ thông tin vào các ô có chứa dấu *</div>'
            });
        }
        else
        $.ajax({
            url: 'index.php?r=user/save',
            datatType: 'json',
            type: 'post',
            data: $('#form-khach-hang').serializeArray(),

            beforeSend: function () {
                $.blockUI();
            },
            success: function (data) {
                $("#modal-form-khach-hang").modal('hide');
            },
            complete: function () {
                $.unblockUI();
            },
            error: function (r1, r2) {
               $.alert({
                   title: 'Thông báo',
                   content:getMessage(r1.responseText),
               })
            }
        });
    });
    $(document).on('change', '#user-type_khach_hang', function () {
        $('#user-phan_nhom').val('').trigger('change');
        $('#user-phan_nhom').empty();
        changeNhom($(this).val(), $('#user-phan_nhom'), "Trạng thái nhóm khách hàng");
    });
    $(document).on('change', '#nhucaukhachhang-nhu_cau_quan_huyen', function () {
        $('#nhucaukhachhang-nhu_cau_phuong_xa').val('').trigger('change');
        $('#nhucaukhachhang-nhu_cau_phuong_xa').empty();
        changeKhuVuc($(this).val(), $('#nhucaukhachhang-nhu_cau_phuong_xa'), "Phường xã");
    });
    $(document).on('change', '#nhucaukhachhang-nhu_cau_quan_huyen', function () {
        $('#nhucaukhachhang-nhu_cau_duong_pho').val('').trigger('change');
        $('#nhucaukhachhang-nhu_cau_duong_pho').empty();
        changeKhuVuc($(this).val(), $('#nhucaukhachhang-nhu_cau_duong_pho'), "Đường phố");
    });

    $(document).on('click', '.btn-xem-chi-tiet', function (e) {
        e.preventDefault()
        loadForm1({type: 'xem-chi-tiet-khach-hang', id: $(this).attr('data-value')}, 'xl', function (data) {

        }, function () {

        })
    })
    $(document).on('click', '.btn-sua-khach-hang', function (e) {
        e.preventDefault()
        loadForm({id: $(this).attr('data-value'), type: 'sua-khach-hang'}, 'xl', function (data) {
        }, function () {
            $.ajax({
                url: 'index.php?r=user/save',
                data: $("#form-sua-khach-hang").serializeArray(),
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    Metronic.blockUI();
                },
                success: function (data) {
                },
                complete: function () {
                    Metronic.unblockUI();
                },
                error: function (r1, r2) {
                    $.alert(r1.responseText)
                }
            })
        })
    })
    $(document).on('click', '.btn-xoa', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-value');
        $.alert({
            title: 'Thông báo',
            icon: 'fa fa-warning',
            type: 'red',
            text: 'Bạn có chắc chắn muốn thực hiện việc này?',
            buttons: {
                btnAccept: {
                    text: '<i class="fa fa-check-circle-o"></i> Đồng ý',
                    action: function () {
                        $.ajax({
                            url: 'index.php?r=user/xoa-khach-hang',
                            data: {
                                id: id,
                            },
                            dataType: 'json',
                            type: 'post',
                            beforeSend: function () {
                                Metronic.blockUI();
                            },
                            success: function (data) {
                            },
                            complete: function () {
                                Metronic.unblockUI();
                            },
                            error: function (r1, r2) {
                                $.alert(r1.responseText)
                            }
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
})