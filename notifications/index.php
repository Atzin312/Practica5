<html>
<head>
    <title>Aplicacion con notificiaciones</title>
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.6.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAb9OQzSVm9ddqFBnG7cWt75qaaXMgStwg",
    authDomain: "clase-mantenimiento-5dd69.firebaseapp.com",
    databaseURL: "https://clase-mantenimiento-5dd69.firebaseio.com",
    projectId: "clase-mantenimiento-5dd69",
    storageBucket: "clase-mantenimiento-5dd69.appspot.com",
    messagingSenderId: "221678605928"
  };
  firebase.initializeApp(config);

// Retrieve Firebase Messaging object.
  const messaging = firebase.messaging();
  
  messaging.requestPermission().then(function() {
console.log('Notification permission granted.');

console.log(currentToken);

saveToken(currentToken);

setTokenSentToServer(true);

}).catch(function(err) {
console.log('Unable to get permission to notify.', err);
});

function getRegToken(){
messaging.getToken().then(function(currentToken) {
if (currentToken) {
    sendTokenToServer(currentToken);
    updateUIForPushEnabled(currentToken);
} else {
     console.log('No Instance ID token available. Request permission to generate one.');
     setTokenSentToServer(false);
    }
}).catch(function(err) {
    console.log('An error occurred while retrieving token. ', err);
    showToken('Error retrieving Instance ID token. ', err);
    setTokenSentToServer(false);
});
}
function showToken(currentToken) {
    // Show token in console and UI.
    var tokenElement = document.querySelector('#token');
    tokenElement.textContent = currentToken;
}

function saveToken(currentToken){
 $.ajax({
 url:'action.php',
 method:'post',
 data: 'token=' + currentToken
 }).done(function(result){
 console.log();
 })
 }

 function isTokenSentToServer() {
 return window.localStorage.getItem('sentToServer') == 1;
 }

 if (isTokenSentToServer()) {
 console.log('token ya fue enviado');
 }else{
 recuperarToken();
 }

  function resetUI() {
    clearMessages();
    showToken('loading...');
    // [START get_token]
    // Get Instance ID token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken().then(function(currentToken) {
      if (currentToken) {
        sendTokenToServer(currentToken);
        updateUIForPushEnabled(currentToken);
      } else {
        // Show permission request.
        console.log('No Instance ID token available. Request permission to generate one.');
        // Show permission UI.
        updateUIForPushPermissionRequired();
        setTokenSentToServer(false);
      }
    }).catch(function(err) {
      console.log('An error occurred while retrieving token. ', err);
      showToken('Error retrieving Instance ID token. ', err);
      setTokenSentToServer(false);
    });
  }
  messaging.onMessage(function(payload){
var title = payload.data.title;
var options = {
body: payload.data.body,
icon: payload.data.icon
}
var myNotification = new Notification(title, options);
console.log('Mensaje recibidio', payload)
})

</script>

<link rel="manifest" href="manifest.json">
</head>
<body>
<h1>App con notificaciones </h1>

</body>
</html>