<?php

/* funkcja pobierajaca dane z pliku xml */
function getDataFromXmlFile(){
    $filename = "../../resources/dataFiles/katalog.xml";
    $xml = simplexml_load_file($filename);
    $data = array();
    $lineCount = 0;

    if ($xml) {
        $lineCount = count($xml->children());
        $data = convertDataFromXml($xml, $lineCount);
    } else {
        echo 'Błąd ładowania pliku';
    }
    return array($data, $lineCount);
}

/* funkcja konwertujaca dane XML na tablice danych */
function convertDataFromXml($xml, $lineCount){

    $data = array();

    for ($i = 0; $i<$lineCount; $i++){
        $data[$i][0] = (string)$xml->laptop[$i]->manufacturer;
        $data[$i][1] = (string)$xml->laptop[$i]->screen->size;
        $data[$i][2] = (string)$xml->laptop[$i]->screen->resolution;
        $data[$i][3] = (string)$xml->laptop[$i]->screen->type;
        $data[$i][4] = (string)$xml->laptop[$i]->screen['touch'];
        if ($data[$i][4] == 'no') {
            $data[$i][4] = 'nie';
        } elseif ($data[$i][4] == 'yes'){
            $data[$i][4] = 'tak';
        }
        $data[$i][5] = (string)$xml->laptop[$i]->processor->name;
        $data[$i][6] = (string)$xml->laptop[$i]->processor->physical_cores;
        $data[$i][7] = (string)$xml->laptop[$i]->processor->clock_speed;
        $data[$i][8] = (string)$xml->laptop[$i]->ram;
        $data[$i][9] = (string)$xml->laptop[$i]->disc->storage;
        $data[$i][10] = (string)$xml->laptop[$i]->disc['type'];
        $data[$i][11] = (string)$xml->laptop[$i]->graphic_card->name;
        $data[$i][12] = (string)$xml->laptop[$i]->graphic_card->memory;
        $data[$i][13] = (string)$xml->laptop[$i]->os;
        $data[$i][14] = (string)$xml->laptop[$i]->disc_reader;
    }

    return $data;
}

/* funkcja zapisujaca dane do pliku xml */
function saveDataToXmlFile($data, $lineCount){

    $file = new DOMDocument();

    /* Format XML to save indented tree rather than one line */
    $file->preserveWhiteSpace = true;
    $file->formatOutput = true;

    /* laptops tag */
    $laptops = $file->createElement("laptops");
    $laptopsAttribute = $file->createAttribute('moddate');
    $laptopsAttribute->value = date("Y-m-d")." T ".date("H:i");
    $laptops->appendChild($laptopsAttribute);
    $file->appendChild($laptops);

    for ($i = 0; $i<$lineCount; $i++){

        /* laptop tag */
        $laptop = $file->createElement("laptop");
        $laptopAttribute = $file->createAttribute('id');
        $laptopAttribute->value = ($i+1);
        $laptop->appendChild($laptopAttribute);
        $laptops->appendChild($laptop);

        /* manufacturer tag */
        $manufacturer = $file->createElement("manufacturer", $data[$i][0]);
        $laptop->appendChild($manufacturer);

        /* screen tag */
        $screen = $file->createElement("screen");
        $screenAttribute = $file->createAttribute('touch');
        $screenAttribute->value = $data[$i][4];
        $screen->appendChild($screenAttribute);
        $laptop->appendChild($screen);

            /* size tag */
            $size = $file->createElement("size", $data[$i][1]);
            $screen->appendChild($size);

            /* resolution tag */
            $resolution = $file->createElement("resolution",$data[$i][2]);
            $screen->appendChild($resolution);

            /* type tag */
            $type = $file->createElement("type", $data[$i][3]);
            $screen->appendChild($type);


        /* processor tag */
        $processor = $file->createElement("processor");
        $laptop->appendChild($processor);

            /* name tag */
            $name = $file->createElement("name", $data[$i][5]);
            $processor->appendChild($name);

            /* physical_cores tag */
            $physical_cores = $file->createElement("physical_cores", $data[$i][6]);
            $processor->appendChild($physical_cores);

            /* clock_speed tag */
            $clock_speed = $file->createElement("clock_speed", $data[$i][7]);
            $processor->appendChild($clock_speed);


        /* ram tag */
        $ram = $file->createElement("ram", $data[$i][8]);
        $laptop->appendChild($ram);


        /* disc tag */
        $disc = $file->createElement("disc");
        $discAttribute = $file->createAttribute('type');
        $discAttribute->value = $data[$i][10];
        $disc->appendChild($discAttribute);
        $laptop->appendChild($disc);

            /* storage tag */
            $storage = $file->createElement("storage", $data[$i][9]);
            $disc->appendChild($storage);


        /* graphic_card tag */
        $graphic_card = $file->createElement("graphic_card");
        $laptop->appendChild($graphic_card);

            /* name tag */
            $name = $file->createElement("name", $data[$i][11]);
            $graphic_card->appendChild($name);

            /* memory tag */
            $memory = $file->createElement("memory", $data[$i][12]);
            $graphic_card->appendChild($memory);

        /* os tag */
        $os = $file->createElement("os", $data[$i][13]);
        $laptop->appendChild($os);

        /* disc_reader tag */
        $disc_reader = $file->createElement("disc_reader", $data[$i][14]);
        $laptop->appendChild($disc_reader);

    }

    $file->save("test.xml");

    $xmlString = file_get_contents('test.xml');
    unlink('test.xml');
    unlink('../../resources/dataFiles/katalog.xml');
    $xmlString = str_replace('<?xml version="1.0"?>'."\n", '', $xmlString);
    file_put_contents("../../resources/dataFiles/katalog.xml", $xmlString, FILE_APPEND);
}
