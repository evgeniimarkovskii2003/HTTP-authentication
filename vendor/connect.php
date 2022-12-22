<?php

    $connect = mysqli_connect('localhost', 'root', 'root', 'register');

    if (!$connect) {
        die('Error connect to DataBase');
    }
