
// The contents of firebaseConfig can be obtained from the firebase console.
// var firebaseConfig = {
//     apiKey: "AIzaSyD_NrnNCVW8g9LtKFaujYqsubCesnn2Bmw",
//     authDomain: "hrm-notify.firebaseapp.com",
//     projectId: "hrm-notify",
//     storageBucket: "hrm-notify.appspot.com",
//     messagingSenderId: "559499416921",
//     appId: "1:559499416921:web:f7534414dcf6be9c2d2848"
// };

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// const messaging = firebase.messaging();
messaging.usePublicVapidKey('[PUBLICVAPIDKEYPUBLICVAPIDKEYPUBLICVAPIDKEYPUBLICVAPIDKEY]');


messaging.onMessage( payload => {
    // OnMessage is called when the web application receives a notification in the foreground state.
    console.log("onMessage")


})

messaging.onTokenRefresh(() => {
    //When the token is updated, onTokenRefresh is called.
    messaging.getToken().then((refreshedToken) => {
        console.log(refreshedToken)
    }).catch((err) => {
        console.log('Unable to retrieve refreshed token ', err);
        showToken('Unable to retrieve refreshed token ', err);
    });
});