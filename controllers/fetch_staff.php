<?php

require_once 'conn.php';

$select_users_sql = "SELECT * FROM users";

$select_users = mysqli_query($conn, $select_users_sql);

$clients_array = [];
while($row = mysqli_fetch_assoc($select_users)) {
    array_push($clients_array, $row);
};

echo json_encode($clients_array);

?>