$(document).ready(function () {
    $(document).on('click','.btn-duyet-phieu', function (e){
        e.preventDefault()
        loadForm('index.php?r=tuyen-dung-dk-nhu-cau-ns/loadformduyetphieu',{ id: $(this).attr('data-value'),
               urlloadform: '../tuyen-dung-dk-nhu-cau-ns/form_pop_up'}, 'm',
            function (){},
            function () {},{
            btnSave:{
                    class:'btn btn-primary',
                    text:'<i class="fa fa-check-circle"> Duyệt</i>',
                    action:true,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 'Đã duyệt',
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                },
                somethingElse:{
                    class:'btn btn-danger',
                    text:'<i class="fa fa-ban"> Không duyệt</i>',
                    action:true,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 'Không duyệt',
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                }
            })
    });
})
