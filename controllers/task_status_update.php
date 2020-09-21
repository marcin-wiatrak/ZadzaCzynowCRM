<?php

require_once 'conn.php';

$task_id = $_POST['task_id'];
$new_status_id = $_POST['new_status_id'];

$task_status_update_sql = "UPDATE tasks SET task_status='$new_status_id' WHERE id='$task_id'";

$status_update = mysqli_query($conn, $task_status_update_sql);

?>