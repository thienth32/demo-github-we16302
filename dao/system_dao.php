<?php
function get_connect(){
    $connect = new PDO("mysql:host=127.0.0.1;dbname=kaopiz;charset=utf8", "root", "12345678");
    return $connect;
}


function executeQuery($sql, $getAll = false){

    $connect = get_connect();
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    if($getAll){
        return $stmt->fetchAll();
    }

    return $stmt->fetch();
}

function insertDataAndGetId($sql){
    $connect = get_connect();
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $id = $connect->lastInsertId();
    return $id;
}


?>