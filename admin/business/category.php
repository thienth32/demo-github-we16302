<?php

function cate_index(){
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    // lấy danh sách danh mục
    $sql = "select * from categories where name like '%$keyword%'";
    $cates = executeQuery($sql, true);

    // hiển thị view
    admin_render('category/index.php', compact('cates', 'keyword'), 'admin-assets/custom/category_index.js');
}

?>