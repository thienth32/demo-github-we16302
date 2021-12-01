<table>
    <thead>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>image</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($products as $p):?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['name'] ?></td>
                <td><?= $p['price'] ?></td>
                <td><?= $p['image'] ?></td>
                <td>
                    <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] != null):?>
                        <a href="<?= BASE_URL . 'yeu-thich?id=' . $p['id']?>">Yêu thích</a>
                    <?php endif ?>
                    <a href="<?= BASE_URL . 'add-to-cart?id=' . $p['id']?>">giỏ hàng</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>