<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'header.php';

?>

<div id="all">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-lg-offset-1">
				<?php
					if(!empty($user['email'])){
						echo '<center><button id="new_zakaz" class="btn btn-success" data-toggle="modal" data-target="#modal-2">Создать заказ</button></center>';    					
					}
				?>
				
			</div>
			<div class="col-lg-2">
				<?php
					if(!empty($user['email'])){
						echo '<center><button id="new_zakaz" class="btn btn-success" data-toggle="modal" data-target="#modal-2">Создать заявку</button></center>';
					}
				?>
				<br><br>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-1 col-xs-10 col-xs-offset-1">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#zakaz" data-toggle="tab">Все Заказы</a></li>
 					<li><a href="#my_zakaz" data-toggle="tab">Мои Заказы  <span class="badge_2"><?=$count_active_zakaz?></span>  <span class="badge"><?=$count_out_zakaz?></span></a></li>
  					<li><a href="#my_z" data-toggle="tab">Мои Заявки  <span class="badge_2"><?=$count_active_zaj?></span>  <span class="badge"><?=$count_out_zaj?></span></a></li>
 					<li><a href="#settings" data-toggle="tab">помощь</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="zakaz"><br>
						<div class="panel panel-primary">
							<div class="panel-heading">
								Заказы
							</div>
							<div class="panel-body">
								<?php 
								foreach ($zakaz as $key => $value) {
									$id = $value['id'];
									$time_a = $value['date_off'];
									$time = time();
									if($time < $time_a){
										$time_off = date ('j F Y h:i:s A', $time_a);
										$str = 'Окончание подачи заявок: '.$time_off.'<br><button id="new_order_responce" class="btn btn-success" type="button" onclick="newOrderResponce('.$id.')">Подать заявку</button>';
									}else{
										$str = 'Приём заявок окончен<br>';
									}


									echo '<div class="well well-sm">';
									echo '<h2>'.$value['name'].'</h2><br>';
									echo $value['opisanie'].'<br>';
									$town = $value['town'];
									$query = "SELECT `name`, `region` FROM `towns` WHERE `id`='$town'";
									$result = mysqli_query($connection, $query);
									if(mysqli_num_rows($result)>0){
										$row_town = mysqli_fetch_assoc($result);
										$town = $row_town['name'];
										$region = $row_town['region'];
									}
									$query = "SELECT `name` FROM `regions` WHERE `kod`='$region'";
									$result = mysqli_query($connection, $query);
									if(mysqli_num_rows($result)>0){
										$row_region = mysqli_fetch_assoc($result);
										$region = $row_region['name'];
									}
									if(!empty($town)){
										echo 'Город: '.$town.', '.$region.'<br>';
									}else{
										echo $region.'<br>';	
									}	
									$author = $value['author'];
									$query = "SELECT `email` FROM `users` WHERE `id` = '$author'";
									$result = mysqli_query($connection, $query);
									if(mysqli_num_rows($result)>0){
										$row_user = mysqli_fetch_assoc($result);
										$author = $row_user['email'];
									}
									echo 'Автор: '.$author.'<br>';
									if(isset($_COOKIE['user'])){
									echo $str;
									}
									else{
										echo '<font color="green">Авторизуйтесь</font>';
									}	
									echo '</div>';
									}
								?>
  							</div>
						</div>	
					</div>
 					<div class="tab-pane active" id="my_zakaz"><br>
						<div class="panel panel-primary">
							<div class="panel-heading">
								Мои заказы
							</div>
							<div class="panel-body">
    							<?php include "http://t2b-pro.ru/views/js/ajax/all.php?user=".$_COOKIE['user']; ?>
  							</div>
						</div>	
					</div>
					<?php if (isset($_COOKIE['user'])) :?>
					<div class="tab-pane active" id="my_z"><br>
						<div class="panel panel-primary">
							<div class="panel-heading">
								Заявки
							</div>
							<div class="panel-body">
    							Panel content
  							</div>
						</div>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
echo $_SESSION['auth']['error'];
include 'footer.php';