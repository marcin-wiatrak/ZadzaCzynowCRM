<?php

require_once 'conn.php';

$select_clients_sql = "SELECT * FROM clients";

$select_clients = mysqli_query($conn, $select_clients_sql);

$clients_array = array();
while($row = mysqli_fetch_assoc($select_clients)) {
    array_push($clients_array, $row);
};

echo json_encode($clients_array);

?>