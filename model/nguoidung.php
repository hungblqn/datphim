<?php

function show_nguoidung_all()
{
    $sql = "SELECT * FROM nguoidung";
    return pdo_query($sql);
}
function add_user($email,$password, $hoten){
    $sql = "INSERT INTO nguoidung (taikhoan, matkhau, hoten)  VALUES(?,?,?)";
     pdo_execute($sql, $email,$password, $hoten);
}

function update_user($pass, $iduser)
{
    $sql = "UPDATE nguoidung SET matkhau=? WHERE id_user = ?";
    return pdo_execute($sql, $pass, $iduser);

}

function delete_nguoidung($id_user)
{
    $sql = "DELETE FROM nguoidung WHERE id_user = ?";
    pdo_execute($sql, $id_user);
}
function checktrungtenuser($email){
    $sql = "SELECT taikhoan FROM nguoidung WHERE taikhoan=?";
    $result = pdo_query($sql, $email);
    return count($result) > 0;
}

function kiem_tra_ho_ten($ho_ten) {
    if (preg_match('/[0-9]/', $ho_ten)) {
        return false; 
    }
    return true;
}

function remove_extra_spaces($input_str) {
    // Sử dụng hàm trim để loại bỏ dấu khoảng cách ở đầu và cuối chuỗi
    $result_str = trim(preg_replace('/\s+/', ' ', $input_str));
    return $result_str;
}
?>