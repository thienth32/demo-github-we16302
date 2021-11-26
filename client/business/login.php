<?php
function login_form(){
    client_render('auth/login-form.php');
}

function submit_login(){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $getUserQuery = "select * from users where email = '$email'";
    $user = executeQuery($getUserQuery, false);
    if($user && password_verify($password, $user['password'])){
        unset($user['password']);
        $_SESSION['auth'] = $user;
        header('location: ' . BASE_URL);
    }
    client_render('auth/login-form.php');
}


function logout(){
    unset($_SESSION['auth']);
    header('location: ' . BASE_URL . 'dang-nhap');
}
?>