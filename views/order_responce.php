<?php
$zakaz_id = $_COOKIE['zakaz'];
include 'header.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">
          Новая заявка
        </div>
        <div class="panel-body">
			    <form class="form-horizontal" role="form">
  				  <div class="form-group">
    				  <label for="inputEmail3" class="col-sm-2 control-label">Описание предложения</label>
    				  <div class="col-sm-10">
                <textarea class="form-control" rows="10" id=""></textarea>
    					</div>
  				  </div>
  				  <div class="form-group">
    				  <label for="inputPassword3" class="col-sm-2 control-label">Цена</label>
    				  <div class="col-sm-10">
                <div class="input-group">
                  <input type="text" class="form-control" id="inputPassword3" placeholder="Цена">  
                  <span class="input-group-addon">.00 рублей</span>
                </div>
    					</div>
  				  </div>
            <div class="form-group">
              <label for="dostavka" class="col-sm-2 control-label">Доставка</label>
              <div class="col-sm-10">
                <select class="form-control" id="dostavka">
                  <option>силами продавца</option>
                  <option>транспортной компанией</option>
                  <option>самовывоз</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Срок поставки</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <input type="text" class="form-control" id="inputPassword3" placeholder="укажите кол-во календарных дней">  
                  <span class="input-group-addon">дней</span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Сертификат</label>
              <div class="col-sm-10">
                <form enctype="multipart/form-data" method="post">
                  <div class="row">
                    <div class="col-lg-8">
                      <input type="file" class="form-control" id="inputPassword3" name="f">
                    </div>
                    <div class="col-lg-4">
                      <input type="submit" class="btn btn-success" value="Отправить">
                    </div>
                  </div>
                </form>
                  
                
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Коммерческое предложение</label>
              <div class="col-sm-10">
                <form enctype="multipart/form-data" method="post">
                  <div class="row">
                    <div class="col-lg-8">
                      <input type="file" class="form-control" id="inputPassword3" name="f">
                    </div>
                    <div class="col-lg-4">
                      <input type="submit" class="btn btn-success" value="Отправить">
                    </div>
                  </div>
                </form>
                
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Фото</label>
              <div class="col-sm-10">
                <form enctype="multipart/form-data" method="post">
                  <div class="row">
                    <div class="col-lg-8">
                      <input type="file" class="form-control" id="inputPassword3" name="f">
                    </div>
                    <div class="col-lg-4">
                      <input type="submit" class="btn btn-success" value="Отправить">
                    </div>
                  </div>
                </form>
                  
                
              </div>
            </div>
  					<div class="form-group">
    		    	<div class="col-sm-offset-2 col-sm-10">
    				    <button type="submit" class="btn btn-default">Войти</button>
    			    </div>
  			    </div>
			    </form>
        </div>
      </div>					
		</div>
	</div>
</div>
<?php
include 'footer.php';