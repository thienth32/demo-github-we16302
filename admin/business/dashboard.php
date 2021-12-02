<?php

function dashboard_index(){
    $totalProduct = rand(100, 999);
    $totalProfit = rand(1000, 500000);
    $totalCustomer = rand(50, 20000);

    // lấy dữ liệu trong vòng 7 ngày
    // danh sách ngày
    $listDays = [];
    for ($i=0; $i < 7; $i++) { 
        
        $date = new DateTime('-' . $i . ' days');
        $dateFormat = $date->format('Y-m-d');
        $listDays[] = $dateFormat;
    }
    // lấy ra tất cả hóa đơn trong từng ngày
    // chạy vòng lặp qua các hóa đơn, cộng tổng tiền theo ngày
    // add vào mảng
    $listMoney = [];
    foreach ($listDays as $d) {
        $getInvoiceByDateQuery = "select * from invoices where created_at between '$d 0:0:0' and '$d 23:59:59'";
        $invoices = executeQuery($getInvoiceByDateQuery, true);
        $totalMoneyByDay = 0;
        foreach ($invoices as $iv) {
            $totalMoneyByDay += $iv['total_price'];
        }
        $listMoney[] = $totalMoneyByDay;
    }

    
    admin_render('dashboard/index.php', 
        compact('totalProduct', 'totalProfit', 'totalCustomer', 'listDays', 'listMoney'), 'admin-assets/custom/dashboard.js'); 
}


?>