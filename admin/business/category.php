<?php

function cate_index(){
    // lấy danh sách danh mục
    $sql = "select * from categories";
    $cates = executeQuery($sql, true);

    // hiển thị view
    admin_render('category/index.php', compact('cates'));
}

?>