<?php

require_once 'conn.php';

$task_sql = 
"SELECT
t.*,
t_s.status_name, t_s.status_color,
pay_m.payment_method_name, pay_m.payment_method_color,
pass_m.pass_method_name, pass_m.pass_method_color,
cl.first_name, cl.last_name, cl.company_name, cl.nip, cl.email_adress, cl.phone_number, cl.allegro_nickname,


GROUP_CONCAT(DISTINCT sub_t.id, '^', sub_t.done, '^', sub_t.subtask_name SEPARATOR ';') as subtask_list


FROM tasks t

LEFT JOIN task_status t_s ON t.task_status = t_s.id
LEFT JOIN payment_method pay_m ON t.payment_method = pay_m.id
LEFT JOIN pass_method pass_m ON t.pass_method = pass_m.id
LEFT JOIN clients cl ON t.task_client = cl.id
LEFT JOIN subtasks sub_t ON t.id = sub_t.task_id GROUP BY t.id

ORDER BY t.id DESC";


$staff_sql = "SELECT * FROM users";
$status_sql = "SELECT * FROM task_status";




$tasks_arr = array();
$task_result = mysqli_query($conn, $task_sql);
while($row = mysqli_fetch_assoc($task_result)) {
    array_push($tasks_arr, $row);
};

$staff_arr = array();
$staff_result = mysqli_query($conn, $staff_sql);
while($row2 = mysqli_fetch_assoc($staff_result)) {
    array_push($staff_arr, $row2);
};

$status_arr = array();
$status_result = mysqli_query($conn, $status_sql);
while($row3 = mysqli_fetch_assoc($status_result)) {
    array_push($status_arr, $row3);
};

$output_arr = array();
array_push($output_arr, $tasks_arr);
array_push($output_arr, $staff_arr);
array_push($output_arr, $status_arr);

echo json_encode($output_arr);

?>