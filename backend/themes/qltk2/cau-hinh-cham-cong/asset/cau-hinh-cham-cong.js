$(document).ready(function () {
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault()
            loadForm('index.php?r=cau-hinh-cham-cong/delete', {id: $(this).attr('data-value')}, 'm',
                function () {
                },
                function () {
                }, {
                    cancel: {
                        class: 'btn btn-danger',
                        text: '<i class="fa fa-trash"></i> Xóa',
                        action: true,
                        ajax: true,
                        data: {
                            id: $(this).attr('data-value'),
                            trangThai: 'dong-y-xoa'
                        },
                        mess: 'Xóa phiếu tuyển dụng thành công'
                    }
                })
        })

})

