<?php

require_once 'conn.php';

$taskId = $_POST['task_id'];

$sql = "DELETE FROM tasks WHERE id='$taskId'";

$result = mysqli_query($conn, $sql);

echo $taskId

?>









