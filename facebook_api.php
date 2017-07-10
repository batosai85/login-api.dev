<?php session_start();
$_SESSION["email"] = '';
?>
<!DOCTYPE>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '292673784476271'
            , autoLogAppEvents: true
            , xfbml: true
            , version: 'v2.9'
        });
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }
    function statusChangeCallback(response) {
        if (response.status === "connected") {
            testApi();
        }
    }
    function testApi() {
        FB.api("/me?fields=name, email, birthday, location, education", function (response) {
            if (response && !response.error) {

                var name = response.hasOwnProperty("name") ? response.name : '';
                var email =  response.hasOwnProperty("email") ? response.email : '';
                var  birthday =  response.hasOwnProperty("birthday") ? response.birthday : '';
                var location =  response.hasOwnProperty("location") ? response.location.name :  '';
                var education = response.hasOwnProperty("education") ? response.education[0].school.name : '';
                var json = {
                    name: name,
                    email: email,
                    birthday: birthday,
                    location: location,
                    education: education
                };
                $.ajax({
                    type: "POST",
                    url: "post.php",
                    data: json,
                    success: function (data) {
                        if (data === "logged") {
                           window.location.href = "http://login-api.dev/user.php";
                        }
                    },
                    error: function (error) {
                        alert("error");
                    }
                })
            }
        });
    }

</script>
<div style="margin:0 auto; width:40%;text-align:center;padding:50px;">
  <fb:login-button id="fb-login-btn" size="large"
                 scope="public_profile,email, user_birthday, user_location, user_education_history"
                 onlogin="checkLoginState()"> Login With Facebook
  </fb:login-button>
</div>
</body>

</html>