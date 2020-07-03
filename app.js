  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAjZDvd_WoEPdrl0XnQckPhUo1HdSxaVEk",
    authDomain: "attendance-system-61c28.firebaseapp.com",
    databaseURL: "https://attendance-system-61c28.firebaseio.com",
    projectId: "attendance-system-61c28",
    storageBucket: "attendance-system-61c28.appspot.com",
    messagingSenderId: "514327429389",
    appId: "1:514327429389:web:363c474eaa28ffb5723044",
    measurementId: "G-C5GT19D46Y"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
var messagesRef = firebase.database().ref('contactformmessages');

$('#contactForm').submit(function(e) {
    e.preventDefault();
 
    var newMessageRef = messagesRef.push();
    newMessageRef.set({
        name: $('.fullname').val(),
        email: $('.email').val(),
        subject: $('.subject').val(),
        message: $('.message').val()
    });
 
    $('.success-message').show();
 
    $('#contactForm')[0].reset();
});
