<?php

//wykonanie poleceń po kliknięciu przycisku importu z pliku txt
if (array_key_exists('importTxtFile', $_POST)){

    require_once ('TxtFileController.php');
    list($data, $lineCount) = getDataFromTxtFile();

    if (array_key_exists('data', $_POST)) {
        $dataInTable = $_POST['data'];
        $data = compareData($data, $dataInTable);
    }
    showData($data, count($data));
}

//wykonanie poleceń po kliknięciu przycisku eksportu do pliku txt
if (array_key_exists('exportTxtFile', $_POST)){

    $data = $_POST['data'];
    $lineCount = count($data);

    require_once ('TxtFileController.php');
    $fullData = convertData($data, $lineCount);

    saveDataToTxtFile($fullData);

    showData($data, $lineCount);
}

//wykonanie poleceń po kliknięciu przycisku importu z pliku xml
if (array_key_exists('importXmlFile', $_POST)){

    require_once ('XmlFileController.php');
    list($data, $lineCount) = getDataFromXmlFile();

    if (array_key_exists('data', $_POST)) {
        $dataInTable = $_POST['data'];
        $data = compareData($data, $dataInTable);
    }
    showData($data, count($data));
}

//wykonanie poleceń po kliknięciu przycisku eksportu do pliku xml
if (array_key_exists('exportXmlFile', $_POST)){

    $data = $_POST['data'];
    $lineCount = count($data);

    require_once ('XmlFileController.php');
    saveDataToXmlFile($data, $lineCount);

    showData($data, $lineCount);
}

//wykonanie poleceń po kliknięciu przycisku importu z bazy danych
if (array_key_exists('importDatabase', $_POST)){

    require_once ('DatabaseController.php');
    list($data, $lineCount) = getDataFromDatabase();

    var_dump($data);
    if (array_key_exists('data', $_POST)) {
        $dataInTable = $_POST['data'];
        $data = compareData($data, $dataInTable);
    }
    showData($data, count($data));
}

//wykonanie poleceń po kliknięciu przycisku eksportu do bazy danych
if (array_key_exists('exportDatabase', $_POST)){

    $data = $_POST['data'];
    $lineCount = count($data);

    require_once ('DatabaseController.php');
    saveDataToDatabase($data, $lineCount);

    showData($data, $lineCount);
}

if (array_key_exists('clear', $_POST)){
    showData(null,0);
}


//funkcja wysiwetlajaca dane
function showData($data, $lineCount){
    session_start();
    $_SESSION["data"]=$data;
    $_SESSION["lineCount"]=$lineCount;
    $duplicatesNumber = 0;
    $newRowsNumber = 0;
    for ($i = 0; $i<count($data); $i++){
        if ($data[$i][15] == 'red') $duplicatesNumber += 1;
    }
    $newRowsNumber = count($data) - $duplicatesNumber;
var_dump($newRowsNumber);
    $_SESSION["duplicatesNumber"]= $duplicatesNumber;
    $_SESSION["newRowsNumber"]= $newRowsNumber;

    header('Location: ../../resources/views/showAll.php');
}

/* funkcja sprawdzająca powtórzenia w tablicy */
function compareData($dataFromExport, $dataInTable): array{


    for ($i=0; $i<count($dataInTable); $i++){
        for ($j =0; $j<15; $j++){
            if ($dataInTable[$i][$j] == 'Brak danych'){
                $dataInTable[$i][$j] = '';
            }
        }
    }

    $data = array_merge($dataFromExport, $dataInTable);

    $uniqueData = array();

    $i=0;
    foreach ($data as $row){
        if (!in_array($row, $uniqueData)){
            $uniqueData[$i] = $row;
            $i++;
        }
    }

    $i=0;
    foreach ($uniqueData as $row){
        if (in_array($row,$dataFromExport) && in_array($row, $dataInTable)){
            $uniqueData[$i][15] = 'red';
        }
        $i++;
    }
    return $uniqueData;
}

