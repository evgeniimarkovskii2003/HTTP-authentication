<?php

    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);
        $salt = $user['SALT']; // соль из БД
    		$password = md5($salt . $_POST['password']); // соленый пароль от юзера
        $check_user2 = mysqli_query($connect, "SELECT * FROM `users` WHERE `password` = '$password'");
        if (mysqli_num_rows($check_user2) > 0){
            $_SESSION['user'] = [
                "id" => $user['id'],
                "full_name" => $user['full_name'],
                  "avatar" => $user['avatar'],
                    "email" => $user['email']
          ];
        }
        else{
          $_SESSION['message'] = 'Неверный пароль';
          header('Location: ../index.php');
        }
        header('Location: ../profile.php');

    } else {
        $_SESSION['message'] = 'Неверный логин';
        header('Location: ../index.php');
    }
    ?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
