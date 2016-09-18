<?php

/* 
 * Точка входа
 */
define('CATALOG', TRUE);
session_start();
include 'config.php';

//Получаем url и обрезаем лишнее
//$url = str_replace('/catalog/', '', $_SERVER['REQUEST_URI']);
$url = ltrim($_SERVER['REQUEST_URI'], '/');

include 'routes.php';

foreach ($routes as $route){
    if(preg_match($route['url'], $url, $match)){
        $view = $route['view'];
        break;
    }
}

if(empty($match)){
    include VIEW.'404.php';
    exit;
}
//Получаем переменные из массива
extract($match);
//Результат $id - ID категории
//$product_alias - alias продукта
//$view - шаблон вида для подключения
include "controllers/{$view}_controller.php";
//проверка
?>
