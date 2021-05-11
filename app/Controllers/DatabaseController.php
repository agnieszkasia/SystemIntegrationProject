<?php

/* funkcja pobierajaca dane z pliku txt */
function getDataFromDatabase(): array{
    $con = connectToDatabase();
    $data = array();
    $rows = array();

    $sql = "SELECT * FROM `laptops`";


    $result = $con->query($sql);

    for ($x = 1; $x <= $con->affected_rows; $x++) {
        $rows[] = $result->fetch_assoc();
    }
    $lineCount = count($rows);
    for($i = 0; $i<$lineCount; $i++){
        $data[$i][0] = $rows[$i]['manufacturer'];
        $data[$i][1] = $rows[$i]['screen_size'];
        $data[$i][2] = $rows[$i]['screen_resolution'];
        $data[$i][3] = $rows[$i]['screen_type'];
        $data[$i][4] = $rows[$i]['screen_touch'];
        $data[$i][5] = $rows[$i]['processor_name'];
        $data[$i][6] = $rows[$i]['processor_physical_cores'];
        $data[$i][7] = $rows[$i]['processor_clock_speed'];
        $data[$i][8] = $rows[$i]['ram'];
        $data[$i][9] = $rows[$i]['disc_storage'];
        $data[$i][10] = $rows[$i]['disc_type'];
        $data[$i][11] = $rows[$i]['graphic_card_name'];
        $data[$i][12] = $rows[$i]['graphic_card_memory'];
        $data[$i][13] = $rows[$i]['os'];
        $data[$i][14] = $rows[$i]['disc_reader'];

    }

    return array($data, $lineCount);
}

/* funkcja zapisujaca dane do bazy danych*/
function saveDataToDatabase($data, $lineCount){
    $con = connectToDatabase();

    /* konwersja z wertości 'Brak danych' na puste pole */
    for ($i = 0; $i<$lineCount;$i++){
        for ($j =0; $j<count($data[$i]); $j++){
            if ($data[$i][$j] == 'Brak danych'){
                $data[$i][$j] = '';
            }
        }
    }

    $sql = "TRUNCATE TABLE `laptops`";
    mysqli_query($con, $sql);
    for ($i = 0; $i<$lineCount; $i++){
        $sql = "INSERT INTO `laptops` ( `id`,
                    `manufacturer`, `screen_size`, `screen_resolution`, `screen_type`,
                    `screen_touch`, `processor_name`, `processor_physical_cores`, `processor_clock_speed`,
                    `ram`, `disc_storage`, `disc_type`, `graphic_card_name`,
                    `graphic_card_memory`, `os`, `disc_reader`)
                VALUES ( '".($i+1)."',
                    '".$data[$i][0]."', '".$data[$i][1]."', '".$data[$i][2]."', '".$data[$i][3]."',
                    '".$data[$i][4]."', '".$data[$i][5]."', '".$data[$i][6]."', '".$data[$i][7]."',
                    '".$data[$i][8]."', '".$data[$i][9]."', '".$data[$i][10]."', '".$data[$i][11]."',
                    '".$data[$i][12]."', '".$data[$i][13]."', '".$data[$i][14]."');";
        mysqli_query($con, $sql);
    }
}

function connectToDatabase(): mysqli {
    $con = mysqli_connect('localhost','root','', 'systemintegrationproject');
    if (!$con) {
        echo "Error: " . mysqli_connect_error();
        exit();
    }
    return $con;
}

function initialize(){
    $con = mysqli_connect('localhost','root','');

    $databaseSql = "CREATE DATABASE `systemintegrationproject`;";
    mysqli_query($con, $databaseSql);

    $init = "CREATE TABLE `systemintegrationproject`.`laptops` (
    `manufacturer` VARCHAR(255) NOT NULL ,
    `screen_size` VARCHAR(255) NOT NULL ,
    `screen_resolution` VARCHAR(255) NULL ,
    `screen_type` VARCHAR(255) NULL ,
    `screen_touch` VARCHAR(255) NULL ,
    `processor_name` VARCHAR(255) NULL ,
    `processor_physical_cores` VARCHAR(255) NULL ,
    `processor_clock_speed` VARCHAR(255) NULL ,
    `ram` VARCHAR(255) NULL ,
    `disc_type` VARCHAR(255) NULL ,
    `disc_storage` VARCHAR(255) NULL ,
    `graphic_card_name` VARCHAR(255) NULL ,
    `graphic_card_memory` VARCHAR(255) NULL ,
    `os` VARCHAR(255) NULL ,
    `disc_reader` VARCHAR(255) NULL ,
    `id` INT NOT NULL AUTO_INCREMENT ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    mysqli_query($con, $init);
}


