<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WE16302 - Dự án 1</title>
</head>
<body>
    <header >
        <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] != null):?>
            <p>Tài khoản: <?= $_SESSION['auth']['email'] ?> (đã yêu thích: <?= count(getFavoriteProducts())?>), <a href="<?= BASE_URL . 'dang-xuat'?>">Đăng xuất</a></p>
        <?php else: ?>
            <a href="<?= BASE_URL . 'dang-nhap'?>">Đăng nhập</a>
        <?php endif ?>
        <p>
            <a href="<?= BASE_URL . 'check-out'?>">Giỏ hàng: (<?= countCartNumber() ?>) sản phẩm</a>
        </p>
    </header>
    <main>

        <?php include_once $view; ?>
    </main>
    <footer ></footer>
</body>
</html>