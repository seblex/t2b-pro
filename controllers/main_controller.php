<?php
defined("CATALOG") or die("ACCESS DENIED!");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'models/main_model.php';
global $connection;

$regions = regions();
$categories = categories(0);
$count_active_zakaz = count_z($_COOKIE['user'], 'zakaz', 'active');
$count_out_zakaz = count_z($_COOKIE['user'], 'zakaz', 'out');
$count_active_zaj = count_z($_COOKIE['user'], 'zaj', 'active');
$count_out_zaj = count_z($_COOKIE['user'], 'zaj', 'out');
$zakaz = all_zakaz('1', $_COOKIE['user']);
