<?php

$region = $_POST['region'];
define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

$query = "SELECT `id`, `name` FROM `towns` WHERE `region`='$region'";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result)>0){
    echo '<select class="form-control" id="town"><option disabled>Выберите город</option>';
    while($row = mysqli_fetch_assoc($result)){
        echo '<option value="'.$row['id'].'">';
        echo $row['name'];
        echo '</option>';
    }
    echo '</select><br>';
}
