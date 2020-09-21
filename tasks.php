<?php

session_start();


if(!isset($_SESSION['login'])) {
        header("Location: index.php");
        exit();  
}

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="css/paginate.css">
    <link rel="stylesheet" href="css/style.css">
    <title>CRM</title>

</head>

<body>

    <div class="sidenav">
        <?php
            include ('layout/sidebar.php');
            ?>
    </div>

    <div class="main">

        <header>
            <h1 class="site-title">LISTA ZADAŃ</h1>
            <div class="right-menu">
                <input type="search" id="searchBox" placeholder="Wyszukaj...">
            </div>
        </header>

        <div class="divider"></div>

        <div class="task-counters-container">
            <div class="task-counter">
                <h3 class="task-counter-taskname">Nowe zadanie</h3>
                <span class="task-counter-count">36</span>
            </div>
            <div class="task-counter">
                <h3 class="task-counter-taskname">W trakcie realizacji</h3>
                <span class="task-counter-count">11</span>
            </div>
            <div class="task-counter">
                <h3 class="task-counter-taskname">Gotowe do odbioru</h3>
                <span class="task-counter-count">7</span>
            </div>
            <div class="task-counter">
                <h3 class="task-counter-taskname">Zakończone</h3>
                <span class="task-counter-count">270</span>
            </div>
            <div class="task-counter">
                <h3 class="task-counter-taskname">Problem/Błąd</h3>
                <span class="task-counter-count">2</span>
            </div>
        </div>

        <div class="divider"></div>

        <?php
            include ('view/task_list_table.php');
        ?>

    </div>
    <button class="task-new-panel-toggler"><i class="material-icons">add_circle</i></button>
    <div class="task-new-panel-right">

        <?php
                    include ('view/task_new_panel.php');
                ?>
    </div>
    <div class="task-edit-panel-right">

        <?php
                    include ('view/task_edit_panel.php');
                ?>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="script/paginate.js"></script>
    <script src="script/tasks.js"></script>
    <script src="script/main.js"></script>


</body>

</html>