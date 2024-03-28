<?php
function login($username, $password) {
    $sql = "SELECT * FROM nguoidung WHERE taikhoan=? and matkhau=?  ";
    return pdo_query($sql, $username, $password);
}

?>