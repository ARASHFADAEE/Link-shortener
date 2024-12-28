<?php


if (isset($_GET['success']) && $_GET['success'] == 1 && $_GET['status'] == 2) {
    if (isset($_GET['trackId'])) {
        require_once('./class/payment.php');
        $has_pay = $payment->verify($_GET['trackId']);
        var_dump($has_pay);

        if ($has_pay) {
            echo 'sucsses';
        }


    }
}


if (isset($_GET['success'])) {
    switch ($_GET['status']) {
        case 1:
            echo 'پرداخت شده و تایید شده';
            break;
        case 2:
            echo 'پرداخت شده - تاییدنشده';
            break;

        case 3:
            echo 'لغوشده توسط کاربر';
            break;
        case 4:
            echo '‌شماره کارت نامعتبر می‌باشد.';
            break;
        case 7:
            echo '‌تعداد درخواست‌ها بیش از حد مجاز می‌باشد.';
            break;

    }
}