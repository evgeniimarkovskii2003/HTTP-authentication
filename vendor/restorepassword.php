<?php
    function generateSalt()
	{
		$salt = '';
		$saltLength = 8; // длина соли

		for($i = 0; $i < $saltLength; $i++) {
			$salt .= chr(mt_rand(33, 126)); // символ из ASCII-table
		}

		return $salt;
	}
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $secret_word = $_POST['secret_word'];
    $salt1 = generateSalt();
    $len = strlen($_POST['newpassword']);
    $newpassword = md5($salt1 . $_POST['newpassword']);
    $password_confirm = md5($salt1 . $_POST['password_confirm']);
    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    $user = mysqli_fetch_assoc($check_user);
    if ($len >= 6 && $len <= 12){
      if (mysqli_num_rows($check_user) > 0) {
        $check_user2 = mysqli_query($connect, "SELECT * FROM `users` WHERE `secret_word` = '$secret_word'");
        if (mysqli_num_rows($check_user2) > 0){
          if ($newpassword == $password_confirm){
            $id = $user['id'];
            $query = "UPDATE users SET password='$newpassword' WHERE id ='$id'";
            mysqli_query($connect, $query);
            $query2 = "UPDATE users SET SALT='$salt1' WHERE id ='$id'";
            mysqli_query($connect, $query2);
            header('Location: ../index.php');
            $_SESSION['message'] = 'Пароль успешно изменен';
          }
          else{
              $_SESSION['message'] = 'Введенные пароли не совпадают';
              header('Location: ../reestablishpass.php');
            }
          }
          else {
            $_SESSION['message'] = 'Неверное секретное слово';
            header('Location: ../reestablishpass.php');
          }
        } else {
          $_SESSION['message'] = 'Неверный логин';
          header('Location: ../reestablishpass.php');
        }
    }
    else{
      $_SESSION['message'] = 'Введите пароль от 6 до 12 символов';
      header('Location: ../reestablishpass.php');
    }
    ?>
