<?php
$user = $_COOKIE['user'];
global $connection;
$query = "SELECT `id`, `name`, `opisanie`, `town`, `category`, `author`, `date_off` FROM `zakaz`";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
echo $id;
echo "string";
?>