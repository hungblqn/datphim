<?php
if(isset($_POST['addghe'])){
    $hang = $_POST['hang'];
    $cot = $_POST['cot'];
    $trangthai = $_POST['trangthai'];
    $idrap = $_POST['rap'];
    $kiemtracot = kiem_tra_cot($hang, $cot, $idrap);
    $kiemtrahang = kiem_tra_hang($hang, $idrap);
    if(!$kiemtrahang && !$kiemtracot){
        if($hang != null && $cot != null && $trangthai != null && $idrap != null){
            if($cot > 0 && $cot < 11){
                add_ghe($hang, $cot,  $trangthai , $idrap);
                header("Location: ../controller/indexadmin.php?c=qlghe");
                exit;
            }else{
                echo "<script>alert('Cột có giá trị >0 và <11')</script>";
            }
        }
    } else {
        if($kiemtrahang){
            echo "<script>alert('Hàng đã đủ (không quá 10)')</script>";
        }elseif($kiemtracot){
            echo "<script>alert('Cột đã đủ (không quá 10) hoặc nhập nhỏ hơn 1 và lớn hơn 10')</script>";
        }
    }
}

if(isset($_POST['updateghe'])){
    $idghe = $_POST['id_ghe'];
    $hang = $_POST['hang'];
    $cot = $_POST['cot'];
    $trangthai = $_POST['trangthai'];
    $idrap = $_POST['rap'];

    $kiemtracot = kiem_tra_cot($hang, $cot, $idrap);
    $kiemtrahang = kiem_tra_hang($hang, $idrap);
    $ktracot = kiem_tra_cot_edit($hang, $cot, $idrap);
    $id_ghe = $_POST['id_ghe'];
    $ghe = get_ghe_by_id($id_ghe);
    if($hang == $ghe['Hang'] && $cot == $ghe['Cot'] && $trangthai == $ghe['Trangthai'] && $idrap == $ghe['id_rap'] ){
            echo "<script>alert('Chưa thay đổi gì')</script>";
    }elseif($hang == $ghe['Hang'] && $cot == $ghe['Cot'] && ($trangthai != null || $idrap != null)){
        if(!$ktracot){
            if($cot > 0 && $cot < 11){
                update_ghe($hang, $cot,  $trangthai , $idrap, $idghe);
                header("Location: ../controller/indexadmin.php?c=qlghe");
                exit;
            }else{
                echo "<script>alert('Không')</script>";
            }
        }
    }
    if(!$kiemtrahang && !$kiemtracot){
        if($hang != null && $cot != null && $trangthai != null && $idrap != null ){
            if($cot > 0 && $cot < 11){
                update_ghe($hang, $cot,  $trangthai , $idrap, $idghe);
                header("Location: ../controller/indexadmin.php?c=qlghe");
                exit;
            }else{
                echo "<script>alert('Cột có giá trị >0 và <11')</script>";
            }
        }
    } else {
        if($kiemtrahang){
            echo "<script>alert('Hàng đã đủ (không quá 10)')</script>";
        }elseif($kiemtracot){
            echo "<script>alert('Cột đã đủ (không quá 10) hoặc nhập nhỏ hơn 1 và lớn hơn 10')</script>";
        }
    }
}

