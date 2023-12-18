<?php
include_once('../Controllers/ControllerTask.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
</head>

<body>
    <div class="container">
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $taskId = $_POST['id'];
            $newDescription = $_POST['task_description'];

            // Mettre à jour la description de la tâche dans la base de données
            edit_data_post($taskId, $newDescription);

            echo "<h1>Tâche mise à jour avec succès</h1>";
            echo "<p><a href='view.php'>Retour à la liste des tâches</a></p>";
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

            // Récupérer les informations de la tâche à modifier
            $task = edit_data_get($_GET['id']);

            if ($task) {
                // Afficher le formulaire de modification
                echo "<h1>Modifier la tâche</h1>";
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='id' value='" . $task['tache_id'] . "'>";
                echo "<label for='task_description'>Description :</label>";
                echo "<input type='text' name='task_description' value='" . $task['tache_description'] . "' required>";
                echo "<button type='submit'>Enregistrer les modifications</button>";
                echo "</form>";
                edit_data_post($task['tache_id'], $task['tache_description']);
            } else {
                echo "<h1>Tâche non trouvée</h1>";
            }
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

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    a {
        text-decoration: none;
        color: #dc3545;
    }

    a:hover {
        text-decoration: underline;
    }
</style>