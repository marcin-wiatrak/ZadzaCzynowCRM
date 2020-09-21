<?php

require_once 'conn.php';

$sql = "SELECT * FROM payment_method";

$payment_arr = array();

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    array_push($payment_arr, $row);
};

echo json_encode($payment_arr);

?>