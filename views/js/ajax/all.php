<?php
$user = $_POST['user'];
if(empty($user)){
	$user = $_GET['user'];
}


define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

$time = time();
$all = array();
$query = "SELECT `id`, `date_off` FROM `zakaz` WHERE `author`='$user'";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result)){
	$id = $row['id'];
	if($row['date_off']>$time){
		$query_all = "SELECT * FROM `zakaz` WHERE `id`='$id' AND `author`='$user'";
		$result_all = mysqli_query($connection, $query_all);
		$row = mysqli_fetch_assoc($result_all);
		$all[] = $row;
	}
}

foreach($all as $key => $value){
	echo '<div class="well well-sm">';
	echo '<h2>'.$value['name'].'</h2><br>';
	echo $value['opisanie'].'<br>';
	$town = $value['town'];
	$query = "SELECT `name`, `region` FROM `towns` WHERE `id`='$town'";
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result)>0){
		$row_town = mysqli_fetch_assoc($result);
		$town = $row_town['name'];
		$region = $row_town['region'];
	}
	$query = "SELECT `name` FROM `regions` WHERE `kod`='$region'";
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result)>0){
		$row_region = mysqli_fetch_assoc($result);
		$region = $row_region['name'];
	}
	if(!empty($town)){
	echo 'Город: '.$town.', '.$region.'<br>';
	}else{
	echo $region.'<br>';	
	}	
	$author = $value['author'];
	$query = "SELECT `email` FROM `users` WHERE `id` = '$author'";
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result)>0){
		$row_user = mysqli_fetch_assoc($result);
		$author = $row_user['email'];
	}
	echo 'Автор: '.$author.'<br>';
	$time_off = date ('j F Y h:i:s A', $value['date_off']);
	echo 'Окончание подачи заявок: '.$time_off.'<br>';


	echo '</div>';
}



?>