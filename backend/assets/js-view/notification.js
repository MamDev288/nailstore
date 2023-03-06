$(document).ready(function(e){

    $('body').click(function (e) {
        if (e.target.classList[1]==='fa-bell' && $('#box').css('visibility')==='hidden' ||
            $(e.target).closest('#box').length && $(e.target).is('#box') || $(e.target).is('.header-notify') || $(e.target).is('.btn-read-all-notify')) {
            $('#box').css('height','auto');
            $('#box').css('opacity','1');
            $('#box').css('visibility','visible');
            $('.notifications').css('opacity','1');
            $('.notifications').css('visibility','visible');

        }
        else if (!$(e.target).is('.header-notify') || !$(e.target).is('.btn-read-all-notify'))
        {
            $('#box').css('height','0px');
            $('#box').css('opacity','0');
            $('#box').css('visibility','hidden');
            $('.notifications').css('opacity','1');
            $('.notifications').css('visibility','hidden')

        }
    })

    $('.notifications').css('opacity','0');
    $('.notifications').css('visibility','hidden');

    $.ajax({
        type: "POST",
        url: 'index.php?r=thong-bao/get-notification',
        data: {click: 1},
        dataType: 'json',
        beforeSend: function () {
            Metronic.blockUI();
        },
        success: function (response) {
            $.each(response.item_notify, function (k, value){
                    $('.item-notification').append(`
                                <a id="item${value.id}" class="notifications-item ${value.is_seen === 0 ? 'not-seen-text' : ''}" data-value="${value.id}" href="${value.link}" ${value.modal_remote ? "role='modal-remote'" : ''}>
                                    <div class="text">
                                    <h4>${value.title}</h4>
                                    <p>${value.noi_dung}</p>
                            </div>
                        </a>`);

            })

            $('.notifications-item').on('click', function (){
                const id = $(this).attr('data-value')
                $.ajax({
                    type: "POST",
                    url: 'index.php?r=thong-bao/is-seen-notify',
                    data: {
                        id: $(this).attr('data-value'),
                        all: 0
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        Metronic.blockUI();
                    },
                    success: function (response) {
                        $("#item"+id).removeClass("not-seen-text");
                        const number_notify = parseInt($('#number-notify').text())
                        if ((number_notify - 1) >= 0){
                            $('#number-notify').text(number_notify - 1)
                        }
                    }, complete: function (response) {
                        Metronic.unblockUI();
                    },
                    error: function (r1, r2) {
                        console.log(r1.responseText)
                    }
                });
            })

            $('.btn-read-all-notify').on('click', function (){
                $.ajax({
                    type: "POST",
                    url: 'index.php?r=thong-bao/seen-all-notify',
                    data: {},
                    dataType: 'json',
                    beforeSend: function () {
                        Metronic.blockUI();
                    },
                    success: function (response) {
                        $(".notifications-item").removeClass("not-seen-text");
                        $('#number-notify').text(0)
                    }, complete: function (response) {
                        Metronic.unblockUI();
                    },
                    error: function (r1, r2) {
                        console.log(r1.responseText)
                    }
                });
            })
        },
        complete: function (response) {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            console.log(r1.responseText)
        }
    });

});