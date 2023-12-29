<?php
    session_start();
function show($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
$connect = @new mysqli('localhost','root','','examPHP');
if(isset($_POST['SUB'])){
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $path = $_FILES['photo']['tmp_name'];
    $full_path = $_SERVER['DOCUMENT_ROOT'].'/images/'.$_FILES['photo']['name'];
    $compare_req = $connect->query("SELECT * FROM `exam` WHERE `login` ='$login'");
   if($rows= $compare_req->num_rows > 0){
       $_SESSION['exist'] = 'Такой пользователь существует';
   }else{
       $downloaded_picture = move_uploaded_file($path, $full_path);
       $req = $connect->query("INSERT INTO `exam`(`email`, `login`, `password`, `photo`) VALUES ('$email','$login','$password','$full_path')");
   }




//header('Location:'.$_SERVER['PHP_SELF']);
}
$checklogin = false;
echo $checklogin;

if(isset($_POST['auth'])){
    echo 'lalala';

    $auth_email = $_POST['auth_email'];
    $auth_password = $_POST['auth_password'];
    $enter_profile = $connect->query("SELECT * FROM `exam` WHERE `email`='$auth_email' AND `password` = '$auth_password'");
    if($enter_profile->num_rows > 0){
        $checklogin = true;
        $ress = $connect->query("SELECT * FROM `exam`");
        foreach ($ress as $value){
            $_SESSION['login'] = $value['login'];
            $_SESSION['email'] = $value['email'];
        }

    }
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
    <div class="inner_wrapper">
        <div class="first_row">
            <input id="id" type="text" hidden>
            <input class="email" type="text" name="email" placeholder="email" required>
            <input class="login" type="text" name="login" placeholder="login" required>
        </div>
        <div class="second_row">
            <input class="password" type="text" name="password" placeholder="password" required>
            <label for="avatar">
        <span>
            <input id="avatar" class="photo" name="photo" type="file">
             Фото профиля
        </span>
            </label>
        </div>
    </div>
    <button class="btn" name="SUB" type="submit">Зарегистрировать</button>
    <?php if(isset($_SESSION['exist'])): ?>
    <div class="exist"><?=$_SESSION['exist']?></div>
    <?php endif?>
</form>

<form action="logout.php" method="post">
    <input name="out" type="submit" value="logout">
</form>


<form method="post">
    <input type="text" name="auth_email" placeholder="email">
    <input type="text" name="auth_password" placeholder="password">
    <button name="auth" type="submit"> Log in</button>
</form>
<?php if($checklogin): ?>
<div class="profile">
    <h1><?=$_SESSION['login']?></h1>
    <h3><?= $_SESSION['email']?></h3>
</div>
<?php endif ?>
</body>
</html>