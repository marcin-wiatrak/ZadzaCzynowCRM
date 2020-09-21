<?php

require_once 'conn.php';

$newTaskName = $_POST['new-task-name'];

$newTaskClientId = $_POST['clientId'];
$newTaskOrderedby = $_POST['new-task-orderedby'];
$newTaskAssignedStaff = $_POST['new-task-assigned_staff'];
$newTaskPriority = $_POST['new-task-priority'];
$newTaskPayment = $_POST['paymentMethod'];
$newTaskFinalize = $_POST['finalization'];
$newTaskRealisationDate = $_POST['new-task-realisation-date'];
$newTaskNote = $_POST['new-task-note'];


$assignedStaff = array();

// if($_POST):
//     foreach($_POST['new-task-assigned_staff'] as $val)
//     {
//     echo $val . "<br>";
//     }
//     endif;


$assignedStaff = implode(',', $newTaskAssignedStaff);
$nowDate = date('Y-m-d');

$sql = "INSERT INTO tasks (id, task_name, task_client, task_orderedby, task_create_date, assigned_staff, task_status, task_priority, payment_method, pass_method, task_note, task_realisation_date)
VALUES ('', '$newTaskName', '$newTaskClientId', '$newTaskOrderedby', '$nowDate', '$assignedStaff', '1', '$newTaskPriority', '$newTaskPayment', '$newTaskFinalize', '$newTaskNote', '$newTaskRealisationDate')";

$result = mysqli_query($conn, $sql);


// print_r $newTaskClientId[0];
print_r($_POST);
// echo $assignedStaff;

?>









