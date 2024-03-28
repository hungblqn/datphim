<?php
function show_ghe_all()
{
    $sql = "SELECT * FROM ghe";
    return pdo_query($sql);
}

function add_ghe($hang, $cot, $trangthai, $idrap){
    $sql = "INSERT INTO ghe (Hang, cot, trangthai, id_rap)  VALUES(?,?,?,?)";
     pdo_execute($sql, $hang, $cot, $trangthai, $idrap);
}
function get_ghe_by_id($id_ghe)
{
    $sql = "SELECT * FROM ghe WHERE id_ghe = ?";
    return pdo_query_one($sql, $id_ghe);
}

function update_ghe($hang, $cot, $trangthai, $idrap, $idghe)
{
    $sql = "UPDATE ghe SET Hang = ?, Cot = ?, Trangthai = ?, id_rap = ? WHERE id_ghe = ?";
    return pdo_execute($sql, $hang, $cot, $trangthai, $idrap, $idghe);

}

function delete_ghe($id_ghe)
{
    $sql = "DELETE FROM ghe WHERE id_ghe = ?";
    pdo_execute($sql, $id_ghe);
}
function kiem_tra_hang($hang, $id_rap) {
    $sql_hang_count = "SELECT COUNT(*) AS hang_count FROM ghe WHERE Hang=? AND id_rap=?";
    $result = pdo_query_one($sql_hang_count, $hang, $id_rap);
    $hang_count = $result['hang_count'];

    return $hang_count >= 10; 
}
function kiem_tra_cot($hang, $cot, $id_rap) {
    $sql_cot_count = "SELECT COUNT(*) AS cot_count FROM ghe WHERE Hang=? AND Cot=? AND id_rap=?";
    $result = pdo_query_one($sql_cot_count,$hang, $cot, $id_rap);
    $cot_count = $result['cot_count'];

    return $cot_count > 0; 
}
function kiem_tra_cot_edit($hang, $cot, $id_rap) {
    $sql_cot_count = "SELECT COUNT(*) AS cot_count FROM ghe WHERE Hang=? AND Cot=? AND id_rap=?";
    $result = pdo_query_one($sql_cot_count,$hang, $cot, $id_rap);
    $cot_count = $result['cot_count'];

    return $cot_count > 1; 
}
?>