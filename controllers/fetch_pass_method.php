<?php

require_once 'conn.php';

$sql = "SELECT * FROM pass_method";

$pass_arr = array();

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    array_push($pass_arr, $row);
};

echo json_encode($pass_arr);

?>