<?php

require_once 'conn.php';

    $taskToEdit = $_POST['taskToEdit'];

    $sql = "SELECT * FROM tasks WHERE id='$taskToEdit'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);