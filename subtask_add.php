<?php

require_once 'conn.php';

$new_subtask_id = $_POST['newSubtaskId'];
$new_subtask = $_POST['newSubtask'];

$subtask_add_sql = "INSERT INTO subtasks (task_id, subtask_name, assigned_user, done) VALUES ('$new_subtask_id', '$new_subtask', '0', '0')";

$status_update = mysqli_query($conn, $subtask_add_sql);

?>