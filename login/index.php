<?php
require_once '../lib/cl.user.php';
if($user->is_loggedin()!="")
{
        $user->redirect('../admin/index.php');
}
    if(isset($_POST['tom-login']))
{
    $uname = trim($_POST['txt_uname']); 
    $umail = trim($_POST['txt_uname']); 
    $upassword = trim($_POST['txt_upass']);
    
        
    if($user->login($uname,$upassword,$umail))
    {
        
        $user->redirect('../');
    }
    else
    {
        echo"<script>alert('Maaf password atau username anda salah')</script>";
    }   
}
if(!$user->cekSession())
{
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <title>Silahkan Login</title>

    <link href="../style/css/metro.css" rel="stylesheet">
    <link href="../style/css/metro-icons.css" rel="stylesheet">
    <link href="../style/css/metro-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style/css/style4.css" />
    <script type="text/javascript" src="../style/js/modernizr.custom.86080.js"></script>

    <script src="../style/js/jquery-2.1.3.min.js"></script>
    <script src="../style/js/metro.js"></script>
 
    <style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>

    <script>

     
        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body class="bg-darkTeal" id="page">

<ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>rendah hati</h3></div></li>
            <li><span>Image 02</span><div><h3>Professional</h3></div></li>
            <li><span>Image 03</span><div><h3>melayani</h3></div></li>
            <li><span>Image 04</span><div><h3>kemanusiaan</h3></div></li>
            <li><span>Image 05</span><div><h3>qui·e·tude</h3></div></li>
            <li><span>Image 06</span><div><h3>re·lax·a·tion</h3></div></li>
        </ul>   
        <div class="login-form padding20 block-shadow" style="height: 400px; top:30%;">    
                <form method="post">
                <h1 class="text-light">Login to service</h1>
                <h3 class="text-light">Selamat datang di login sistem akademis siswa</h3>
                    <hr class="thin"/>
                    <br><br>
                    <div class="input-control text full-size" data-role="input">
                        <label for="user_login">ID:</label>
                        <input type="text" name="txt_uname" id="user_login" required>
                        <button class="button helper-button clear"><span class="mif-cross"></span></button>
                    </div>
                    <br />
                    <br />
                    <div class="input-control password full-size" data-role="input">
                        <label for="user_password">User password:</label>
                        <input type="password" name="txt_upass" id="user_password" required>
                        <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                    </div>
                    <br />
                    <br />
                    <div class="form-actions">
                        <button type="submit" name="tom-login" class="button primary">Login to...</button>
                        <button type="button" name="btn-cancel" class="button link" onclick="Redirect();">Cancel</button>
                    </div>
                </form>
        </div>
</body>
</html>
 <script type="text/javascript">
         <!--
            function Redirect() {
               window.location="../web";
            }
         //-->
      </script>

<?php 
}
 ?>