<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined("CATALOG") or die("ACCESS DENIED!");

//Bestätigung Benutzer-Registrierung
function register($r){
    global $connection;
    $query = "SELECT `id`, `secret_link_time`, `email` FROM `users` WHERE `secret_link`='$r'";
    $res = mysqli_query($connection, $query);
    if(mysqli_num_rows($res)>0){
        $time = time();
        $row = mysqli_fetch_assoc($res);
        $link_time = $row['secret_link_time'];
        $id = $row['id'];
        
        $link_time = strtotime($link_time);
        $max_time = $link_time + 3600;
        if($time > $max_time){
            $a = 'Ссылка просрочена пройдите регистрацию вновь';
            $query = "DELETE FROM `users` WHERE `id`='$id'";
            $res = mysqli_query($connection, $query);
            return $a;
        }else{
            $query = "UPDATE `users` SET `register`= '2' WHERE `id`='$id'";
            $res = mysqli_query($connection, $query);
            if(mysqli_affected_rows($connection)>0){
                $a = $row['email'];
                $_SESSION['reg']['user'] = $a;
            }
        }
    }else{
        $a = 'Ссылка неверна';
        return $a;
    }
}

/*
* Редирект
*/
function redirect($http = false){
    if($http) $redirect = $http;
    else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: ".$redirect);
    exit;
}

/*
 * Извлечение информации о пользователе
 */
function user($id){
    global $connection;
    $query = "SELECT `email` FROM `users` WHERE `id` = '$id' LIMIT 1";
    $res = mysqli_query($connection, $query);
    $user = array();
    if(mysqli_num_rows($res)>0){
        $row = mysqli_fetch_assoc($res);
        foreach ($row as $key => $value) {
            $user[$key] = $value;
        }
    }
    return $user;
}

/*
 * Извлечение регионов
 */
function regions(){
    global $connection;
    $regions = array();
    $query = "SELECT COUNT(*) FROM `regions`";
    $result = mysqli_query($connection, $query);
    $row1 = mysqli_fetch_assoc($result);
    $count = $row1['COUNT(*)'];
    for($i=1; $i<=$count;$i++){
    $query = "SELECT `name`, `kod` FROM `regions` WHERE `id`='$i'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        //var_dump($row);
       // echo '<hr>';
        $regions[] = $row;
    }
    }

    return $regions;
}

/*
*Извлечение нулевых категорий
*/
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

function count_z($author, $cel, $pos){
    global $connection;
    if($cel == 'zakaz' && $pos == 'active'){
        $time = time();
        $count_active_zakaz = 0;
        $query = "SELECT `id` FROM `zakaz` WHERE `author`='$author' AND `date_off`>'$time'";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
            $count_active_zakaz = $count_active_zakaz + 1;
        }
        return $count_active_zakaz;
        
    }
    if($cel == 'zakaz' && $pos == 'out'){
        $time = time();
        $count_out_zakaz = 0;
        $query = "SELECT `id` FROM `zakaz` WHERE `author`='$author' AND `date_off`<='$time'";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
            $count_out_zakaz = $count_out_zakaz + 1;
        }
        return $count_out_zakaz;
        
    }

    if($cel == 'zaj' && $pos == 'active'){
        $time = time();
        $count_active_zaj = 0;
        $query = "SELECT `id` FROM `zaj` WHERE `author`='$author'";
        $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result)){
                $count_active_zaj = $count_active_zaj + 1;
            }
        
        return $count_active_zaj;
        
    }
    if($cel == 'zaj' && $pos == 'out'){
        $time = time();
        $count_out_zaj = 0;
        $query = "SELECT `id` FROM `zaj` WHERE `author`='$author'";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
            $count_out_zaj = $count_out_zaj + 1;
        }
    
        return $count_out_zaj;
    
        
    }
}

function all_zakaz($site, $user){
    $array = array();
    global $connection;
    $query = "SELECT `id`, `name`, `opisanie`, `town`, `category`, `author`, `date_off` FROM `zakaz` ORDER BY `date_off` DESC";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $author = $row['author'];
            if($author!=$user){
                $array[] = $row;
            }
        }
    }
    
    return $array;
}