<?php

const BASE_URL = "http://localhost/we16302-da1/";
const ADMIN_ASSET = BASE_URL . 'public/admin-assets/';


function dd(){
    $data = func_get_args();
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

function client_render($view, $data = []){
    extract($data);
    $view = './client/views/' . $view;
    include_once "./client/views/layouts/main.php";
}

function admin_render($view, $data = []){
    extract($data);
    $view = './admin/views/' . $view;
    include_once "./admin/views/layouts/main.php";
}

?>