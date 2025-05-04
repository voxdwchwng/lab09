<?php
require_once "db_module.php";

$link = null;
taoKetNoi($link);

if (isset($_GET['option']) && $_GET['option'] == 'g') {
    $query = "
    INSERT INTO tbl_bantin (
        id_danhmuc,
        tieude,
        hinhanh,        
        noidung,
        tukhoa,
        nguontin
    ) VALUES (
        (SELECT id_danhmuc FROM tbl_danhmuc WHERE ten_danhmuc = 'Công nghệ' LIMIT 1),
        'Liệu Samsung sẽ thành công với Galaxy S4 hay sẽ rơi vào tình trạng suy giảm sự tin cậy của nhà đầu tư như Apple',
        'images/news/m4chip.jpg',
        'Bản tin thuộc danh mục công nghệ',
        'Apple, đầu tư, công nghệ',
        'VnExpress'
    );
    ";

    $result = chayTruyVanKhongTraVeDL($link, $query); // lưu ý: insert/update/delete thì dùng hàm khác
    if($result) {
        echo "<p>Thêm bản tin mới thành công.</p>";
    } else {
        echo "<p>Thêm bản tin thất bại.</p>";
    }


    giaiPhongBoNho($link, $result);
}
?>
