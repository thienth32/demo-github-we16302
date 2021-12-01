<?php
require_once './dao/system_dao.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function home(){
    $sqlQuery = "select * from products";
    $products = executeQuery($sqlQuery, true);
    client_render('homepage/index.php', compact('products'));
}

function add2Cart(){
    $pId = $_GET['id'];
    // lấy thông tin sản phẩm
    $getProductByIdQuery = "select * from products where id = $pId";
    $product = executeQuery($getProductByIdQuery, false);
    if(!$product){
        header('location: ' . BASE_URL);
        die;
    }
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    // kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
    $existedIndex = -1;
    foreach ($cart as $index => $item) {
        if($item['id'] == $product['id']){
            $existedIndex = $index;
            break;
        }
    }
    // nếu có rồi thì cộng thêm 1 đơn vị vào quantity
    if($existedIndex != -1){
        $cart[$existedIndex]['quantity']++;
    }else{
        // nếu chưa có thì thêm vào giỏ với quanity mặc định = 1
        $product['quantity'] = 1;
        $cart[] = $product;
    }

    $_SESSION['cart'] = $cart;
    
    header('location: ' . BASE_URL);
    die;
}

function checkout(){
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
        header('location: '. BASE_URL);
        die;
    }
    $cart = $_SESSION['cart'];
    client_render('homepage/checkout.php', compact('cart'));
}

function paycart()
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    // insert dữ liệu để tạo hóa đơn mới, sau đó lấy id của hóa đơn
    $createInvoiceQuery = "insert into invoices 
                                (customer_name, customer_phone_number, customer_email, 
                                    customer_address, note)
                            values
                                ('$name', '$phone', '$email', '$address', '$note')";
    $invoiceId = insertDataAndGetId($createInvoiceQuery);
    $totalPrice = 0;
    // chạy vòng lặp qua các phần tử của giỏ hàng, sau đó insert dữ liệu vào bảng invoice_detail
    foreach ($_SESSION['cart'] as $item) {
        $productId = $item['id'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        $totalPrice += $price*$quantity;
        $insertInvoiceDetailQuery = "insert into invoice_detail 
                                        (invoice_id, product_id, quantity, unit_price)
                                    values 
                                        ($invoiceId, $productId, $quantity, $price)";
        executeQuery($insertInvoiceDetailQuery, false);
    }
    // Cập nhật tổng số tiền vào hóa đơn
    $updateTotalPriceToInvoice = "update invoices
                                    set total_price = $totalPrice
                                where id = $invoiceId";
    executeQuery($updateTotalPriceToInvoice, false);

    unset($_SESSION['cart']);

    header('location: ' . BASE_URL);
    die;
    
}

function favorite_product(){
    $id = $_GET['id'];
    // ktra xem đã được yêu thích sản phẩm này hay chưa 
    $userId = $_SESSION['auth']['id'];
    $checkFavoriteProduct = "select * from favorite_products where product_id = $id and user_id = $userId";
    $favorite = executeQuery($checkFavoriteProduct, false);
    // nếu chưa có thì lưu vào db
    if(!$favorite){
        $currentTime = date("Y-m-d h:i:s");
        $addFavoriteQuery = "insert into favorite_products 
                                (user_id, product_id, created_at)
                            values 
                                ($userId, $id, '$currentTime')";
        executeQuery($addFavoriteQuery);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
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

function email_form(){
    client_render('homepage/send_email_form.php');
}

function send_email(){
    $recciever = $_POST['recceiver'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
        $mail->CharSet = 'UTF-8';                   
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tài khoản gmail';                     //SMTP username
        $mail->Password   = 'mật khẩu của gmail';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('example@gmail.com', 'ThienTH');

        $arrEmail = explode(',', $recciever);
        
        foreach($arrEmail as $em){
            $mail->addAddress(trim($em));
        }
                       
        $mail->addReplyTo('example@fpt.edu.vn', 'ThienTH Teacher');
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;
        $mail->AltBody = $content;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}


?>