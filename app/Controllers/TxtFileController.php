<?php

/* funkcja pobierajaca dane z pliku txt */
function getDataFromTxtFile(): array{
    $filename = "../../resources/dataFiles/katalog.txt";
    $file = fopen($filename, "r");
    $newData = array();
    $lineCount = 0;

    if ($file) {
        while (!feof($file)) {
            $file2 = fread($file, 4096);

            $data=explode("\n", $file2);
            $lineCount = count($data);

            foreach ($data as $row){
                $newData[]=explode(";", $row);

            }
        }
        fclose($file);
    } else {
        die("Blad otwierania pliku: $filename");
    }
    return array($newData, $lineCount);
}

/* funkcja konwertujaca tablice na string */
function convertData($data, $lineCount): string{
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
