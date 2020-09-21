<?php

require_once 'conn.php';

$output = '';
$sql = 
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
LEFT JOIN  ON t.task_client = cl.id
LEFT JOIN subtasks sub_t ON t.id = sub_t.task_id GROUP BY t.id


WHERE t.task_name LIKE '%ne%'
ORDER BY t.id DESC";


$users = "SELECT * FROM users";
$users = $conn->query($users);
$users_array = array();
if($users -> num_rows >0) {
  while($users_row = $users->fetch_assoc()) {
    array_push($users_array, $users_row);
  }
}


$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $assigned_staff = explode(',' , $row['assigned_staff']);

        $output .=
        '<tr class="task-row" data-id="'. $row['id'] .'">' .
        '<td class="task-name">
            <i class="material-icons expand-arrow">double_arrow</i>
            <div class="task-name-container">
                <span class="task-name-span">#' . $row['id'] . ' - ' . $row['task_name'] . '</span>
                <span class="task-name-client">#' . $row['task_client'] . ' ' . $row['first_name'] . ' ' . $row['last_name'] . ' (' . $row['company_name'] . ')</span>
            <div>
        </td>' .
        '<td>' . $row['task_create_date'] . '</td>' .
        '<td>' . '</td>' .
        '<td>';

        foreach($assigned_staff as $user) {
            if($user === "") {
                $output .= "";
            } else {
                $key = array_search($user, array_column($users_array, 'id'));
                $output .= $users_array[$key]['user_initials'] . ' ';
            }
        }
        
        $output .= '</td>' .
        '<td>' . $row['task_orderedby'] . '</td>' .
        '<td style="color:#' . $row['status_color'] . '">' . $row['status_name'] . '</td>' .
        '<td>' . $row['task_note'] . '</td>' .
        '<td></td>' .
        
        
        '</tr>';

        $output .= '<tr class="expandable-row" data-id-expand="' . $row['id'] . '">
        <td colspan="8">
        <div class="container-fluid">
        <div class="row">
            <div class="col-4 expanded-row-column">
                
                <div class="row">
                    <div class="col-6">
                        <h5>Metoda płatności: </h5>
                    </div>
                    <div class="col-6">
                        <h6>'.$row['payment_method_name'].'</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>Finalizacja: </h5>
                    </div>
                    <div class="col-6">
                        <h6>'.$row['pass_method_name'].'</h6>
                    </div>
                </div>
            
            
                
                <div class="row">
                    <div class="col-6">
                        <h5>Faktura: </h5>
                    </div>
                    <div class="col-6">
                        <h6>'.$row['payment_method_name'].'</h6>
                    </div>
                </div>';

            if( $row['allegro_nickname'] !== "") {
                $output .=
                    '<div class="row">
                        <div class="col-6">
                            <img src="assets/img/allegro_logo.svg" alt="Allegro" class="allegro-logo">
                        </div>
                        <div class="col-6">
                            <h6>'.$row['allegro_nickname'].'</h6>
                        </div>
                    </div>';

            };
            $output .=
            '</div>
            <div class="col-4 expanded-row-column">
                
                <div class="row">
                    <div class="col-6">
                        <h5>Metoda płatności: </h5>
                    </div>
                    <div class="col-6">
                        <h6>'.$row['payment_method_name'].'</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>Finalizacja: </h5>
                    </div>
                    <div class="col-6">
                        <h6>'.$row['pass_method_name'].'</h6>
                    </div>
                </div>
            </div>
            <div class="col-4 expanded-row-column">
                
                <div class="row">
                    <ul class="subtasks-list">';
        
        if ($row['subtask_list']) {
        $subtasks_array = explode(';', $row['subtask_list']);
        
        foreach($subtasks_array as $subtask) {
            $subtask = explode('^', $subtask);
            $output .= '<li data-sub-id="'.$subtask[0].'" data-subtask-done='.$subtask[1].' class="subtasks-list-item';
            if ($subtask[1]) {
                $output .= " subtasks-list-item-done";
            }
            $output .= '"><span class="subtask-title">'.$subtask[2].'</span><div><i class="material-icons subtask-done">check_circle_outline</i><i class="material-icons subtask-remove">highlight_off</i><div></li>';
        }
        } else {
            $output .= '<li class="subtasks-list-item">Brak zadań</li>';
        }
    
    // print_r($row);

        $output .= '
                        <input type="text" placeholder="Dodaj podzadanie" data-task-id="'.$row['id'].'" class="add-new-subtask">
                    </ul>
                </div>
            </div>

        </div>
        </div>
        </td>
         </tr>';
        // echo '<pre>';
        // echo json_encode($row);
        // echo '</pre>';
        
    }
}
echo json_encode($row);

// echo $output;

//  print_r ($row);


?>