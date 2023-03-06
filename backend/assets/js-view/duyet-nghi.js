$(document).ready(function () {
    $(document).on('click','.btn-duyet-phieu', function (e){
        e.preventDefault()
        loadForm({type: 'duyet_phieu_tuyen_dung', id: $(this).attr('data-value')}, 'm',
            function (){},
            function () {})
    })

})
