<?php
    session_start();
    $email = $_SESSION["email"];
    if ($email === '') {
        header("Location:  http://login-api.dev/facebook_api.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '292673784476271'
            , autoLogAppEvents: true
            , xfbml: true
            , version: 'v2.9'
        });
        FB.getLoginStatus(function (response) {

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
    function logout() {
            FB.getLoginStatus(function(response) {
                if (response && response.status === 'connected') {
                    FB.logout(function(response) {
                        $.ajax({
                            type : "POST",
                            url : "logout.php",
                            data : {email : ''},
                            success : function(data){
                                window.location.href = "http://login-api.dev/facebook_api.php";
                            },
                            error : function(err){
                                alert(err);
                            }
                        });
                    });
                }
            });
    }
</script>
<script>
    $.ajax({
        type : "GET",
        url : "get.php",
        success : function(data){
            var user = JSON.parse(data);
            for (var prop in user) {
             $(".bio").append("<li><h3>"+ prop + " : " + user[prop] + "</h3></li>");
            }
        },
        error : function(err){
            alert("err");
        }
    })
</script>
 <div style="margin:0 auto; width:40%;text-align:center;padding:50px;">
     <ul class="bio" style="list-style: none;"></ul>
     <button onclick = "logout()">Logout</button>
 </div>
</body>
</html>