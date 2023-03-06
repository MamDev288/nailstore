const chiTietBangLuongFormId = '#chi-tiet-bang-luong-form';

function handleChangeForm(){
    $(document).on('change',`${chiTietBangLuongFormId} :input`,function(){
        let chiTietBangLuongWrapClass = '.chi-tiet-bang-luong-create';
        if(!$(document).find(chiTietBangLuongWrapClass)){
            chiTietBangLuongWrapClass = '.chi-tiet-bang-luong-update';
        }
        const data = $(`${chiTietBangLuongFormId}`).serialize();
        // 'data-request-method'
        // $(document).append(`<a class="btn btn-reload-data" href="${baseUrl}chi-tiet-bang-luong/reload-data" title="" role="modal-remote"></a>`)
        $.ajax({
            type: "POST",
            url: `${baseUrl}chi-tiet-bang-luong/reload-data`,
            data,
            dataType: "json",
            success: function(res){
                if(res.success){
                    if(modal){
                        if ($(modal.footer).find('[type="submit"]')[0]) {
                            var clone = $(modal.footer).find('[type="submit"]').clone();
                            $(modal.footer).find('[type="submit"]').remove();
                            // console.log($(modal.footer).find('[type="submit"]')[0])
                             $(modal.footer).append(clone);
                        }
                        $('body').find('.modal-body').html(res.html);
                        // console.log($(modal.content).find("form")[0]);
                        if ($(modal.content).find("form")[0] !== undefined) {
                            modal.setupFormSubmit(
                                $(modal.content).find("form")[0],
                                $(modal.footer).find('[type="submit"]')[0]
                            );
                        }

                        // console.log(modal);
                        // $('#ajaxCrudModal').on('click', 'button[type="submit"]', function(e){
                        //     e.preventDefault();
                        // })
                    }
                }
            }
        });
    });
}

handleChangeForm();
