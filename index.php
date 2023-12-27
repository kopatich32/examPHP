<!doctype html>
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
<form action="fromForm.php" method="POST" enctype="multipart/form-data">
    <div class="inner_wrapper">
        <div class="first_row">
            <input id="id" type="text" hidden>
            <input class="email" type="text" name="email" placeholder="email">
            <input class="login" type="text" name="login" placeholder="login">
        </div>
        <div class="second_row">
            <input class="password" type="text" name="password" placeholder="password">
            <label for="avatar">
        <span>
            <input id="avatar" class="photo" type="file">
             Фото профиля
        </span>
            </label>
        </div>
    </div>
</form>

<?php $data_from_js = json_decode(file_get_contents('php://input'), true) ?>
</body>
</html>