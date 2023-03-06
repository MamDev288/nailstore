 /**
 * Created by HungLuongHien on 6/23/2016.
 */
function getMessage(str) {
    return str.replace('Internal Server Error (#500):','');
}
function createTypeHead(target, action, callbackAfterSelect){
    $(target).typeahead({
        source: function (query, process) {
            var states = [];
            return $.get('index.php?r=autocomplete/'+action, { query: query }, function (data) {
                $.each(data, function (i, state) {
                    states.push(state.name);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            if(typeof callbackAfterSelect != 'undefined')
                callbackAfterSelect(item);
            /*$.ajax({
             url: 'index.php?r=khachhang/getdiachi',
             data: {name: item},
             type: 'post',1
             dataType: 'json',
             success: function (data) {
             $("#diachikhachhang").val(data);
             }
             })*/
        }
    });
}
function setDatePicker() {
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        language: 'vi',
        todayBtn: true,
        todayHighlight: true,
    });
}
function uniqId() {
    return Math.round(new Date().getTime() + (Math.random() * 100));
}

function SaveObjectUploadFile($url_controller_action, $dataInput, callbackSuccess, columnClass){
    if(typeof columnClass == "undefined")
        columnClass = 's';
    // data = new FormData($(modalForm)[0]);
    $.dialog({
        columnClass: columnClass,
        content: function () {
            var self = this;
            return $.ajax({
                url: 'index.php?r=' + $url_controller_action,
                type: 'post',
                dataType: 'json',
                data: $dataInput,
                // async: false,
                contentType: false,
                // cache: false,
                processData: false
            }).success(function (data) {
                self.setContent(data.content);
                self.setTitle(data.title);
                self.setType('blue');
                callbackSuccess(data);
            }).error(function (r1, r2) {
                self.setContent(getMessage(r1.responseText));
                self.setTitle('Lỗi');
                self.setType('red');
                return false;
            });
        }
    })
}


function SaveObject($url_controller_action, $dataInput, callbackSuccess, columnClass){
    if(typeof columnClass == "undefined")
        columnClass = 's';

    $.dialog({
        columnClass: columnClass,
        content: function () {
            var self = this;
            return $.ajax({
                url: 'index.php?r=' + $url_controller_action,
                type: 'post',
                dataType: 'json',
                data: $dataInput,
            }).success(function (data) {
                self.setContent(data.content);
                self.setTitle(data.title);
                self.setType('blue');
                callbackSuccess(data);
            }).error(function (r1, r2) {
                self.setContent(getMessage(r1.responseText));
                self.setTitle('Lỗi');
                self.setType('red');
                return false;
            });
        }
    })
}
/*
@param
  actionloadform  = action xử lý
  dataloadform ={} dữ liệu truyền vào khi open form
  những button trong form được truyền vào biến obj_button với đddinh dạng
  obj_button = {tên button:{
                    class:'class button',
                    text:'text của nút',
                    action:sự kiện action gọi ajax nếu co thì true,
                    url:'đường dẫ gọi ajax khi nhân button',
                    data:{data truền vào ajax
                    },
                    mess:'alert ra một dòng chữ khi thành công'
                },... những button khac

  }
* */
function loadForm(actionloadform, dataloadform={},$size = 'm', callbackSuccess, callbackSave,obj_button = {}, method = "POST") {
    const button ={};
    for (const [key, value] of Object.entries(obj_button)) {
           button[key] = {};
           button[key]['text'] = value['text'];
            button[key]['btnClass'] = value['class'];
            if(value['ajax'] === true )
            {
                button[key]['action'] = function () {
                    console.log(value['data'])
                    $.ajax({
                        type: method,
                        url: actionloadform,
                        data: value['data'],
                        dataType: 'json',
                        beforeSend: function (){

                        },
                        success: function (response){
                            alertify.success(value['mess']);
                            $.pjax.reload({container: "#crud-datatable-pjax"});

                        },
                        error: function(r1, r2){
                            alertify.error(r1.responseText);
                        }
                    })
                };

            }
    }
    button['btnClose'] =     {
        text: '<i class="fa fa-close"></i> Đóng lại'
    };
    $.confirm({
        content: function () {
            var self = this;
            return $.ajax({
                url: actionloadform,
                data: dataloadform,
                type: 'post',
                dataType: 'json'
            }).success(function (data) {
                self.setContent(data.content);
                self.setTitle(data.title);
                self.setType('');
                if(typeof callbackSuccess === "function"){
                    callbackSuccess(data);
                }

            }).error(function (r1, r2) {
                self.setContent(getMessage(r1.responseText));
                self.setTitle('Lỗi');
                self.setType('red');
                self.$$btnSave.prop('disabled', true);
                return false;
            });
        },
        columnClass: $size,
        buttons: button
    });
}
//  function loadForm($dataInput, $size = 'm', callbackSuccess, callbackSave) {
//      $.confirm({
//          content: function () {
//              var self = this;
//              return $.ajax({
//                  url: 'index.php?r=site/loadform',
//                  data: $dataInput,
//                  type: 'post',
//                  dataType: 'json'
//              }).success(function (data) {
//                  self.setContent(data.content);
//                  self.setTitle(data.title);
//                  self.setType('blue');
//                  callbackSuccess(data);
//              }).error(function (r1, r2) {
//                  self.setContent(getMessage(r1.responseText));
//                  self.setTitle('Lỗi');
//                  self.setType('red');
//                  self.$$btnSave.prop('disabled', true);
//                  return false;
//              });
//          },
//          columnClass: $size,
//          buttons: {
//              btnSave: {
//                  text: '<i class="fa fa-check-circle"> Duyệt</i>',
//                  btnClass: 'btn btn-primary',
//                  action: function () {
//                      $.ajax({
//                          type: "POST",
//                          url: 'index.php?r=tuyen-dung-dk-nhu-cau-ns/cap-nhat-trang-thai-phieu',
//                          data: {
//                              id: $dataInput['id'],
//                              trangThai: 'Đã duyệt'
//                          },
//                          dataType: 'json',
//                          beforeSend: function (){
//
//                          },
//                          success: function (response){
//                              alertify.success('Cập nhật trạng thái phiếu dụng thành công');
//                              $.pjax.reload({container: "#crud-datatable-pjax"});
//                          },
//                          error: function(r1, r2){
//                              console.log(r1.responseText)
//                          }
//                      })
//                  }
//              },
//              somethingElse: {
//                  text: '<i class="fa fa-ban"> Không duyệt</i>',
//                  btnClass: 'btn btn-danger',
//                  action: function () {
//                      $.ajax({
//                          type: "POST",
//                          url: 'index.php?r=tuyen-dung-dk-nhu-cau-ns/cap-nhat-trang-thai-phieu',
//                          data: {
//                              id: $dataInput['id'],
//                              trangThai: 'Không duyệt'
//                          },
//                          dataType: 'json',
//                          beforeSend: function (){
//
//                          },
//                          success: function (response){
//                              alertify.success('Cập nhật trạng thái phiếu dụng thành công');
//                              $.pjax.reload({container: "#crud-datatable-pjax"});
//                          },
//                          error: function(r1, r2){
//                              console.log(r1.responseText)
//                          }
//                      })
//                  }
//              },
//              btnClose: {
//                  text: '<i class="fa fa-close"></i> Đóng lại'
//              }
//          }
//      });
//  }
 function loadForm2($dataInput, $size = 'm', callbackSuccess, callbackSave, textBtnAccept = '<i class="fa fa-save"></i> Lưu lại') {

     $.confirm({

         content: function () {

             var self = this;

             return $.ajax({

                 url: 'index.php?r=site/loadform',

                 data: $dataInput,

                 type: 'post',

                 dataType: 'json'

             }).success(function (data) {

                 self.setContent(data.content);

                 self.setTitle(data.title);

                 self.setType('blue');

                 callbackSuccess(data);

             }).error(function (r1, r2) {

                 self.setContent(getMessage(r1.responseText));

                 self.setTitle('Lỗi');

                 self.setType('red');

                 self.$$btnSave.prop('disabled', true);

                 return false;

             });

         },

         columnClass: $size,

         buttons: {

             btnSave: {

                 text: textBtnAccept,

                 btnClass: 'btn-primary',

                 action: function () {

                     if(typeof callbackSave != "undefined") return callbackSave();

                 }

             },

             btnClose: {

                 text: '<i class="fa fa-close"></i> Đóng lại'

             }

         }

     });

 }

 function loadFormNguoiPhuTrach($dataInput, $size = 'm', callbackSuccess, callbackSave) {
     $.confirm({
         content: function () {
             var self = this;
             return $.ajax({
                 url: 'index.php?r=site/loadformnguoiphutrach',
                 data: $dataInput,
                 type: 'post',
                 dataType: 'json'
             }).success(function (data) {
                 self.setContent(data.content);
                 self.setTitle(data.title);
                 self.setType('blue');
                 callbackSuccess(data);
             }).error(function (r1, r2) {
                 self.setContent(getMessage(r1.responseText));
                 self.setTitle('Lỗi');
                 self.setType('red');
                 self.$$btnSave.prop('disabled', true);
                 return false;
             });
         },
         columnClass: $size,
         buttons: {
             btnSave: {
                 text: '<i class="fa fa-save"></i> Lưu lại',
                 btnClass: 'btn-primary',
                 action: function () {
                     if(typeof callbackSave != "undefined") return callbackSave();
                 }
             },
             btnClose: {
                 text: '<i class="fa fa-close"></i> Đóng lại'
             }
         }
     });
 }

 function loadFormTrangThai($dataInput, $size = 'm', callbackSuccess, callbackSave) {
     $.confirm({
         content: function () {
             var self = this;
             return $.ajax({
                 url: 'index.php?r=site/loadformtrangthai',
                 data: $dataInput,
                 type: 'post',
                 dataType: 'json'
             }).success(function (data) {
                 self.setContent(data.content);
                 self.setTitle(data.title);
                 self.setType('blue');
                 callbackSuccess(data);
             }).error(function (r1, r2) {
                 self.setContent(getMessage(r1.responseText));
                 self.setTitle('Lỗi');
                 self.setType('red');
                 self.$$btnSave.prop('disabled', true);
                 return false;
             });
         },
         columnClass: $size,
         buttons: {
             btnSave: {
                 text: '<i class="fa fa-save"></i> Lưu lại',
                 btnClass: 'btn-primary',
                 action: function () {
                     if(typeof callbackSave != "undefined") return callbackSave();
                 }
             },
             btnClose: {
                 text: '<i class="fa fa-close"></i> Đóng lại'
             }
         }
     });
 }

 function loadFormThuPhi($dataInput, $size = 'm', callbackSuccess, callbackSave) {
     $.confirm({
         content: function () {
             var self = this;
             return $.ajax({
                 url: 'index.php?r=site/loadformthuphi',
                 data: $dataInput,
                 type: 'post',
                 dataType: 'json'
             }).success(function (data) {
                 self.setContent(data.content);
                 self.setTitle(data.title);
                 self.setType('blue');
                 callbackSuccess(data);
             }).error(function (r1, r2) {
                 self.setContent(getMessage(r1.responseText));
                 self.setTitle('Lỗi');
                 self.setType('red');
                 self.$$btnSave.prop('disabled', true);
                 return false;
             });
         },
         columnClass: $size,
         buttons: {
             btnSave: {
                 text: '<i class="fa fa-save"></i> Lưu lại',
                 btnClass: 'btn-primary',
                 action: function () {
                     if(typeof callbackSave != "undefined") return callbackSave();
                 }
             },
             btnClose: {
                 text: '<i class="fa fa-close"></i> Đóng lại'
             }
         }
     });
 }
 function loadFormFromUrl($dataInput, $controller_action, $size = 'm', callbackSuccess, callbackSave) {
    $.confirm({
        content: function () {
            var self = this;
            return $.ajax({
                url: 'index.php?r=' + $controller_action,
                data: $dataInput,
                type: 'post',
                dataType: 'json'
            }).success(function (data) {
                self.setContent(data.content);
                self.setTitle(data.title);
                self.setType('blue');
                callbackSuccess(data);
            }).error(function (r1, r2) {
                self.setContent(getMessage(r1.responseText));
                self.setTitle('Lỗi');
                self.setType('red');
                self.$$btnSave.prop('disabled', true);
                return false;
            });
        },
        columnClass: $size,
        buttons: {
            btnSave: {
                text: '<i class="fa fa-save"></i> Lưu lại',
                btnClass: 'btn-primary',
                action: function () {
                    if(typeof callbackSave != "undefined") return callbackSave();
                }
            },
            btnClose: {
                text: '<i class="fa fa-close"></i> Đóng lại'
            }
        }
    });
}
function loadFormThayTheNguoiPhuTrach($dataInput, $size = 'm', callbackSuccess, callbackSave) {
     $.confirm({
         content: function () {
             var self = this;
             return $.ajax({
                 url: 'index.php?r=site/loadformthaythenguoiphutrach',
                 data: $dataInput,
                 type: 'post',
                 dataType: 'json'
             }).success(function (data) {
                 self.setContent(data.content);
                 self.setTitle(data.title);
                 self.setType('blue');
                 callbackSuccess(data);
             }).error(function (r1, r2) {
                 self.setContent(getMessage(r1.responseText));
                 self.setTitle('Lỗi');
                 self.setType('red');
                 self.$$btnSave.prop('disabled', true);
                 return false;
             });
         },
         columnClass: $size,
         buttons: {
             btnSave: {
                 text: '<i class="fa fa-save"></i> Lưu lại',
                 btnClass: 'btn-primary',
                 action: function () {
                     if(typeof callbackSave != "undefined") return callbackSave();
                 }
             },
             btnClose: {
                 text: '<i class="fa fa-close"></i> Đóng lại'
             }
         }
     });
 }
 function loadFormKinhDoanhHoiVien($dataInput, $size = 'm', callbackSuccess, callbackSave) {
     $.confirm({
         content: function () {
             var self = this;
             return $.ajax({
                 url: 'index.php?r=site/loadformkinhdoanhhoivien',
                 data: $dataInput,
                 type: 'post',
                 dataType: 'json'
             }).success(function (data) {
                 self.setContent(data.content);
                 self.setTitle(data.title);
                 self.setType('blue');
                 callbackSuccess(data);
             }).error(function (r1, r2) {
                 self.setContent(getMessage(r1.responseText));
                 self.setTitle('Lỗi');
                 self.setType('red');
                 self.$$btnSave.prop('disabled', true);
                 return false;
             });
         },
         columnClass: $size,
         buttons: {
             btnSave: {
                 text: '<i class="fa fa-save"></i> Lưu lại',
                 btnClass: 'btn-primary',
                 action: function () {
                     if(typeof callbackSave != "undefined") return callbackSave();
                 }
             },
             btnClose: {
                 text: '<i class="fa fa-close"></i> Đóng lại'
             }
         }
     });
 }
function taiFileExcel($controller_action, $data){
    $.ajax({
        url: 'index.php?r='+$controller_action,
        data: $data,
        dataType: 'json',
        type: 'post',
        beforeSend: function () {
            $('.thongbao').html('');
            Metronic.blockUI();
        },
        success: function (data) {
            $.dialog({
                title: data.title,
                content: data.link_file,
            });
        },
        complete: function () {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            $('.thongbao').html(r1.responseText);
        }
    });
}
function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
function viewData($controller_action, $dataInput, $size, callbackSuccess){
    $.confirm({
        content: function () {
            var self = this;
            return $.ajax({
                url: 'index.php?r=' + $controller_action,
                data: $dataInput,
                type: 'post',
                dataType: 'json'
            }).success(function (data) {
                self.setContent(data.content);
                self.setTitle(data.title);
                self.setType('blue');
                if(typeof callbackSuccess != "undefined")
                    callbackSuccess(data);
            }).error(function (r1, r2) {
                self.setContent(getMessage(r1.responseText));
                self.setTitle('Lỗi');
                self.setType('red');
                return false;
            });
        },
        columnClass: $size,
        buttons: {
            btnClose: {
                text: '<i class="fa fa-close"></i> Đóng lại'
            }
        }
    });
}
function showAlert($message){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": function () {
            // if($link != '')
            //     window.location = $link
        },
        "showDuration": "10000",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr['info']($message, 'Thông báo');
}
function tinhDiemMoiCaNhan($idNhanVienPhongBan){
    var $tongDiem = 0;
    $("tr.tr-nhan-vien-"+$idNhanVienPhongBan).each(function () {
        var $myParentTr = $(this).parent().parent().parent().parent();
        var $myCheckBox = $myParentTr.find('.checkChonCVQuy ');
        if($myCheckBox.is(":checked")){
            var $myInputDiem = $(this).find('td.td-diem-nhan-vien input').val();
            var $thucHien = $(this).find('td.td-thuc-hien select').val();
            $myInputDiem = ($myInputDiem == '' ? 0 : parseFloat($myInputDiem));
            if($thucHien == 1)
                $tongDiem += $myInputDiem;
        }

    });
    $("#diem-nvien-" + $idNhanVienPhongBan).text($tongDiem);
}

 function loadFormModel($dataInput, $size = 'modal-full', $obj, btnSave = () => {}, btnClose = () => {})
 {
     $.ajax({
         url: 'index.php?r=site/load-form-modal',
         data: $dataInput,
         dataType: 'json',
         type: 'post',
         beforeSend: function () {
             $.blockUI();
         },
         success: function (data) {
             $(".modal").remove()
             $(".modal-backdrop").remove()
             $($obj).html(data)
             $(".modal-dialog").addClass($size);
             $("#modal-id").modal('show');
             $($obj + ' .modal-footer .btn-primary').remove();
             jQuery('.date').datepicker($.extend({}, $.datepicker.regional['vi'], {
                 "changeMonth": true,
                 "yearRange": "1972:2022",
                 "changeYear": true,
                 "dateFormat": "dd\/mm\/yy"
             }));

         },
         complete: function () {
             $.unblockUI();
         },
         error: function (r1, r2) {
             $.alert(r1.responseText)
         }
     })

     $(document).on("click", $obj + ' .modal-footer .btn-default', function () {
         btnClose();
     })
 }

function tinhTongDiemDonVi(){
    var $tongDiem = 0;
    $(".diem-so-don-vi input").each(function () {
        var $diemSo = $(this).val();
        $tongDiem += ($diemSo == '' ? 0 : parseFloat($diemSo));
    });
    $("span#tong-diem").text($tongDiem);
}

jQuery(document).ready(function() {

    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    // $(".tien-te").maskMoney({thousands:",", allowZero:true, /*suffix: " VNĐ",*/precision:3});
    // Hiển thị thông báo các công việc đã hoàn thành nhưng chưa duyệt
    $(document).on('click', 'ul li a.hover-initialized', function (e) {
        e.preventDefault();

        var $parent = $(this).parent();
        if($parent.find('ul').length > 0){
            $parent.addClass('open');
            $(this).attr('aria-expanded', 'true');
        }
    });

    $('#crud-datatable-pjax').on('pjax:success', function () {
        $('.created-date-field').datepicker({dateFormat: 'dd/mm/yy'})
        // $('.time-picker').timepicker({timeFormat: "h:mm:ii"})
    })
})

 /**
  * Tuỳ chỉnh lại function ModalRemote của thư viện johnitvn
  * @param modalId
  * @constructor
  */

 function ModalRemote(modalId) {

     this.defaults = {
         okLabel: "OK",
         executeLabel: "Execute",
         cancelLabel: "Hủy",
         loadingTitle: "Loading"
     };

     this.modal = $(modalId);

     this.dialog = $(modalId).find('.modal-dialog');

     this.header = $(modalId).find('.modal-header');

     this.content = $(modalId).find('.modal-body');

     this.footer = $(modalId).find('.modal-footer');

     this.loadingContent = '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>';


     /**
      * Show the modal
      */
     this.show = function () {
         this.clear();
         $(this.modal).modal('show');
     };

     /**
      * Hide the modal
      */
     this.hide = function () {
         $(this.modal).modal('hide');
     };

     /**
      * Toogle show/hide modal
      */
     this.toggle = function () {
         $(this.modal).modal('toggle');
     };

     /**
      * Clear modal
      */
     this.clear = function () {
         $(this.modal).find('.modal-title').remove();
         $(this.content).html("");
         $(this.footer).html("");
     };

     /**
      * Set size of modal
      * @param {string} size large/normal/small
      */
     this.setSize = function (size) {
         $(this.dialog).removeClass('modal-lg');
         $(this.dialog).removeClass('modal-sm');
         if (size == 'large')
             $(this.dialog).addClass('modal-lg');
         else if (size == 'small')
             $(this.dialog).addClass('modal-sm');
         else if (size !== 'normal')
             console.warn("Undefined size " + size);
     };

     /**
      * Set modal header
      * @param {string} content The content of modal header
      */
     this.setHeader = function (content) {
         $(this.header).html(content);
     };

     /**
      * Set modal content
      * @param {string} content The content of modal content
      */
     this.setContent = function (content) {
         $(this.content).html(content);
     };

     /**
      * Set modal footer
      * @param {string} content The content of modal footer
      */
     this.setFooter = function (content) {
         $(this.footer).html(content);
     };

     /**
      * Set modal footer
      * @param {string} title The title of modal
      */
     this.setTitle = function (title) {
         // remove old title
         $(this.header).find('h4.modal-title').remove();
         // add new title
         $(this.header).append('<h4 class="modal-title">' + title + '</h4>');
     };

     /**
      * Hide close button
      */
     this.hidenCloseButton = function () {
         $(this.header).find('button.close').hide();
     };

     /**
      * Show close button
      */
     this.showCloseButton = function () {
         $(this.header).find('button.close').show();
     };

     /**
      * Show loading state in modal
      */
     this.displayLoading = function () {
         this.setContent(this.loadingContent);
         this.setTitle(this.defaults.loadingTitle);
     };

     /**
      * Add button to footer
      * @param string label The label of button
      * @param string classes The class of button
      * @param callable callback the callback when button click
      */
     this.addFooterButton = function (label, type, classes, callback) {
         buttonElm = document.createElement('button');
         buttonElm.setAttribute('type', type === null ? 'button' : type);
         buttonElm.setAttribute('class', classes === null ? 'btn btn-primary' : classes);
         buttonElm.innerHTML = label;
         var instance = this;
         $(this.footer).append(buttonElm);
         if (callback !== null) {
             $(buttonElm).click(function (event) {
                 callback.call(instance, this, event);
             });
         }
     };

     /**
      * Send ajax request and wraper response to modal
      * @param {string} url The url of request
      * @param {string} method The method of request
      * @param {object}data of request
      */
     this.doRemote = function (url, method, data) {
         var instance = this;
         $.ajax({
             url: url,
             method: method,
             data: data,
             async: false,
             beforeSend: function () {
                 beforeRemoteRequest.call(instance);
             },
             error: function (response) {
                 errorRemoteResponse.call(instance, response);
             },
             success: function (response) {
                 successRemoteResponse.call(instance, response);
             },
             contentType: false,
             cache: false,
             processData: false
         });
     };

     /**
      * Before send request process
      * - Ensure clear and show modal
      * - Show loading state in modal
      */
     function beforeRemoteRequest() {
         this.show();
         this.displayLoading();
     }


     /**
      * When remote sends error response
      * @param {string} response
      */
     function errorRemoteResponse(response) {
         this.setTitle(response.status + response.statusText);
         this.setContent(response.responseText);
         this.addFooterButton('Close', 'button', 'btn btn-default', function (button, event) {
             this.hide();
         })
     }

     /**
      * When remote sends success response
      * @param {string} response
      */
     function successRemoteResponse(response) {

         // Reload datatable if response contain forceReload field
         if (response.forceReload !== undefined && response.forceReload) {
             try {
                 if (response.forceReload == 'true') {
                     // Backwards compatible reload of fixed crud-datatable-pjax
                     $.pjax.reload({container: '#crud-datatable-pjax'});
                 } else {
                     $.pjax.reload({
                         container: response.forceReload
                     });
                 }
             }
             catch(err){
             }
         }

         // Close modal if response contains forceClose field
         if (response.forceClose !== undefined && response.forceClose) {
             this.hide();
             return;
         }
         if (response.size !== undefined)
             this.setSize(response.size);

         if (response.title !== undefined)
             this.setTitle(response.title);

         if (response.content !== undefined)
             this.setContent(response.content);

         if (response.footer !== undefined)
             this.setFooter(response.footer);

         if ($(this.content).find("form")[0] !== undefined) {
             this.setupFormSubmit(
                 $(this.content).find("form")[0],
                 $(this.footer).find('[type="submit"]')[0]
             );
         }
     }

     /**
      * Prepare submit button when modal has form
      * @param {string} modalForm
      * @param {object} modalFormSubmitBtn
      */
     this.setupFormSubmit = function (modalForm, modalFormSubmitBtn) {

         if (modalFormSubmitBtn === undefined) {
             // If submit button not found throw warning message
             console.warn('Modal has form but does not have a submit button');
         } else {
             var instance = this;

             // Submit form when user clicks submit button
             $(modalFormSubmitBtn).click(function (e) {
                 var data;

                 // Test if browser supports FormData which handles uploads
                 if (window.FormData) {
                     data = new FormData($(modalForm)[0]);
                 } else {
                     // Fallback to serialize
                     data = $(modalForm).serializeArray();
                 }
                var action = $(modalForm).attr('action');
                 var method = $(modalForm).hasAttr('method') ? $(modalForm).attr('method') : 'GET';
                 instance.displayLoading();
                 setTimeout(() => {
                     instance.doRemote(
                         $(modalForm).attr('action'),
                         $(modalForm).hasAttr('method') ? $(modalForm).attr('method') : 'GET',
                         data
                     );
                 }, 500);
             });
         }
     };

     /**
      * Show the confirm dialog
      * @param {string} title The title of modal
      * @param {string} message The message for ask user
      * @param {string} okLabel The label of ok button
      * @param {string} cancelLabel The class of cancel button
      * @param {string} size The size of the modal
      * @param {string} dataUrl Where to post
      * @param {string} dataRequestMethod POST or GET
      * @param {number[]} selectedIds
      */
     this.confirmModal = function (title, message, okLabel, cancelLabel, size, dataUrl, dataRequestMethod, selectedIds) {
         this.show();
         this.setSize(size);

         if (title !== undefined) {
             this.setTitle(title);
         }
         // Add form for user input if required
         this.setContent('<form id="ModalRemoteConfirmForm">'+message);

         var instance = this;
         if (okLabel !== false) {
             this.addFooterButton(
                 okLabel === undefined ? this.defaults.okLabel : okLabel,
                 'submit',
                 'btn btn-primary',
                 function (e) {
                     var data;

                     // Test if browser supports FormData which handles uploads
                     if (window.FormData) {
                         data = new FormData($('#ModalRemoteConfirmForm')[0]);
                         if (typeof selectedIds !== 'undefined' && selectedIds)
                             data.append('pks', selectedIds.join());
                     } else {
                         // Fallback to serialize
                         data = $('#ModalRemoteConfirmForm');
                         if (typeof selectedIds !== 'undefined' && selectedIds)
                             data.pks = selectedIds;
                         data = data.serializeArray();
                     }

                     instance.doRemote(
                         dataUrl,
                         dataRequestMethod,
                         data
                     );
                 }
             );
         }

         this.addFooterButton(
             cancelLabel === undefined ? this.defaults.cancelLabel : cancelLabel,
             'button',
             'btn btn-default pull-left',
             function (e) {
                 this.hide();
             }
         );

     }

     /**
      * Open the modal
      * HTML data attributes for use in local confirm
      *   - href/data-url         (If href not set will get data-url)
      *   - data-request-method   (string GET/POST)
      *   - data-confirm-ok       (string OK button text)
      *   - data-confirm-cancel   (string cancel button text)
      *   - data-confirm-title    (string title of modal box)
      *   - data-confirm-message  (string message in modal box)
      *   - data-modal-size       (string small/normal/large)
      * Attributes for remote response (json)
      *   - forceReload           (string reloads a pjax ID)
      *   - forceClose            (boolean remote close modal)
      *   - size                  (string small/normal/large)
      *   - title                 (string/html title of modal box)
      *   - content               (string/html content in modal box)
      *   - footer                (string/html footer of modal box)
      * @params {elm}
      */
     this.open = function (elm, bulkData) {
         /**
          * Show either a local confirm modal or get modal content through ajax
          */
         if ($(elm).hasAttr('data-confirm-title') || $(elm).hasAttr('data-confirm-message')) {
             this.confirmModal (
                 $(elm).attr('data-confirm-title'),
                 $(elm).attr('data-confirm-message'),
                 $(elm).attr('data-confirm-alert') ? false : $(elm).attr('data-confirm-ok'),
                 $(elm).attr('data-confirm-cancel'),
                 $(elm).hasAttr('data-modal-size') ? $(elm).attr('data-modal-size') : 'normal',
                 $(elm).hasAttr('href') ? $(elm).attr('href') : $(elm).attr('data-url'),
                 $(elm).hasAttr('data-request-method') ? $(elm).attr('data-request-method') : 'GET',
                 bulkData
             )
         } else {
             this.doRemote(
                 $(elm).hasAttr('href') ? $(elm).attr('href') : $(elm).attr('data-url'),
                 $(elm).hasAttr('data-request-method') ? $(elm).attr('data-request-method') : 'GET',
                 bulkData
             );
         }
     }
 } // End of Object
