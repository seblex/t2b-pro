<?php
define("DBHOST", "u419557.mysql.masterhost.ru");
define("DBUSER", "u419557");
define("DBPASS", "mereDes_4_2");
define("DB", "u419557_t2b");
define("PATH", "http://t2b-pro.ru/");
$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die('нет соединения с БД');
mysqli_set_charset($connection, "utf8") or die ('Не установлена кодировка соединения');

function getXLS($xls){
    include_once 'Classes/PHPExcel/IOFactory.php';
    $objPHPExcel = PHPExcel_IOFactory::load($xls);
    $objPHPExcel->setActiveSheetIndex(0);
    $aSheet = $objPHPExcel->getActiveSheet();
 
    //этот массив будет содержать массивы содержащие в себе значения ячеек каждой строки
    $array = array();
    //получим итератор строки и пройдемся по нему циклом
    foreach($aSheet->getRowIterator() as $row){
      //получим итератор ячеек текущей строки
      $cellIterator = $row->getCellIterator();
      //пройдемся циклом по ячейкам строки
      //этот массив будет содержать значения каждой отдельной строки
      $item = array();
      foreach($cellIterator as $cell){
        //заносим значения ячеек одной строки в отдельный массив
        array_push($item, $cell->getCalculatedValue());
      }
      //заносим массив со значениями ячеек отдельной строки в "общий массв строк"
      array_push($array, $item);
    }
    return $array;
  }
 
  $xlsData = getXLS('towns.xls'); //извлеаем данные из XLS
  
  //var_dump($xlsData);
  
foreach ($xlsData as $key => $value) {
    //var_dump($value);
    $town = $value[0];
    $region_name = $value[3];
    $region_num = $value[2];
    if($town != 'Город'){
        $query = "SELECT `id` FROM `regions` WHERE `kod`='$region_num' LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result)==0){
            $query = "INSERT INTO `regions` (`name`, `kod`) VALUES ('$region_name', '$region_num')";
            $result = mysqli_query($connection, $query);
            if(mysqli_affected_rows($connection)>0){
                echo '<font color="green">Добавлено</font>';
            }
            else{
                echo '<font color="red">Не добавлено</font>';
            }
        }
        
        
        
    }
    echo $value[0].'<br>';
    echo $value[3].' => '.$value['2'].'<br>';
    echo '<hr>';
}


