<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Dữ liệu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-group button {
            min-width: 130px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="mb-4 text-center">📊 Giao Diện Quản Lý Dữ Liệu</h2>

    <div class="accordion" id="dataAccordion">
        <!-- Bảng chính -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTables">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTables">
                    📂 Chọn Bảng Dữ Liệu
                </button>
            </h2>
            <div id="collapseTables" class="accordion-collapse collapse show" data-bs-parent="#dataAccordion">
                <div class="accordion-body">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_nguoidung')">Người Dùng</button>
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_bantin')">Bản Tin</button>
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_binhluan')">Bình Luận</button>
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_dangbai')">Đăng Bài</button>
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_danhmuc')">Danh Mục</button>
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_docgia')">Độc Giả</button>
                        <button class="btn btn-outline-primary" onclick="loadTable('tbl_phanquyen')">Phân Quyền</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tùy chọn đặc biệt -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSpecial">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpecial">
                    ⚙️ Tùy Chọn Đặc Biệt
                </button>
            </h2>
            <div id="collapseSpecial" class="accordion-collapse collapse" data-bs-parent="#dataAccordion">
                <div class="accordion-body">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('a')">A</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('b')">B</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('c')">C</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('d')">D</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('e')">E</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('f')">F</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('g')">G</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('h')">H</button>
                        <button class="btn btn-outline-secondary" onclick="loadSpecial('i')">I</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiển thị kết quả -->
    <div id="table-container" class="mt-5">
        <div class="alert alert-info text-center">📥 Vui lòng chọn một bảng để hiển thị dữ liệu.</div>
    </div>
</div>

<!-- Script -->
<script>
    function loadTable(tableName) {
        fetch(`load_table.php?table=${tableName}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById("table-container").innerHTML = data;
            })
            .catch(() => {
                alert("❌ Lỗi khi tải dữ liệu bảng.");
            });
    }

    function loadSpecial(option) {
        const url = `load_${option}.php`;

        fetch(`${url}?option=${option}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById("table-container").innerHTML = data;
            })
            .catch(() => {
                alert("❌ Lỗi khi tải dữ liệu đặc biệt.");
            });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
