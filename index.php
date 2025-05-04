<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Dữ liệu từ Bảng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="my-4">Chọn Bảng để Hiển Thị</h2>
    <div class="btn-group">
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_nguoidung')">Bảng Người Dùng</button>
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_bantin')">Bảng Bản Tin</button>
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_binhluan')">Bảng Bình Luận</button>
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_dangbai')">Bảng Đăng Bài</button>
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_danhmuc')">Bảng Danh Mục</button>
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_docgia')">Bảng Độc Giả</button>
        <button class="btn btn-primary m-1" onclick="loadTable('tbl_phanquyen')">Bảng Phân Quyền</button>
    </div>

    <div class="btn-group">
        <button class="btn btn-secondary m-1" onclick="loadSpecial('a')">a</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('b')">b</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('c')">c</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('d')">d</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('e')">e</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('f')">f</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('g')">g</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('h')">h</button>
        <button class="btn btn-secondary m-1" onclick="loadSpecial('i')">i</button>
    </div>
    
    <div id="table-container" class="mt-5">
        <!-- Kết quả sẽ được hiển thị ở đây -->
    </div>
</div>


<script>
    // Hàm loadTable sẽ tải dữ liệu của bảng từ server
    function loadTable(tableName) {
        $.ajax({
            url: 'load_table.php',
            type: 'GET',
            data: { table: tableName },
            success: function(data) {
                $('#table-container').html(data);  // Hiển thị dữ liệu vào trong phần #table-container
            },
            error: function() {
                alert("Có lỗi khi tải dữ liệu.");
            }
        });
    }



    function loadSpecial(option) {
        let url = '';
        switch (option) {
            case 'a':
                url = 'load_a.php';
                break;
            case 'b':
                url = 'load_b.php';
                break;
            case 'c':
                url = 'load_c.php';
                break;
            case 'd':
                url = 'load_d.php';
                break;
            case 'e':
                url = 'load_e.php';
                break;
            case 'f':
                url = 'load_f.php';
                break;
            case 'g':
                url = 'load_g.php';
                break;
            case 'h':
                url = 'load_h.php';
                break;
            case 'i':
                url = 'load_i.php';
                break;
        }

        $.ajax({
            url: url,  // Gọi file đúng theo option
            type: 'GET',
            data: { option: option },
            success: function(data) {
                $('#table-container').html(data);
            },
            error: function() {
                alert("Có lỗi khi tải dữ liệu.");
            }
        });
    }
    
</script>
</body>
</html>
