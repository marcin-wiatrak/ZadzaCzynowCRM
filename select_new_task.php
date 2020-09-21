<?php

require_once 'conn.php';

$select_clients_sql = "SELECT * FROM clients";
$select_payment_sql = "SELECT * FROM payment_method";
$select_finalize_sql = "SELECT * FROM pass_method";

$select_clients = mysqli_query($conn, $select_clients_sql);
$select_payment = mysqli_query($conn, $select_payment_sql);
$select_finalize = mysqli_query($conn, $select_finalize_sql);

$complete_array = [];
$clients_array = [];
$payment_array = [];
$finalize_array = [];

while($row = mysqli_fetch_assoc($select_clients)) {
    array_push($clients_array, $row);
};
while($row2 = mysqli_fetch_assoc($select_payment)) {
    array_push($payment_array, $row2);
};
while($row3 = mysqli_fetch_assoc($select_finalize)) {
    array_push($finalize_array, $row3);
};

array_push($complete_array, $clients_array);
array_push($complete_array, $payment_array);
array_push($complete_array, $finalize_array);

echo json_encode($complete_array);

?>