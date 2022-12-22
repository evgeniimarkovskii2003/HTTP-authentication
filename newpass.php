<?php
session_start();

if ($_SESSION['user']) {
    header('Location: changepass.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Смена пароля</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <form action="vendor/changepass.php" method="post">
      <label>Логин</label>
      <input type="text" name="login" placeholder="Введите логин">
      <label>Старый пароль</label>
      <input type="password" name="oldpassword" placeholder="Введите свой старый пароль">
      <label>Введите новый пароль</label>
      <input type="password" name="newpassword" placeholder="Введите новый пароль (от 6 до 12 символов)">
      <label>Подтвердите пароль</label>
      <input type="password" name="password_confirm" placeholder="Введите новый пароль">
      <button type="submit">Изменить пароль</button>
      <p>
          Передумали менять пароль? - <a href="/index.php">Авторизуйтесь</a>!
      </p>
      <?php
          if ($_SESSION['message']) {
              echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
          }
          unset($_SESSION['message']);
      ?>
  </form>
</body>
</html>
