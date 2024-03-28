<?php
if(isset($_POST['adduser'])){
    $taikhoan = remove_extra_spaces($_POST['taikhoan']);
    $matkhau = $_POST['matkhau'];
    $hoten = remove_extra_spaces($_POST['hoten']);
    $kiemtra = kiem_tra_trung_user($taikhoan);
    if(!$kiemtra){
        if($taikhoan != null ){
            if(kiem_tra_ho_ten($hoten)){
            add_user($taikhoan,$matkhau, $hoten);
            echo '<script>
            window.location.href = "../controller/indexadmin.php?c=qlnguoidung";
            </script>;';
            exit;
            }else{
                echo "<script>alert('Họ tên không được chứa chữ số!')</script>";
            }
        }
    } else {
        echo "<script>alert('Tài khoản đã tồn tại')</script>";
    }
}

if (isset ($_POST['delete'])) {
    $id_user = $_POST['id_user'];
    echo '<script>
            var result = confirm("Bạn có chắc xóa người dùng này chứ?");
            if (result) {
                window.location.href = "../controller/indexadmin.php?c=qlnguoidung&id_user=' . $id_user . '&y_delete";
            } else {
                window.location.href = "../controller/indexadmin.php?c=qlnguoidung";
            }
          </script>';
    exit();
}
if (isset ($_GET['y_delete'])) {
    $id_user = $_GET['id_user'] ?? null; 
    if ($id_user !== null) {
        delete_nguoidung($id_user);
        header("Location: ../controller/indexadmin.php?c=qlnguoidung"); 
    }
    exit();
}
?>
<main>
        <h2>Quản lý Người dùng</h2>
        <div class="product-form-container">
            <button type="button" id="addProductButton" onclick="toggleAddProductForm()">Thêm Người dùng</button>
            <div class="product-form" id="addProductForm" style="display: none;">

                <h2>Thêm Người dùng</h2>
            <form method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cot">Tài khoản:</label>
                    <input type="text" name="taikhoan" required>
                </div>
                <div class="form-group">
                    <label for="cot">Mật khẩu:</label>
                    <input type="password" name="matkhau" required>
                </div>
                <div class="form-group">
                    <label for="cot">Họ tên:</label>
                    <input type="text" name="hoten" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="adduser" value="Thêm người dùng">
                </div>
            </form>
        </div>
            <div class="product-form edit-form" id="editProductForm" style="display: hide;">
            </div>

            <?php
            $nguoidungs = show_nguoidung_all();
            if ($nguoidungs) {
                echo '<div class="product-table">';
                echo '<h2>Danh sách người dùng</h2>';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID user</th>';
                echo '<th>Tài khoản</th>';
                echo '<th>Mật khẩu</th>';
                echo '<th>Họ tên</th>';
                echo '<th>Thao tác</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($nguoidungs as $nguoidung) {
                    echo '<tr>';
                    echo '<td>' . $nguoidung['id_user'] . '</td>';
                    echo '<td>' . $nguoidung['taikhoan'] . '</td>';
                    echo '<td>' . str_repeat('*', strlen($nguoidung['matkhau'] )). '</td>';
                    echo '<td>' . $nguoidung['hoten'] . '</td>';
                    echo '<td>';
                    // Xóa
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="id_user" value="' . $nguoidung['id_user'] . '">';
                    echo '<button type="submit" name="delete">Xóa</button>';
                    echo '</form>';
                    
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo 'No users found.';
            }
            ?>

        </div>
        </div>
    </main>