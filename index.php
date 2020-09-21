<?php

session_start();

$password = "12345";

if(isset($_SESSION['login'])) {
    if($_SESSION['login'] == "logged") {
        header("Location: tasks.php");
        exit();
    }
}

if(isset($_POST['password'])) {
    if($_POST['password'] == $password) {
        $_SESSION['login'] = "logged";
        header("Location: tasks.php");
        exit();
    } else {
    echo "Błędne hasło";
    }
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/style.css">
    <title>CRM</title>

</head>

<body>

    
    <div class="login-panel">
        <div>
            <h1>Zaloguj się</h1>
            <h2>Podaj hasło dostępu:</h2>
        </div>
        <div class="login-panel-form">
            <form action="" method="POST">        
                <input type="password" name="password" id="login-panel-password" placeholder="Podaj hasło">
                <button type="submit">Zaloguj się</button>
            </form>
        </div>
    </div>
        
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script/main.js"></script>
        
        
</body>
    
</html>