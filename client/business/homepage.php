<?php
require_once './dao/system_dao.php';
function home(){
    $sqlQuery = "select * from products";
    $products = executeQuery($sqlQuery, true);
    client_render('homepage/index.php', compact('products'));
}



?>