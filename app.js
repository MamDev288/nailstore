if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {

        navigator.serviceWorker.register('firebase-messaging-sw.js')
            .then(registration => {
                console.log(registration)

                //Confirm user permission for notification
                Notification.requestPermission()
                    .then(permission => {

                        messaging.getToken().then(
                            token => {
                                console.log(token)
                            })


                        if (permission === 'granted') {
                            //If notification is allowed
                            console.log('granted!!!!!')
                            navigator.serviceWorker.ready.then(p => {

                                p.pushManager.getSubscription().then(subscription => {

                                    if (subscription === null) {

                                        //If there is no notification subscription, register.
                                        let re = p.pushManager.subscribe({
                                            userVisibleOnly: true
                                        })

                                    }
                                })

                            })

                        } else {
                            //If notification is not allowed
                            console.log(permission)
                        }
                    })
            })
    })
}