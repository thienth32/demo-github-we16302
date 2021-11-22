<?php
require_once './dao/system_dao.php';
function home(){
    $sqlQuery = "select * from products";
    $products = executeQuery($sqlQuery, true);
    client_render('homepage/index.php', compact('products'));
}

function about(){
    
}

function img_upload_form(){
    client_render('homepage/upload-img-form.php');
}

function save_image(){
    $file = $_FILES['image'];
    $filename = "";
    if($file['size'] > 0){
        $filename = uniqid() . '-' . $file['name'];
        move_uploaded_file($file['tmp_name'], './public/uploads/' . $filename);
        $filename = 'uploads/' . $filename;
    }

    echo PUBLIC_URL . $filename;
}



?>