<?php

require '../db.php';

$data = $_POST;
$showError = False;

if (isset($data['signin'])) {
    $errors = array();
    $showError = True;
    if (trim($data['login']) == "") {
        $errors[] = "Укажите логин.";
    } if (trim($data['password']) == "") {
        $errors[] = "Укажите пароль.";
    }

    $user = R::findOne('login', 'login = ?', array($data['login']));
    if ($user) {
        if ($data['password'] == $user->password) {

            setcookie("login", $data['password'], time()+3600);
            header("Location: /admin");
        } else {
            $errors[] = "Неверный пароль.";
        }
    } else {
        $errors[] = "Неверный логин.";
    }
}

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

  <!-- Менять тут -->
	<title>Вход в админ панель</title>

	<link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 <link rel="shortcut icon" href="img/allay.png" type="image/png">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script src="https://mcapi.us/scripts/minecraft.min.js"></script>

</head>
<body class="bg">
    
    <div class="container">
        <div class="poster">
            <h3 class="logo">ВХОД В АДМИН ПАНЕЛЬ</h3>
        </div>
                <div class="form"><form action="login.php" method="POST">
                    <?php
                    if ($showError) {
                        echo '<div class="pass" role="alert">
                      '.showError($errors).'
                    </div>';
                    }

                    ?>
                    <label for="login">Введите логин</label><br>
                    <input type="text" name="login" required placeholder="Логин"><br>
                    <label for="login">Введите пароль</label><br>
                    <input type="password" name="password" required placeholder="********"><br>
                    <button type="submit" name="signin" class="btn-color">Войти</button>
                </form></div>
    </div>

</body>
</html>