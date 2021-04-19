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
