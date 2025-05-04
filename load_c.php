<?php
require_once "db_module.php";

$link = null;
taoKetNoi($link);

if (isset($_GET['option']) && $_GET['option'] == 'c') {
    // Truy vấn C: Lấy bản tin thuộc danh mục Giáo dục hoặc Đời sống
    $query = "SELECT tbl_bantin.*,tbl_danhmuc.ten_danhmuc 
              FROM tbl_bantin
              JOIN tbl_danhmuc ON tbl_bantin.id_danhmuc = tbl_danhmuc.id_danhmuc
              WHERE tbl_danhmuc.ten_danhmuc IN ('Giáo dục', 'Đời sống')";

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
        echo '<p>Không có dữ liệu phù hợp.</p>';
    }

    giaiPhongBoNho($link, $result);
}
?>
