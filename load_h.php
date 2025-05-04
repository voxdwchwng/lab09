<?php
require_once "db_module.php";
session_start();

$link = null;
taoKetNoi($link);

// Tìm bản tin theo tiêu đề
$tieude_bantin = "Liệu Samsung sẽ thành công với Galaxy S4 hay sẽ rơi vào tình trạng suy giảm sự tin cậy của nhà đầu tư như Apple";
$query = "SELECT * FROM tbl_bantin WHERE tieude = '$tieude_bantin'";
$result = chayTruyVanTraVeDL($link, $query);
$baiViet = mysqli_fetch_assoc($result);

if (!$baiViet) {
    echo "Bản tin không tồn tại.";
    exit();
}

// Xử lý bình luận
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = mysqli_real_escape_string($link, $_POST['tieude']);
    $noidung = mysqli_real_escape_string($link, $_POST['noidung']);
    
    // Gán ID độc giả mặc định là 1
    $id_docgia = 1;

    // Thêm bình luận vào cơ sở dữ liệu với thời gian hiện tại
    $queryInsert = "INSERT INTO tbl_binhluan (tieude, noidung, thoigian, id_bantin, id_docgia)
                    VALUES ('$tieude', '$noidung', NOW(), {$baiViet['id_bantin']}, $id_docgia)";
    
    if (chayTruyVanKhongTraVeDL($link, $queryInsert)) {
        echo "Bình luận đã được thêm thành công!";
    } else {
        echo "Có lỗi xảy ra khi thêm bình luận: " . mysqli_error($link);
    }
    exit(); // Thoát để không tải lại trang
}

// Lấy danh sách bình luận
$queryBinhLuan = "SELECT * FROM tbl_binhluan WHERE id_bantin = {$baiViet['id_bantin']} ORDER BY thoigian DESC";
$resultBinhLuan = chayTruyVanTraVeDL($link, $queryBinhLuan);
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
        .comment-form {
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .comment {
            margin: 10px 0;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .message {
            color: green; /* Màu cho thông báo thành công */
            font-weight: bold;
        }
        .error {
            color: red; /* Màu cho thông báo lỗi */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($baiViet['tieude']); ?></h1>
    <p><?php echo htmlspecialchars($baiViet['noidung']); ?></p>

    <div class="comment-form">
        <h2>Bình luận</h2>
        <form id="commentForm">
            <input type="text" name="tieude" placeholder="Tiêu đề bình luận" required>
            <textarea name="noidung" placeholder="Nội dung bình luận" required></textarea>
            <button type="submit">Gửi Bình Luận</button>
        </form>
        <p id="message"></p>
    </div>

    <h3>Danh sách bình luận:</h3>
    <?php while ($binhLuan = mysqli_fetch_assoc($resultBinhLuan)): ?>
        <div class="comment">
            <h4><?php echo htmlspecialchars($binhLuan['tieude']); ?></h4>
            <p><?php echo htmlspecialchars($binhLuan['noidung']); ?></p>
            <p><em><?php echo htmlspecialchars($binhLuan['thoigian']); ?></em></p>
        </div>
    <?php endwhile; ?>

    <script>
    $(document).ready(function() {
        $('#commentForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn tải lại trang

            $.ajax({
                type: 'POST',
                url: 'load_h.php', // Đường dẫn đến file xử lý
                data: $(this).serialize(), // Dữ liệu từ form
                success: function(response) {
                    $('#message').html(response); // Hiển thị thông báo
                    $('#commentForm')[0].reset(); // Reset form
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