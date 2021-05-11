<?php

require 'lib/nusoap.php';

require "app/Controllers/DatabaseController.php";

$server = new nusoap_server();
$server->configureWSDL("Manufacturer", "urn:service");

$server->register("getQuantityOfLaptopsByManufacturer",
    array("manufacturer"=>"xsd:string"),
    array("return"=>"xsd:integer"));

$server->register("getLaptopByManufacturers",
    array(),
    array("return"=>"xsd:string"));

$server->register("getLaptopsByScreenType",
    array("screenType"=>"xsd:string"),
    array("return" => "xsd:string"));


$server->register("getLaptopsScreenType",
    array(),
    array("return"=>"xsd:string"));

$server->register("getLaptopsByScreenProportion",
    array("screenProportion"=>"xsd:string"),
    array("return"=>"xsd:integer"));

$server->register("getLaptopsScreenProportion",
    array(),
    array("return"=>"xsd:string"));


//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
//$server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));