function getQuantityOfLaptopsByManufacturer($manufacturer){
    $con = connectToDatabase();

    $sql = "SELECT * FROM `laptops` where manufacturer like '%$manufacturer%'";
    $result = mysqli_query($con, $sql);

        return mysqli_num_rows($result);

}

function getLaptopByManufacturers(){
    $con = connectToDatabase();

    $sql = "SELECT DISTINCT manufacturer FROM `laptops`";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) >0 ){
        $manufacturer = array();


        foreach ($result as $row){
            $manufacturer[] = $row['manufacturer'];
        }
        $str = implode(';',$manufacturer);
        return $str;
    }

}


function getLaptopsByScreenType($screenType){

    $con = connectToDatabase();

    $sql = "SELECT * FROM `laptops` where screen_type like '%$screenType%'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)>0) {
        foreach ($result as $row) {
//            foreach ($row as $cos){
//
//                $str[] = implode(';',$cos);
//            }
            $str[] = implode(';',$row);
        }
        $str2 = implode('|',$str);


    }

    return $str2;

}
//    $con = connectToDatabase();
//
//    $sql = "SELECT * FROM `laptops` where screen_type like '%$screenType%'";
//    $result = mysqli_query($con, $sql);
//
//    $response = "";
//
//    if (mysqli_num_rows($result)>0){
//        foreach ($result as $row){
//            foreach ($row as $cos){
//
//                $str = implode(';',$row);
//            }
//            $str2 = implode(';',$str);
//        }
//        return "123";
//    }
//
//}

function getLaptopsScreenType(){
    $con = connectToDatabase();

    $sql = "SELECT DISTINCT screen_type FROM `laptops`";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) >0 ){
        $screenType = array();


        foreach ($result as $row){
            $screenType[] = $row['screen_type'];
        }
        $str = implode(';',$screenType);
        return $str;
    }

}



function getLaptopsByScreenProportion($screenProportion){
    $con = connectToDatabase();

    $sql = "SELECT screen_resolution FROM `laptops`";
    $result = mysqli_query($con, $sql);
    $quantity = 0;

    if (mysqli_num_rows($result) >0 ) {
        $proportion = array();


        foreach ($result as $row) {
            $resolution = $row['screen_resolution'];
            $resolution_XY = explode('x',$resolution);

            $a=$resolution_XY[0];
            $b=$resolution_XY[1];
            while($a!=$b){
                if($a>$b) $a=$a-$b;
                else $b=$b-$a;
            }
            $NWD = $a;

            $proportion_X = $resolution_XY[0]/$NWD;
            $proportion_Y = $resolution_XY[1]/$NWD;


            $proportion = $proportion_X.":".$proportion_Y;


            if ($proportion==$screenProportion){
                $quantity++;
            }
        }
    }
    return $quantity;

}

function getLaptopsScreenProportion(){
    $con = connectToDatabase();

    $sql = "SELECT DISTINCT screen_resolution FROM `laptops`";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) >0 ){
        $screenProportion = array();


        foreach ($result as $row){
            $resolution = $row['screen_resolution'];
            $resolution_XY = explode('x',$resolution);

            $a=$resolution_XY[0];
            $b=$resolution_XY[1];
            while($a!=$b){
                if($a>$b) $a=$a-$b;
                else $b=$b-$a;
            }
            $NWD = $a;

            $proportion_X = $resolution_XY[0]/$NWD;
            $proportion_Y = $resolution_XY[1]/$NWD;


            $screenProportion[] = $proportion_X.":".$proportion_Y;
        }

        $screenProportion = array_unique($screenProportion);


        $str = implode(';',$screenProportion);
        return $str;
    }

}
