<?php
require_once "db_module.php";

if (isset($_GET['table'])) {
    $table = $_GET['table'];

    $link = null;
    taoKetNoi($link);

    $query = "SELECT * FROM $table";
    $result = chayTruyVanTraVeDL($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $fields = mysqli_fetch_fields($result);
        
        echo '<table class="table table-bordered">';
        echo '<thead class="thead-dark"><tr>';
        foreach ($fields as $field) {
            echo '<th>' . ucfirst($field->name) . '</th>';
        }
        echo '</tr></thead><tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>Không có dữ liệu.</p>';
    }

    giaiPhongBoNho($link, $result);
}
?>
