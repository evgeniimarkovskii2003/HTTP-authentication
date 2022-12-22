<?php

    session_start();
    require_once 'connect.php';

    function generateSalt()
	{
		$salt = '';
		$saltLength = 8; // длина соли

		for($i = 0; $i < $saltLength; $i++) {
			$salt .= chr(mt_rand(33, 126)); // символ из ASCII-table
		}

		return $salt;
	}

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $secret_word = $_POST['secret_word'];
    $salt = generateSalt(); // соль
    $len = strlen($password);
    if (6 <= $len && $len <= 12 ) {
      if ($password === $password_confirm) {

        $path = 'uploads/' . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке сообщения';
            header('Location: ../register.php');
        }

	      $password = md5($salt . $password);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`,`SALT`, `secret_word`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path', '$salt', '$secret_word')");

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');


    }
   else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }
  }
  else {
    $_SESSION['message'] = 'Введите пароль от 6 до 12 символов';
    header('Location: ../register.php');
  }

?>
