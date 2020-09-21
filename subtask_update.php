<?php

require_once 'conn.php';

$subtask_id = $_POST['subtask_id'];
$subtask_status = $_POST['subtask_status'];

if($subtask_status){
    $subtask_status = 0;
} else {
    $subtask_status = 1;
}

$subtask_update_sql = "UPDATE subtasks SET done='$subtask_status' WHERE id='$subtask_id'";

$status_update = mysqli_query($conn, $subtask_update_sql);
// echo $subtask_id;
echo $subtask_status;

?>