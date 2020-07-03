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
var userRef = firebase.database().ref('userlist');

$('#mainform').submit(function(e) {
    e.preventDefault();
 
    var newuserRef = userRef.push();
    newuserRef.set({
        uname: $('#username').val(),
        email: $('#email').val(),
        password: $('#password').val(),
    });
 
    
});
