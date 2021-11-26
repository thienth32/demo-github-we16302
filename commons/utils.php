<?php

const BASE_URL = "http://localhost/we16302-da1/";
const PUBLIC_URL = BASE_URL . 'public/';
const ADMIN_URL = BASE_URL . 'cp-admin/';
const ADMIN_ASSET = BASE_URL . 'public/admin-assets/';


function dd(){
    $data = func_get_args();
    echo "<pre>";
    foreach($data as $item){
        var_dump($item);
    }
    echo "</pre>";
    die;
}

function client_render($view, $data = []){
    extract($data);
    $view = './client/views/' . $view;
    include_once "./client/views/layouts/main.php";
}

function admin_render($view, $data = [], $jsFile = null){
    extract($data);
    $view = './admin/views/' . $view;
    include_once "./admin/views/layouts/main.php";
}

function getFavoriteProducts(){
    if(!isset($_SESSION['auth']) || $_SESSION['auth'] == null){
        return false;
    }
    $userId = $_SESSION['auth']['id'];
    $getFavoriteProductQuery = "select * from favorite_products where user_id = $userId";
    $favoriteProducts = executeQuery($getFavoriteProductQuery, true);
    return $favoriteProducts;
}

?>