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
