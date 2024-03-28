<?php
function show_hoadon_all()
{
    $sql = "SELECT * FROM hoadon";
    return pdo_query($sql);
}
function hoadon_join_phim($id_hoadon)
{
    $sql = "SELECT * from hoadon join phim on hoadon.id_phim = phim.id_phim where hoadon.id_hoadon=?";
    return pdo_query($sql, $id_hoadon);
}
function hoadon_join_rap($id_hoadon)
{
    $sql = "SELECT * from hoadon join rap on hoadon.id_rap = rap.id_rap where hoadon.id_hoadon=?";
    return pdo_query($sql, $id_hoadon);
}
function hoadon_join_ghe($id_hoadon)
{
    $sql = "SELECT * from hoadon join ghe on hoadon.id_ghe = ghe.id_ghe where hoadon.id_hoadon=?";
    return pdo_query($sql, $id_hoadon);
}
?>