function loadViewForm(class_name, type){
    $('.class_name').on('click', function (e) {
            console.log('kagshjdfgasjfgakhgs')
            e.preventDefault()
            loadForm({type: 'type', id: $(this).attr('data-value')}, 'l', function (data) {
            }, function () {
            })
    })
}
