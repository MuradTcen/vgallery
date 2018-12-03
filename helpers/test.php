<?php
//require_once("lib/Tinify/Exception.php");
//require_once("lib/Tinify/ResultMeta.php");
//require_once("lib/Tinify/Result.php");
//require_once("lib/Tinify/Source.php");
//require_once("lib/Tinify/Client.php");
//require_once("lib/Tinify.php");
require __DIR__ . '..\vendor\autoload.php';


$apiKey = 'BXF4_8yUAMYdoxaSpbxjhABCXYxkzHLh';



    try {
        \Tinify\setKey($apiKey);
        \Tinify\validate();
    } catch(\Tinify\Exception $e) {
        // Validation of API key failed.
        echo $e;
    }
//
//    $source = \Tinify\fromFile("upload/images/products/no-image.jpg");
//    $resized = $source->resize(array(
//        "method" => "fit",
//        "width" => 150,
//        "height" => 100
//    ));
//    $resized->toFile("upload/images/products/optimized.jpg");





