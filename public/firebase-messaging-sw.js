/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/

importScripts('https://www.gstatic.com/firebasejs/8.5.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.5.0/firebase-analytics.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDOHXhwhtBJTnz7HjKSoWiqYEq3ejqWmvU",
    authDomain: "my-project-1550375136248.firebaseapp.com",
    projectId: "my-project-1550375136248",
    databaseURL: "https://itdemo-push-notification.firebaseio.com",

    storageBucket: "my-project-1550375136248.appspot.com",
    messagingSenderId: "48033833927",
    appId: "1:48033833927:web:337ce5e642f28f138fefe2",
    measurementId: "G-ZW2L5BXRNQ"
        // measurementId: "G-R1KQTR3JBN"
});




/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});