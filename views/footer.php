<?php

/* 
 * Подвал всех страниц
 */

defined("CATALOG") or die("ACCESS DENIED!");
?>
<div class="footer">
    <script src="<?=PATH.VIEW?>js/jquery-2.2.3.min.js"></script>
    <script src="<?=PATH.VIEW?>js/bootstrap.min.js"></script>
    <script src="<?=PATH.VIEW?>js/scripts.js"></script>
    <!--Модальные окна-->
    <!--Окно регистрации-->
    <div class="modal" id="modal-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Регистрация</h4>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 centered">
                        <center>
                            <div class="askFromServer" id="askFromServer"></div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Введите E-mail" id="email"><br>
                            <input type="password" class="form-control" placeholder="Введите пароль" id="pass"><br>
                            <input type="password" class="form-control" placeholder="Повторите пароль" id="secondPass">
                        </div>
                        
                            <button class="btn btn-success" onclick="register()">Регистрировать</button>
                            
                        </center>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    <!--Окно новой заявки-->
    <div class="modal" id="modal-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Новый заказ</h4>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 centered">
                        <center>
                            <div id="zakaz"></div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Заголовок" id="name-zakaz"><br>
                            <textarea class="form-control" rows="10" placeholder="Описание" id="opisanie"></textarea><br>
                            <select class="form-control" onclick="selectRegion()" id="region">
                                <option disabled>Выберите Регион</option>
                                <?php
                                foreach ($regions as $key => $value) {
                                        echo '<option value="'.$value['kod'].'" >';
                                        echo $value['name'];
                                        echo '</option>';
                                }
                                ?>
                            </select>
                            <br>
                            <div id="selectTowns"></div>
                            <select class="form-control" id="time">
                                <option disabled>Выберите время размещения</option>
                                <option value="1">1 сутки</option>
                                <option value="3">3 суток</option>
                                <option value="7">1 неделя</option>
                            </select>
                            <br>
                            <div id="categories">
                            <select class="form-control" onclick="selectCategory()" id="category">
                                <option disabled>Выберите категорию</option>
                                <?php
                                foreach ($categories as $key => $value) {
                                        echo '<option value="'.$value['id'].'" >';
                                        echo $value['name'];
                                        echo '</option>';
                                }
                                ?>
                            </select>
                            </div>
                            
                        </div>
                        
                            <button class="btn btn-success" onclick="zakaz(<?=$_COOKIE['user']?>)">Создать</button>
                            
                        </center>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
</div>
</body>
</html>
