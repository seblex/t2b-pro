<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined("CATALOG") or die("ACCESS DENIED!");

include 'main_controller.php';
include "models/{$view}_model.php";


include VIEW."{$view}.php";

