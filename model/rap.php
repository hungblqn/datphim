<?php
function show_rap_all()
{
    $sql = "SELECT * FROM rap";
    return pdo_query($sql);
}

function add_rap($ten){
    $sql = "INSERT INTO rap (tenrap)  VALUES(?)";
     pdo_execute($sql, $ten);
}

function update_rap($ten, $idrap)
{
    $sql = "UPDATE rap SET tenrap=? WHERE id_rap = ?";
    return pdo_execute($sql, $ten, $idrap);

}

function delete_rap($id_rap)
{
    $sql = "DELETE FROM rap WHERE id_rap = ?";
    pdo_execute($sql, $id_rap);
}
function get_rap_by_id($id_rap)
{
    $sql = "SELECT * FROM rap WHERE id_rap = ?";
    return pdo_query_one($sql, $id_rap);
}
function kiem_tra_trung($ten) {
    $sql_hang_count = "SELECT COUNT(*) AS hang_count FROM rap WHERE tenrap=?";
    $result = pdo_query_one($sql_hang_count, $ten);
    $hang_count = $result['hang_count'];

    return $hang_count > 0; 
}
?>