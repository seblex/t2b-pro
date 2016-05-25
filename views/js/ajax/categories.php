<?php

$parent = $_POST['parent'];

define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');


function categories($parent){
    global $connection;
    $categories = array();
    $query = "SELECT `id`, `name` FROM `category` WHERE `parent`='$parent'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
        $categories[] = $row;
    }
    }
    return $categories;
}
$categories = categories($parent);
//var_dump($categories);
if(isset($categories[0])){
echo '<select class="form-control" onclick="selectCategory()" id="category">
                                <option disabled>Выберите категорию</option>';
foreach ($categories as $key => $value) {
    echo '<option value="'.$value['id'].'" >';
    echo $value['name'];
    echo '</option>';
}
echo '</select>';
}
?>