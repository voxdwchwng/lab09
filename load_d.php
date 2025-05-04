<?php
require_once "db_module.php";

$link = null;
taoKetNoi($link);

if (isset($_GET['option']) && $_GET['option'] == 'd') {
    // Truy vấn D: Lấy bình luận theo tiêu đề bản tin cụ thể
    $query = "SELECT tbl_binhluan.*,tbl_bantin.tieude as tieudebantin
              FROM tbl_binhluan
              JOIN tbl_bantin ON tbl_binhluan.id_bantin = tbl_bantin.id_bantin
              WHERE tbl_bantin.tieude = 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kì thương mại điện tử'";

    $result = chayTruyVanTraVeDL($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $fields = mysqli_fetch_fields($result);

        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-hover table-bordered">';
        echo '<thead class="thead-dark"><tr>';
        foreach ($fields as $field) {
            echo '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        echo '</tr></thead><tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . htmlspecialchars($value) . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
    } else {
        echo '<p>Không có bình luận phù hợp.</p>';
    }

    giaiPhongBoNho($link, $result);
}
?>
