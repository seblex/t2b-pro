<?php
/* 
 * Шапка всех страниц
 */

defined("CATALOG") or die("ACCESS DENIED!");
if(isset($_GET['r'])){
    $register = register($_GET['r']);
    echo $a;
}
//информация о пользователе
$user = user($_COOKIE['user']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="<?=PATH. VIEW?>css/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=PATH. VIEW?>css/css/font-awesome-4.6.2/css/font-awesome.min.css">
    <meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>
<div class="header">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">T2B-pro</a>
            </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php if(empty($_SESSION['reg']['user']) && empty($user['email'])){        
            include 'login_form.php';
        }else{
            if(isset($user['email'])){
                echo '<div class="navbar navbar-right"><br>'.$user['email'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
            }
            if(isset($_SESSION['reg']['user'])){
                echo '<div class="navbar-right">'.$_SESSION['reg']['user'].'</div>';
            }
        }
      
        
        ?>
        
    </div><!-- /.container-fluid -->
</nav>
</div>


    