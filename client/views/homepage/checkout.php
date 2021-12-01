<div>
    <fieldset>
        <legend>Danh sách sản phẩm</legend>
        <table border="1">
            <thead>
                <td>ID</td>
                <td>Tên sp</td>
                <td>Số lượng</td>
                <td>Giá</td>
                <td>Thành tiền</td>
            </thead>
            <tbody>
                <?php
                    $totalPrice = 0;
                ?>
                <?php foreach($cart as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['price'] * $item['quantity'] ?></td>
                        <?php $totalPrice += $item['price'] * $item['quantity'] ?>
                    </tr>
                <?php endforeach?>
                <tr>
                    <td colspan="4">Tổng tiền</td>
                    <td><?= $totalPrice ?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <br>
    <h3>Thông tin thanh toán</h3>
    <form action="pay-cart" method="post">
        <div>
            <label for="">Họ và tên:</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Email:</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="">Số điện thoại:</label>
            <input type="text" name="phone">
        </div>
        <div>
            <label for="">Địa chỉ nhận hàng:</label>
            <input type="text" name="address">
        </div>
        <div>
            <label for="">Ghi chú:</label>
            <textarea name="note" id="" rows="5"></textarea>
        </div>
        <div>
            <button type="submit">Thanh toán</button>
        </div>

    </form>
</div>