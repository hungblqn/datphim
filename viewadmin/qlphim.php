
<?php
// Check if the form is submitted for product addition
if (isset ($_POST['addproduct'])) {
    // Get the form data
    $tenphim = $_POST['tenphim'];
    $gia = $_POST['gia'];
    $id_rap = $_POST['id_rap'];
    $thoiluongphim = $_POST['thoiluongphim'];
    $doituong = $_POST['doituong'];
    $anh = $_POST['anh'];
    $mota = $_POST['mota'];

    // Call the function to insert the product
    phim_insert($tenphim, $gia, $id_rap, $thoiluongphim, $doituong, $anh, $mota);

    // Redirect to a page after successful insertion
    header("Location: ../controller/indexadmin.php?c=qlfilm"); // Replace with the actual page you want to redirect to
    exit();
}
?>
<body>
    <main>
        <h2>Quản lý Phim</h2>
        <div class="product-form-container">
            <!-- Form thêm phim -->
            <button type="button" id="addProductButton" onclick="toggleAddProductForm()">Thêm Phim mới</button>
            <div class="product-form" id="addProductForm" style="display: none;">

                <h2>Thêm Phim Mới</h2>
                <form method="post" action="" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="tenphim">Tên phim: </label>
                        <input type="text" name="tenphim" required>
                    </div>
                    <div class="form-group">
                        <label for="gia">Giá:</label>
                        <input type="text" name="gia" required>
                    </div>
                    <div class="form-group">
                        <label for="id_rap">Mã rạp:</label>
                        <select name="id_rap" required>
                            <option value="1">Rạp 1</option>
                            <option value="2">Rạp 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="thoiluongphim">Thời lượng phim:</label>
                        <input type="text" name="thoiluongphim" required>
                    </div>
                    <div class="form-group">
                        <label for="doituong">Đối tượng:</label>
                        <input type="text" name="doituong" required>
                    </div>
                    <div class="form-group">
                        <label for="anh">Ảnh:</label>
                        <input type="file" name="anh" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="mota">Mô tả:</label>
                        <input type="text" name="mota" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addproduct" value="Thêm phim">
                    </div>
                </form>
            </div>
            <div class="product-form edit-form" id="editProductForm" style="display: hide;">
                <!-- Form sửa phim -->
                <?php
                if (isset ($_POST['editphim'])) {
                    $id_phim = $_POST['id_phim'];

                    // Get product information from the database
                    $phim = get_phim_by_id($id_phim);
                    // Check if the product exists
                    if ($phim) {
                        $tenphim = $phim['tenphim'];
                        $id_rap = $phim['id_rap'];
                        $gia = $phim['gia'];
                        $thoiluongphim = $phim['thoiluongphim'];
                        $doituong = $phim['doituong'];
                        $anh = isset ($phim['anh']) ? $phim['anh'] : '';
                        $mota = $phim['mota'];
                        ?>
                        <h2>Sửa thông tin Phim</h2>
                        <form method="post" action="../controller/indexadmin.php?c=edit">
                            <input type="hidden" name="id_phim" value="<?php echo $phim['id_phim']; ?>">
                            <div class="form-group">
                                <label for="tenphim">Tên Phim: </label>
                                <input type="text" name="tenphim" value="<?php echo $tenphim; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="id_rap">Mã rạp:</label>
                                <select name="id_rap" required>
                                    <option value="1">Rạp 1</option>
                                    <option value="2">Rạp 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gia">Giá:</label>
                                <input type="text" name="gia" value="<?php echo $gia; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="thoiluongphim">Thời lượng phim:</label>
                                <input type="text" name="thoiluongphim" value="<?php echo $thoiluongphim; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="doituong">Đối tượng:</label>
                                <input type="text" name="doituong" value="<?php echo $doituong; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="anh">Ảnh:</label>
                                <input type="file" name="anh" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="mota">Mô tả:</label>
                                <input type="text" name="mota" value="<?php echo $mota; ?>" required>
                            </div>
                            <div class="form-group">
                                    <button type="submit" name="edit2">Cập nhật phim</button>
                            </div>
                        </form>
                    </div>
                    <?php
                    } else {
                        echo 'Phim không tồn tại.';
                    }
                }

                ?>
        </div>
        <!-- Bảng danh sách Phim -->
        <?php
        $products = show_film_all();
        if ($products) {
            echo '<div class="product-table">';
            echo '<h2>Danh sách Phim</h2>';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Tên Phim</th>';
            echo '<th>Mã Rạp</th>';
            echo '<th>Giá</th>';
            echo '<th>Thời lượng phim</th>';
            echo '<th>Đối tượng</th>';
            echo '<th>Ảnh</th>';
            echo '<th>Mô tả</th>';
            echo '<th>Thao tác</th>'; // Thêm cột mới cho nút xóa và nút sửa
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($products as $product) {
                echo '<tr>';
                echo '<td>' . $product['tenphim'] . '</td>';
                echo '<td>' . $product['id_rap'] . '</td>';
                echo '<td>' . number_format($product['gia'], 0, ',', '.') . 'đ' . '</td>';
                echo '<td>' . $product['thoiluongphim'];
                echo '<td>' . $product['doituong'] . '</td>';
                echo '<td><img src="../assets/images/' . $product['anh'] . '" alt="' . $product['tenphim'] . '"></td>';
                echo '<td>' . $product['mota'] . '</td>';
                echo '<td>';
                ?>
                <!-- Form xóa -->
                <form method="post" action="">
                    <input type="hidden" name="id_phim" value="<?php echo $product['id_phim']; ?>">
                    <button type="button" onclick="confirmDelete(<?php echo $product['id_phim']; ?>)">Xóa</button>
                </form>
                <!-- Form sửa -->
                <?php
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="id_phim" value="' . $product['id_phim'] . '">';
                echo '<button type="submit" name="editphim">Sửa</button>';
                echo '</form>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'No products found.';
        }
        ?>

        </div>
        </div>
    </main>
    <script>
    function confirmDelete(id_phim) {
        var result = confirm("Are you sure you want to delete this product?");
        if (result) {
            window.location.href = "../controller/indexadmin.php?c=delete&confirm_delete&id_phim=" + id_phim;
        }
    }
</script>
    <script>
        function toggleAddProductForm() {
            var addProductForm = document.getElementById('addProductForm');
            var editProductForm = document.getElementById('editProductForm');

            // Ẩn form sửa nếu đang hiển thị
            if (editProductForm.style.display !== 'none') {
                editProductForm.style.display = 'none';
            }

            // Đảo ngược trạng thái hiển thị của form thêm
            if (addProductForm.style.display === 'none') {
                addProductForm.style.display = 'block';
            } else {
                addProductForm.style.display = 'none';
            }
        }
    </script>

</body>