if (isset ($_POST['delete'])) {
    $id_ghe = $_POST['id_ghe'];
    echo '<script>
            var result = confirm("Bạn có chắc xóa ghế này chứ?");
            if (result) {
                window.location.href = "../controller/indexadmin.php?c=qlghe&id_ghe=' . $id_ghe . '&y_delete";
            } else {
                window.location.href = "../controller/indexadmin.php?c=qlghe";
            }
          </script>';
    exit();
}
if (isset ($_GET['y_delete'])) {
    $id_ghe = $_GET['id_ghe'] ?? null; 
    if ($id_ghe !== null) {
        delete_ghe($id_ghe);
        header("Location: ../controller/indexadmin.php?c=qlghe"); 
    }
    exit();
}
?>
<main>
        <h2>Quản lý Ghế</h2>
        <div class="product-form-container">
            <button type="button" id="addProductButton" onclick="toggleAddProductForm()">Thêm Ghế Mới</button>
            <div class="product-form" id="addProductForm" style="display: none;">

                <h2>Thêm Ghế Mới</h2>
                <form method="post" action="" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="hang">Hàng: </label>
                        <input type="text" name="hang" required>
                    </div>
                    <div class="form-group">
                        <label for="cot">Cột:</label>
                        <input type="text" name="cot" required>
                    </div>
                    <div class="form-group">
                        <label for="trangthai">Trạng thái:</label>
                        <select name="trangthai">
                            <option value="0">Tốt</option>
                            <option value="1">Bảo trì/ sửa chữa</option>

                        </select>
                    </div>
                    <div class="form-group">
                    <label for="tenrap">Chọn rạp: </label>
                    <select name="rap">
                    <?php
                    $check_rap = show_rap_all();
                    if($check_rap){
                        foreach($check_rap as $rap){
                            extract($rap);
                            echo ' <option value='.$id_rap.'>'.$tenrap.'</option>';
                        }
                    }
                    ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addghe" value="Thêm ghế">
                    </div>
                </form>
            </div>
            <div class="product-form edit-form" id="editProductForm" style="display: hide;">
                <?php
                if (isset($_POST['edit'])) {
                    $id_ghe = $_POST['id_ghe'];
                    $ghe = get_ghe_by_id($id_ghe);
                        ?>
                        
                            <h2>Sửa thông tin Phim</h2>
                            <form method="post" action="" accept-charset="UTF-8">
                                <input type="hidden" name="id_ghe" value="<?php echo $ghe['id_ghe']; ?>">
                                <div class="form-group">
                                    <label for="hang">Hàng: </label>
                                    <input type="text" name="hang" value="<?php echo $ghe['Hang']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="cot">Cột: </label>
                                    <input type="text" name="cot" value="<?php echo $ghe['Cot']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="trangthai">Trạng thái:</label>
                                    <select name="trangthai">
                                    <?php    
                                    if($ghe['Trangthai'] == 0){
                                        echo '<option value="0">Tốt</option>';
                                        echo '<option value="1">Bảo trì/ sửa chữa</option>';

                                    }else{
                                        echo '<option value="1">Bảo trì/ sửa chữa</option>';
                                        echo '<option value="0">Tốt</option>';
                                    }
                                    ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                <label for="rap">Rạp:</label>
                                <select name="rap" required>
                                    <?php
                                    $check_rap = show_rap_all();
                                    if($check_rap){
                                        foreach($check_rap as $rap){
                                            extract($rap);
                                            if ($id_rap == $ghe['id_rap']) {
                                                echo '<option value="'.$id_rap.'" selected>'.$tenrap.'</option>';
                                            } else {
                                                // Hiển thị các id_rap khác
                                                echo '<option value="'.$id_rap.'">'.$tenrap.'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                                <div class="form-group">
                                    <input type="submit" name="updateghe" value="Cập nhật ghế">
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                ?>
            </div>

            <?php
            $ghes = show_ghe_all();
            if ($ghes) {
                echo '<div class="product-table">';
                echo '<h2>Danh sách ghế</h2>';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Hàng</th>';
                echo '<th>Cột</th>';
                echo '<th>Trạng thái</th>';
                echo '<th>Rạp</th>';
                echo '<th>Thao tác</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($ghes as $ghe) {
                    echo '<tr>';
                    echo '<td>' . $ghe['Hang'] . '</td>';
                    echo '<td>' . $ghe['Cot'] . '</td>';
                    echo '<td>' . $ghe['Trangthai'];
                    echo '<td>' . $ghe['id_rap'] . '</td>';
                    echo '<td>';
                    // Xóa
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="id_ghe" value="' . $ghe['id_ghe'] . '">';
                    echo '<button type="submit" name="delete">Xóa</button>';
                    echo '</form>';


                    // Button Sửa
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="id_ghe" value="' . $ghe['id_ghe'] . '">';
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