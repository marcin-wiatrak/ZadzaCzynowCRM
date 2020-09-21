<?php

require_once 'conn.php';

$clientCompanyName = $_POST['new-client-company-name'];
$clientFirstName = $_POST['new-client-first-name'];
$clientLastName = $_POST['new-client-last-name'];
$clientNip = $_POST['new-client-nip'];
$clientCompanyEmail = $_POST['new-client-email'];
$clientCompanyPhoneNumber = $_POST['new-client-phone-number'];
$clientCompanyAllegroNickname = $_POST['new-client-allegro-nickname'];


$sql = "INSERT INTO clients (id, company_name, first_name, last_name, nip, email_adress, phone_number, allegro_nickname) VALUES ('', '$clientCompanyName', '$clientFirstName', '$clientLastName', '$clientNip', '$clientCompanyEmail', '$clientCompanyPhoneNumber', '$clientCompanyAllegroNickname')";

$result = mysqli_query($conn, $sql);

?>