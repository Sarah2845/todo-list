<?php
include_once('../Controllers/ControllerTask.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Task Confirmation</title>
</head>

<body>
    <div class="container">
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            
            delete_task($_POST['id']);

            echo "<h1>Tâche supprimée avec succès</h1>";
            echo "<p><a href='http://todolist/Views/app.php'>Retour à la liste des tâches</a></p>";

        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            
            delete_task($_GET['id']);
            echo "<p><a href='http://todolist/Views/app.php'>Retour à la liste des tâches</a></p>";
        } else {
            echo "<h1>Paramètre ID manquant</h1>";
        }
        ?>
    </div>
</body>

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .container {
        max-width: 600px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        text-align: center;
        /* Center text inside the container */
    }

    h1 {
        color: #333;
    }

    p {
        margin-bottom: 20px;
    }

    form {
        display: inline-block;
    }

    button {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c82333;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }
</style>