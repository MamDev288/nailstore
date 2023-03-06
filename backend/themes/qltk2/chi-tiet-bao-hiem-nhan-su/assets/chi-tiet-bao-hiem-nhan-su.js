const chiTietBaoHiemNhanSuFormId = '#chi-tiet-bao-hiem-nhan-su-form'

function handleChangeForm(){
    $(document).on('change', `${chiTietBaoHiemNhanSuFormId} :input`, function () {
        let chiTietBaoHiemNhanSuWrapClass = '.chi-tiet-bao-hiem-nhan-su-create';

        if (!$(document).find(chiTietBaoHiemNhanSuWrapClass)){
            chiTietBaoHiemNhanSuWrapClass = '.chi-tiet-bao-hiem-nhan-su-update';
        }

        const data = $(`${chiTietBaoHiemNhanSuFormId}`).serialize();

        $.ajax({
            type: "POST",
            url: `${baseUrl}chi-tiet-bao-hiem-nhan-su/reload-data`,
            data,
            dataType: "json",
            success: function (result) {
                if (result.success){
                    if (modal) {
                        if ($(modal.footer).find('[type="submit"]')[0]){
                            var clone = $(modal.footer).find('[type="submit"]').clone()
                            $(modal.footer).find('[type="submit"]').remove()
                            $(modal.footer).append(clone)
                        }

                        $('body').find('.modal-body').html(result.html)

                        if ($(modal.content).find("form")[0] !== undefined){
                            modal.setupFormSubmit(
                                $(modal.content).find("form")[0],
                                $(modal.footer).find('[type="submit"]')[0]
                            )
                        }
                    }
                }
            }
        })
    })
}

handleChangeForm();