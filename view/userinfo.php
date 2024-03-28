<head>
    <style>
.userlogin {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.userlogin h2 {
    font-size: 24px;
    margin-bottom: 10px;
}
.userlogin span {
    font-weight: bold;
    color: #3498db;
}
.userlogin a {
    text-decoration: none;
}

.bang {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.bang th, .bang td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.bang th {
    background-color: #f2f2f2;
}

.sub a {
    display: block;
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
}

#editProductForm {
    display: none;
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
}

#editProductForm h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

#editProductForm .form-group {
    margin-bottom: 20px;
}

#editProductForm label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #666;
}

#editProductForm input[type="text"], 
#editProductForm input[type="password"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

#editProductForm input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

#editProductForm input[type="submit"]:hover {
    background-color: #2980b9;
}

        </style>
</head>
<br>
<?php
if (isset ($_POST['updateruser'])) {
    $id_user = $_SESSION['id'];
    $pass = $_POST['pass'];
    
    update_user( $pass,$id_user);
    echo '<script>
    var result = confirm("Đã được cập nhật?");
    window.location.href = "../controller/index.php?c=userinfo";
    </script>';
}
?>
    <!--grids-sec1-->
    <section class="w3l-grids">
        <div class="grids-main py-5">
            <div class="container py-lg-3">
                <div class="headerhny-title">
                <div id="editProductForm" style="display: none;">              
                <h2>Sửa thông tin cá nhân</h2>
                <form method="post" action="" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="tk">Tài khoản: </label>
                        <input name="name" value="<?php echo $_SESSION['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="matkhau">Mật khẩu: </label>
                        <input type="password" name="pass" value="<?php echo str_repeat('*', strlen($_SESSION['password'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="updateruser" value="Cập nhật tài khoản">
                    </div>  
                </form>
                </div> 
                <?php
         if (isset($_SESSION['name'])) {
            $userId = $_SESSION['id']; 
        
            
            echo '  
            <div class="userlogin">
            <h2>Xin Chào: <span>' . $_SESSION['name'] . '</span></h2>

            <a href="../controller/index.php?c=lichsudonhang" style="color: red; font-weight: bold;">Lịch sử đặt vé</a>';
            echo '<table class="bang">
                <tr><th colspan="2">Thông Tin Tài Khoản</th></tr>
                <tr>
                        <th>Tên Đăng Nhập</th><br>
                        <th>Password</th><br>

                </tr>
                <tr>
                    <td>' . $_SESSION['username'] . '</td>
                    <td><input type=password value=' . str_repeat('*', strlen($_SESSION['password'])) . ' readonly /></td>
                </tr>
                <tr>
                
                <td class="sub"><center>
                <form method="post" action="">
                <a onclick="toggleEditProductForm()" name="edituser">Sửa</a></center>
                </form>
                </td>
                
                <td class="sub"><center><a href="../controller/index.php?c=logout">Đăng Xuất</a></center></td>
                </tr>
            </table> 
            </div>';
         }
            ?>
                </div>
                

            </div>
            <script>
    function toggleEditProductForm() {
        var editProductForm = document.getElementById('editProductForm');

        // Ẩn form sửa nếu đang hiển thị
        if (editProductForm.style.display === 'none') {
            editProductForm.style.display = 'block';
        } else {
            editProductForm.style.display = 'none';
        }
    }
</script>
