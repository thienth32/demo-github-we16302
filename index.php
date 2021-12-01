<?php
session_start();
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : "/";
require_once './commons/utils.php';
require_once './dao/system_dao.php';
require_once './vendor/PHPMailer/src/Exception.php';
require_once './vendor/PHPMailer/src/PHPMailer.php';
require_once './vendor/PHPMailer/src/SMTP.php';
switch ($url) {
    case '/':
        require_once './client/business/homepage.php';
        home();
        break;
    case 'add-to-cart':
        require_once './client/business/homepage.php';
        add2Cart();
        break;
    case 'check-out':
        require_once './client/business/homepage.php';
        checkout();
        break;
    case 'pay-cart':
        require_once './client/business/homepage.php';
        paycart();
        break;
    case 'dang-nhap':
        require_once './client/business/login.php';
        login_form();
        break;
    case 'dang-xuat':
        require_once './client/business/login.php';
        logout();
        break;
    case 'submit-login':
        require_once './client/business/login.php';
        submit_login();
        break;
    case 'yeu-thich':
        require_once './client/business/homepage.php';
        favorite_product();
    case 'danh-muc':
        require_once './client/business/category.php';
        list_product();
        break;
    case 'cp-admin':
        checkAuth([STAFF_ROLE, ADMIN_ROLE]);
        require_once './admin/business/dashboard.php';
        dashboard_index();
        break;
    case 'cp-admin/danh-muc':
        
        require_once './admin/business/category.php';
        cate_index();
        break;
    case 'cp-admin/danh-muc/xoa':
        checkAuth([ADMIN_ROLE]);
        require_once './admin/business/category.php';
        cate_remove();
        break;
    case 'cp-admin/danh-muc/tao-moi':
        require_once './admin/business/category.php';
        cate_add_form();
        break;
    case 'cp-admin/danh-muc/luu-tao-moi':
        require_once './admin/business/category.php';
        cate_save_add();
        break;
    case 'upload-img-form':
        require_once './client/business/homepage.php';
        img_upload_form();
        break;
    case 'save-upload-image':
        require_once './client/business/homepage.php';
        save_image();
        break;
    case 'send-mail-form':
        require_once './client/business/homepage.php';
        email_form();
        break;
    case 'submit-email':
        require_once './client/business/homepage.php';
        send_email();
        break;
    default:
        # code...
        break;
}

?>