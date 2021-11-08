<?php

function get_connect(){
    $connect = new PDO("mysql:host=127.0.0.1;dbname=we16302;charset-utf8", "root", "12345678");
    return $connect;
}


?>