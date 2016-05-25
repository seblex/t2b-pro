<?php


$pass = $_POST['pass'];
$email = $_POST['email'];

$email = htmlspecialchars($email);
$email = trim($email);

define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");
define("PATH", "http://t2b-pro.ru/mvc/");
define("VIEW", "views/");
$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

$query = "SELECT `id`, `email` FROM `users` WHERE `pass`='$pass' AND `email`='$email' LIMIT 1";
$result = mysqli_query($connection, $query) or die('не удалось найти пользователя');
$row = mysqli_fetch_assoc($result);
if(isset($row['id'])){
    $id = $row['id'];
    echo $id;
    
}else{
     echo 'Такой пользователь не найден';
}
