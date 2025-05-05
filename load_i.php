<?php
require_once "db_module.php";
session_start();

$link = null;
taoKetNoi($link);

$id_bantin = 123; // ID bài viết cần tìm
$query = "SELECT * FROM tbl_bantin WHERE id_bantin = $id_bantin";
$result = chayTruyVanTraVeDL($link, $query);
$baiViet = mysqli_fetch_assoc($result);

if (!$baiViet) {
    echo "Bài viết không tồn tại.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($baiViet['tieude']); ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .message {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($baiViet['tieude']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($baiViet['noidung'])); ?></p>

    <div class="update-form">
        <h2>Cập nhật nội dung</h2>
        <form id="updateForm">
            <textarea name="noidung_moi" placeholder="Nhập nội dung mới" required></textarea>
            <input type="hidden" name="id_bantin" value="<?php echo $id_bantin; ?>">
            <button type="submit">Cập nhật</button>
        </form>
        <p id="message"></p>
    </div>

    <script>
    $(document).ready(function() {
        $('#updateForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn tải lại trang

            $.ajax({
                type: 'POST',
                url: 'update_post.php', // Gửi yêu cầu đến trang xử lý
                data: $(this).serialize(),
                success: function(response) {
                    $('#message').html(response); // Hiển thị thông báo
                },
                error: function() {
                    $('#message').html('Có lỗi xảy ra.');
                }
            });
        });
    });
    </script>
</body>
</html>