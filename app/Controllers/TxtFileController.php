<?php

/* funkcja pobierajaca dane z pliku txt */
function getDataFromTxtFile(){
    $filename = "../../resources/dataFiles/katalog.txt";
    $file = fopen($filename, "r");
    $data = array();
    $lineCount = 0;

    if ($file) {
        while (!feof($file)) {
            $lineCount++;
            $buffer = fgets($file, 4096);
            $data[]=explode(";", $buffer);
        }
        fclose($file);
    } else {
        die("Blad otwierania pliku: $filename");
    }
//    print_r($data);
    return array($data, $lineCount);
}



/* funkcja konwertujaca tablice na string */
function convertData($data, $lineCount){
    $i = 0;
    $new_data = array();
    while ($i<$lineCount){
        for ($j =0; $j<count($data[$i]); $j++){
            if ($data[$i][$j] == 'Brak danych'){
                $data[$i][$j] = '';
            }
        }
        $new_data[$i] = implode(';',$data[$i]);
        $i++;
    }

    return implode("\n", $new_data);
}

/* funkcja zapisujaca dane do pliku txt */
function saveDataToTxtFile($data){
    $filename = "../../resources/dataFiles/katalog.txt";
    $file = fopen($filename, "w");

    flock($file, 2);
    fwrite($file, $data);
    flock($file, 3);
    fclose($file);
}
