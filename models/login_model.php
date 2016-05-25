<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined("CATALOG") or die("ACCESS DENIED!");

/*
 * Авторизация
 */
function authorization(){
    global $connection;
    $login = trim(mysqli_real_escape_string($connection, $_POST['login']));
    $password = trim($_POST['password']);
    if(empty($login) OR empty($password)){
        $_SESSION['auth']['error'] = 'Поля логин и пароль обязательны к заполнению';
    }
    else{
        $password = md5($password);
        $query = "SELECT `id` FROM `users` WHERE `login`='$login' AND `password`='$password' LIMIT 1";
        $res = mysqli_query($connection, $query);
        if(mysqli_num_rows($res) == 1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['auth']['user'] = $row['id'];
            
        }
        else{
            $_SESSION['auth']['error'] = 'Логин и пароль введены не верно';
        }
    }
}
