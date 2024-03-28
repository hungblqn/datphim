<?php

function show_film_all()
{
    $sql = "SELECT * FROM phim";
    return pdo_query($sql);
}
function phim_insert($tenphim, $gia, $id_rap, $thoiluongphim, $doituong, $anh, $mota)
{
    $sql = "INSERT INTO phim( tenphim, gia, id_rap, thoiluongphim, doituong, anh, mota) VALUES( ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $tenphim, $gia, $id_rap, $thoiluongphim, $doituong, $anh, $mota);
}
function delete_phim($id_phim)
{
    $sql = "DELETE FROM phim WHERE id_phim = ?";
    pdo_execute($sql, $id_phim);
}
function get_phim_by_id($id_phim)
{
    $sql = "SELECT * FROM phim WHERE id_phim = ?";
    return pdo_query_one($sql, $id_phim);
}
function update_phim($id_phim, $tenphim, $gia, $id_rap, $thoiluongphim, $doituong, $anh, $mota)
{
    $sql = "UPDATE phim SET tenphim = ?, gia = ?, id_rap = ?, thoiluongphim = ?, doituong = ?, anh=?, mota=? WHERE id_phim = ?";
    pdo_execute($sql, $tenphim, $gia, $id_rap, $thoiluongphim, $doituong, $anh, $mota, $id_phim);

    // Fetch the updated product details from the database
    $updatedProduct = get_phim_by_id($id_phim);
    return $updatedProduct;
}
?>