<?php

//wykonanie poleceń po kliknięciu przycisku importu z pliku txt
if (array_key_exists('importTxtFile', $_POST)){

    require_once ('TxtFileController.php');
    list($data, $lineCount) = getDataFromTxtFile();
    showData($data, $lineCount);
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
    showData($data, $lineCount);
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
    showData($data, $lineCount);
}

//wykonanie poleceń po kliknięciu przycisku eksportu do bazy danych
if (array_key_exists('exportDatabase', $_POST)){

    $data = $_POST['data'];
    $lineCount = count($data);

    require_once ('DatabaseController.php');
    saveDataToDatabase($data, $lineCount);
    showData($data, $lineCount);
}

//funkcja wysiwetlajaca dane
function showData($data, $lineCount){
    session_start();
    $_SESSION["data"]=$data;
    $_SESSION["lineCount"]=$lineCount;
    header('Location: ../../resources/views/showAll.php');
}