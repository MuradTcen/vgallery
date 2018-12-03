<?php

$url=parse_url(getenv("DATABASE_URL"));
//return array(
//    'host' => $url["host"],
//    'dbname' => substr($url["path"], 1),
//    'user' => $url["user"],
//    'password' => $url["pass"],
//);
// Массив с параметрами подключения к базе данных
if ($_SERVER['SERVER_NAME'] == "vgallery.herokuapp.com") {

    return array(
        'host' => $url["host"],
        'dbname' => substr($url["path"], 1),
        'user' => $url["user"],
        'password' => $url["pass"],
    );
}
else {
    // Массив с параметрами подключения к базе данных
    return array(
        'host' => 'localhost',
        'dbname' => 'vgallery',
        'user' => 'root',
        'password' => '',
    );
}
