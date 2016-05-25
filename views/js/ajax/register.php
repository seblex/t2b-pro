<?php
define("DBHOST", "");
define("DBUSER", "");
define("DBPASS", "");
define("DB", "");
define("PATH", "http://t2b-pro.ru/mvc/");
define("VIEW", "views/");
$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

$email = $_POST['email'];
$pass = $_POST['pass'];
$secondpass = $_POST['secondpass'];


//Überprüfen Sie die Befüllung von Feldern
if(empty($email) && isset($pass) && isset($secondpass)){ 
    echo 'Не заполнено поле email';
    exit;
}
if(isset($email) && empty($pass) && isset($secondpass)){
    echo 'Не заполнено поле пароль';
    exit;
}
if(isset($email) && isset($pass) && empty($secondpass)){
    echo 'Повторите пароль';
    exit;
}
if(empty($email) && empty($pass) && isset($secondpass)){
    echo 'Не заполнены поля: email и пароль';
    exit;
}
if(empty($email) && isset($pass) && empty($secondpass)){
    echo 'Заполните поле email и повторите пароль';
    exit;
}
if(isset($email) && empty($pass) && empty($secondpass)){
    echo 'Напишите пароль и повторите его';
    exit;
}
if(empty($email) && empty($pass) && empty($secondpass)){
    echo 'Не заполнены поля';
    exit;
}

//Bestätigung
$email = (string)$email;
if(stristr($email, '@') === FALSE) {
    echo 'Введите корректный email';
    exit;
}
$email = htmlspecialchars($email);
$result = strpos ($email, '&lt;');
if ($result != FALSE){ 
    echo 'Некорректный ввод';
    exit; 
}
$email = trim(mysqli_real_escape_string($connection, $email));

//überprüfen Gleichheit Passwörter
if($pass != $secondpass){
    echo 'Пароли не равны! Введите ещё раз и будьте внимательнее.';
    exit;
}

//überprüfen Sie die Länge der Passwörter
$pass_count = iconv_strlen($pass);
if($pass_count < 8){
    echo 'Пароль должен содержать не менее 8 символов. Вы берите пожалуйста другой пароль';
    exit;
}
elseif ($pass_count > 50) {
    echo 'Да вы параноик батенька! Пароль должен быть не менее 8 и не более 50 символов';
    exit;
}

//Überprüfen Sie für einen Benutzer mit dieser E-Mail -Datenbank
global $connection;
$query = "SELECT `id` FROM `users` WHERE `email`='$email' LIMIT 1";
$res = mysqli_query($connection, $query) or die ('Не удалось проверить наличие дублей');
$row = mysqli_fetch_assoc($res);
if(isset($row['id'])){
    echo 'Пользователь с таким email уже зарегистрирован в системе';
    exit;
}

//verschlüsseln Passwörter
$pass = md5(md5(md5($pass)));

//Generieren Sie einen geheimen Link
$time = time();
$link = $pass.$time;
$secret_link = md5($link);

//Das Hinzufügen eines neuen Benutzerdatenbank
$query = "INSERT INTO `users` (`email`, `pass`, `register`, `secret_link`) VALUES ('$email','$pass','1','$secret_link')";
$res = mysqli_query($connection, $query) or die ('Ошибка добавления пользователя');
if(mysqli_affected_rows($connection)>0){
    echo 'Вам на почту отпралено письмо, содержащее ссылку для подтверждения регистрации!';
}

//Senden Sie diese Mail an den Benutzer
$subject = 'Регистрация на t2b-pro.ru';
$message = 'Для завершения регистрации перейдите по ссылке: '.PATH.'?r='.$secret_link;

mail($email, $subject, $message);