$(document).ready(function () {
    $(document).on('click','.btn-duyet-phieu', function (e){
        e.preventDefault()
        loadForm('index.php?r=duyet-don-dang-ki-tuyen-dung/loadformduyetphieu',{ id: $(this).attr('data-value'),
               urlloadform: '../tuyen-dung-dk-nhu-cau-ns/form_pop_up'}, 'm',
            function (){},
            function () {},{
            btnSave:{
                    class:'btn btn-success',
                    text:'<i class="fa fa-check-circle"></i> Lưu',
                    action:true,
                    ajax: false,
                    data:{id: $(this).attr('data-value'),
                        trangThai: 'Đã duyệt',
                    },
                    mess:'Cập nhật trạng thái phiếu dụng thành công'
                }
            })
    })

    $(document).on('click','.btn-delete', function (e){
        e.preventDefault()
        loadForm('index.php?r=tuyen-dung-dk-nhu-cau-ns/delete', { id: $(this).attr('data-value') }, 'm',
            function (){},
            function () {}, {
                cancel: {
                    class:'btn btn-danger',
                    text:'<i class="fa fa-trash"></i> Xóa',
                    action:true,
                    ajax: true,
                    data:{
                        id: $(this).attr('data-value'),
                        trangThai: 'dong-y-xoa'
                    },
                    mess:'Xóa phiếu tuyển dụng thành công'
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
