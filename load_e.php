<?php
require_once "db_module.php";

$link = null;
taoKetNoi($link);

if (isset($_GET['option']) && $_GET['option'] == 'e') {
    $query = "SELECT dg.* 
    FROM tbl_docgia dg JOIN tbl_binhluan bl ON dg.id_docgia = bl.id_docgia 
    JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin 
    WHERE bt.tieude = 'Thoái trào tất yếu của Apple trước cạnh tranh trên thị trường smartphone' 
    AND bl.noidung LIKE '%ngốc nghếch%';";

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
