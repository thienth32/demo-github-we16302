<?php
function home(){
    $name = 'thienth';
    $age = 30;
    client_render('homepage/index.php', ['name' => $name, 'age' => $age]);
}



?>