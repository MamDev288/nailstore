$(document).ready(function () {
    $(document).on('click','.btn-duyet-phieu', function (e){
        e.preventDefault()
        loadForm('index.php?r=duyet-nghi-phep/loadformduyetphieu',{ id: $(this).attr('data-value')}, 'm',
            function (){},
            function () {},{
            btnSave:{
                    class:'btn btn-primary',
                    text:'<i class="fa fa-check-circle"> Duyệt</i>',
                    action:true,
                    ajax: true,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 3,
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                },
                somethingElse:{
                    class:'btn btn-danger',
                    text:'<i class="fa fa-ban"> Không duyệt</i>',
                    action:true,
                    ajax: true,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 4,
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                }
            })
    })
})
// $(document).ready(function () {
//     $(document).on('click','.btn-duyet-phieu', function (e){
//         e.preventDefault()
//         loadForm({type: 'duyet_phieu_tuyen_dung', id: $(this).attr('data-value')}, 'm',
//             function (){},
//             function () {})
//     })
//
// })
// {button1:{class:'a'
//     ,text:"a",
//     action:true,
// url:'',
// data:{}},
// mess:''
// ,messerr:''}

// {type: 'duyet_phieu_tuyen_dung', id: $(this).attr('data-value')}
