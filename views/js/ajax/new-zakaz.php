<?php

define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

$name = $_POST['name'];
$opisanie = $_POST['opisanie'];
$town = $_POST['town'];
$time = $_POST['time'];
$category = $_POST['category'];
$user = $_POST['user'];
$timestamp = time();
$a = 86400*$time;
$date_off = $timestamp+$a;

$query = "INSERT INTO `zakaz` (`name`, `opisanie`, `town`, `time`, `category`, `author`, `date_off`) VALUES ('$name', '$opisanie', '$town', '$time', '$category', '$user', '$date_off')";
$result = mysqli_query($connection, $query);
if(mysqli_affected_rows($connection)>0){
	echo '<p class="bg-success">Заказ добавлен</p><button class="btn btn-success" onClick="allContent('.$_COOKIE['user'].')" data-dismiss="modal">Просмотреть</button><br>';
}else{
	echo '<p class="bg-danger">чё то не получилось</p>';
}

?>