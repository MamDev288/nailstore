// import  DotenvModule  from "../../../node_modules/dotenv/lib/main.js"
// import dotenv from 'dotenv'
// DotenvModule.config();
// var firebaseConfig = {
//     apiKey: process.env.APIKEY,
//     authDomain: process.env.AUTH_DOMAIN,
//     projectId: process.env.PROJECT_ID,
//     storageBucket: process.env.STOGARE_BUCKET,
//     messagingSenderId: process.env.MESSAGING_SENDER_ID,
//     appId: process.env.APP_ID,
// };
// importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js");
// importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js");

var firebaseConfig = {
    apiKey: "AIzaSyD_NrnNCVW8g9LtKFaujYqsubCesnn2Bmw",
    authDomain: "hrm-notify.firebaseapp.com",
    projectId: "hrm-notify",
    storageBucket: "hrm-notify.appspot.com",
    messagingSenderId: "559499416921",
    appId: "1:559499416921:web:f7534414dcf6be9c2d2848"
};
firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

function IntitalizeFireBaseMessaging() {
    messaging
        .requestPermission()
        .then(function () {
            console.log("Notification Permission");
            return messaging.getToken();
        })
        .then(function (token) {
            console.log("Token : "+token);
            $.ajax({
                type: "POST",
                url: 'index.php?r=token-notify/add-token-into-database',
                data: {
                    token: token,
                },
                dataType: 'json',
                beforeSend: function () {
                    Metronic.blockUI();
                },
                success: function (response) {
                    console.log('Token saved')
                }, complete: function (response) {
                    Metronic.unblockUI();
                },
                error: function (r1, r2) {
                    console.log(r1.responseText)
                }
            });
        })
        .catch(function (reason) {
            console.log(reason);
        });
}

messaging.onMessage(function (payload) {
    console.log(payload);
    const notificationOption={
        body:payload.notification.body,
        icon:payload.notification.icon
    };

    if(Notification.permission==="granted"){
        var notification=new Notification(payload.notification.title,notificationOption);

        notification.onclick=function (ev) {
            ev.preventDefault();
            window.open(payload.notification.click_action,'_blank');
            notification.close();
        }
    }

    $.ajax({
        type: "POST",
        url: 'index.php?r=thong-bao/get-notification',
        data: {
            click: 0,
        },
        dataType: 'json',
        beforeSend: function () {
            Metronic.blockUI();
        },
        success: function (response) {
            console.log(response)
            $('#number-notify').text(response.item_notify.length)
            $('.item-notification').prepend(`
                    <div id="item`+ response.item_notify[0].id +`" class="notifications-item not-seen-text" data-value="`+ response.item_notify[0].id +`" data-url="`+ response.item_notify[0].link +`">
                        <div class="text">
                            <h4>`+ response.item_notify[0].title +`</h4>
                            <p>`+ response.item_notify[0].noi_dung +`</p>
                        </div>
                    </div>`)

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
            console.log(response.item_notify[0].noi_dung)
        }, complete: function (response) {
            Metronic.unblockUI();
        },
        error: function (r1, r2) {
            console.log(r1.responseText)
        }
    });

});
messaging.onTokenRefresh(function () {
    messaging.getToken()
        .then(function (newtoken) {
            console.log("New Token : "+ newtoken);
        })
        .catch(function (reason) {
            console.log(reason);
        })
})
IntitalizeFireBaseMessaging();