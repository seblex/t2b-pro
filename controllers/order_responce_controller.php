<?php
defined("CATALOG") or die("ACCESS DENIED!");

include 'models/main_model.php';
include "models/{$view}_model.php";

include VIEW."{$view}.php";