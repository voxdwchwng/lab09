<?php
require_once "db_module.php";

$link = null;
taoKetNoi($link);

if (isset($_GET['option']) && $_GET['option'] == 'f') {
    // Truy vấn: Lấy id_bantin và số lượng like từ bảng tbl_bantin
    $query = "SELECT id_bantin, `like` FROM tbl_bantin";

    $result = chayTruyVanTraVeDL($link, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
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
}
?>
