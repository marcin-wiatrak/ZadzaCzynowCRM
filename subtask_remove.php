<?php

require_once 'conn.php';

$subtask_id = $_POST['subtask_id'];


$subtask_remove_sql = "DELETE FROM subtasks WHERE id = '$subtask_id'";

$status_update = mysqli_query($conn, $subtask_remove_sql);
// echo $subtask_id;
echo $subtask_status;

?>