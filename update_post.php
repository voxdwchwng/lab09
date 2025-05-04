<?php
require_once "db_module.php";
session_start();

$link = null;
taoKetNoi($link);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_bantin = (int)$_POST['id_bantin'];
    $noidung_moi = mysqli_real_escape_string($link, $_POST['noidung_moi']);

    if (empty($noidung_moi)) {
        echo "Nội dung không được để trống.";
        exit();
    }

    $queryUpdate = "UPDATE tbl_bantin SET noidung = '$noidung_moi' WHERE id_bantin = $id_bantin";
    
    if (chayTruyVanKhongTraVeDL($link, $queryUpdate)) {
        echo "Nội dung đã được cập nhật thành công!";
    } else {
        echo "Có lỗi xảy ra khi cập nhật nội dung: " . mysqli_error($link);
    }
    exit();
}