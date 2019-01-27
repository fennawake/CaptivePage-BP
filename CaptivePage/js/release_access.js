$(document).ready(function () {

  $("#status").hide();

  if( $("#terms-and-conditions").is(':checked') ){
    $("#submit").css({ opacity: 1 }, 0 );
    $("#btn-face").css({ opacity: 1 }, 0 );
    $('#submit').removeAttr("disabled");
    $('#btn-face').removeAttr("disabled");
    $('#access-continue').hide();
    $("#status").hide();
  } else {
    $("#submit").css({ opacity: 0.3 }, 0 );
    $("#btn-face").css({ opacity: 0.3 }, 0 );
    $('#submit').prop('disabled', true);
    $('#btn-face').prop('disabled', true);
    $('#access-continue').show();
    $("#status").hide();
  }

  $("#terms-and-conditions").click(function () {  
    if( $("#terms-and-conditions").is(':checked') ){
      $("#submit").css({ opacity: 1 }, 0 );
      $("#btn-face").css({ opacity: 1 }, 0 );
      $('#submit').removeAttr("disabled");
      $('#btn-face').removeAttr("disabled");
      $('#access-continue').hide();
      $("#status").hide();
    } else {
      $("#submit").css({ opacity: 0.3 }, 0 );
      $("#btn-face").css({ opacity: 0.3 }, 0 );
      $('#submit').prop('disabled', true);
      $('#btn-face').prop('disabled', true);
      $('#access-continue').show();
      $("#status").hide();
    }
  });

  $("#btn-face").click(function () {  
    fbLogin();
  });
});

function statusChangeCallback(response) {
  if (response.status === 'connected') {
    fbLogin();
  }
}

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
    FB.init({
      appId      : '503820390025659',
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
    
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

};

(function(d, s, id) { 
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function fbLogin() {
  FB.login(function (response) {
    if (response.authResponse) {
      getFbUserData();
    } else {
      document.getElementById("status").style.display = "block";
      document.getElementById('txt-status').innerHTML = 'User cancelled login or did not fully authorize.';
    }
  }, {scope: 'email, user_birthday, user_gender'});
}

function getFbUserData(){
  FB.api('/me', {fields: 'id,name,email,picture,gender,birthday'},
  function (response) {
    $.ajax({
      type: "POST",
      url: 'php/user_data.php',
      data: response,
      success:function(response){
        window.location.href = "https://www.instagram.com/burleighpavilion/";
        
      }
    });
  });
}