// Import and configure the Firebase SDK
// These scripts are made available when the app is served or deployed on Firebase Hosting
// If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup
importScripts('/__/firebase/4.10.0/firebase-app.js');
importScripts('/__/firebase/4.10.0/firebase-messaging.js');
importScripts('/__/firebase/init.js');

var config = {
  apiKey: "AIzaSyAb9OQzSVm9ddqFBnG7cWt75qaaXMgStwg",
  authDomain: "clase-mantenimiento-5dd69.firebaseapp.com",
  databaseURL: "https://clase-mantenimiento-5dd69.firebaseio.com",
  projectId: "clase-mantenimiento-5dd69",
  storageBucket: "clase-mantenimiento-5dd69.appspot.com",
  messagingSenderId: "221678605928"
};
firebase.initializeApp(config);


var messaging = firebase.messaging();


messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  var notificationTitle = 'Background Message Title';
  var notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
    notificationOptions);
});
// [END background_handler]