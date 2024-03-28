<?php
if(isset($_POST['addrap'])){
    $ten = $_POST['tenrap'];
    $kiemtra = kiem_tra_trung($ten);
    if(!$kiemtra){
        if($ten != null ){
            add_rap($ten);
            header("Location: ../controller/indexadmin.php?c=qlrap");
            exit;
        }
    } else {
        echo "<script>alert('Tên đã tồn tại')</script>";
    }
}
if(isset($_POST['updaterap'])){
    $idrap = $_POST['id_rap'];
    $ten = $_POST['tenrap'];
    $kiemtra = kiem_tra_trung($ten);
    $ktrachung = get_rap_by_id($idrap);
    if($ktrachung['id_rap'] == $ten){
        echo "<script>alert('Chưa sửa gì !!!')</script>";
    }
    if(!$kiemtra){
        if($ten != null ){
            update_rap($ten, $idrap);
            header("Location: ../controller/indexadmin.php?c=qlrap");
            exit;
        }
    } else {
        echo "<script>alert('Tên đã tồn tại')</script>";
    }
}
if (isset ($_POST['delete'])) {
    $id_rap = $_POST['id_rap'];
    echo '<script>
            var result = confirm("Bạn có chắc xóa ghế này chứ?");
            if (result) {
                window.location.href = "../controller/indexadmin.php?c=qlrap&id_rap=' . $id_rap . '&y_delete";
            } else {
                window.location.href = "../controller/indexadmin.php?c=qlrap";
            }
          </script>';
    exit();
}
if (isset ($_GET['y_delete'])) {
    $id_rap = $_GET['id_rap'] ?? null; 
    if ($id_rap !== null) {
        delete_rap($id_rap);
        header("Location: ../controller/indexadmin.php?c=qlrap"); 
    }
    exit();
}
?>
<main>
        <h2>Quản lý Rạp</h2>
        <div class="product-form-container">
            <button type="button" id="addProductButton" onclick="toggleAddProductForm()">Thêm Rạp Mới</button>
            <div class="product-form" id="addProductForm" style="display: none;">

                <h2>Thêm Rạp Mới</h2>
                <form method="post" action="" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="cot">Tên rạp:</label>
                        <input type="text" name="tenrap" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="addrap" value="Thêm rạp">
                    </div>
                </form>
            </div>
            <div class="product-form edit-form" id="editProductForm" style="display: hide;">
                <?php
                if (isset($_POST['edit'])) {
                    $id_rap = $_POST['id_rap'];
                    $rap = get_rap_by_id($id_rap);
                        ?>
                        
                            <h2>Sửa thông tin Rạp</h2>
                            <form method="post" action="" accept-charset="UTF-8">
                                <input type="hidden" name="id_rap" value="<?php echo $rap['id_rap']; ?>">
                                <div class="form-group">
                                    <label for="tenrap">Tên rạp: </label>
                                    <input type="text" name="tenrap" value="<?php echo $rap['tenrap']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="updaterap" value="Cập nhật rạp">
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                ?>
            </div>

            <?php
            $raps = show_rap_all();
            if ($raps) {
                echo '<div class="product-table">';
                echo '<h2>Danh sách rạp</h2>';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Mã rạp</th>';
                echo '<th>Tên rạp</th>';
                echo '<th>Thao tác</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($raps as $rap) {
                    echo '<tr>';
                    echo '<td>' . $rap['id_rap'] . '</td>';
                    echo '<td>' . $rap['tenrap'] . '</td>';
                    
                    echo '<td>';
                    // Xóa
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="id_rap" value="' . $rap['id_rap'] . '">';
                    echo '<button type="submit" name="delete">Xóa</button>';
                    echo '</form>';


                    // Button Sửa
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="id_rap" value="' . $rap['id_rap'] . '">';
                    ?>
                    <button onclick="toggleEditProductForm(event)" name="edit" class="edit">Sửa</button>
                    <?php
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
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