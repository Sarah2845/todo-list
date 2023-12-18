<?php
include_once('../Controllers/ControllerTask.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Task</title>
</head>

<body>
    <div class="container">
    <?php

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Obtenez les détails de la tâche par ID
            $task = get_task_by_id($_GET['id']);

            if ($task !== false) {
                // Afficher les détails de la tâche dans le HTML
                echo '<body>
                        <div class="container">
                            <h1>Details de la tâche</h1>
                            <p>ID: ' . $task['tache_id'] . '</p>
                            <p>Description: ' . $task['tache_description'] . '</p>
                        </div>
                    </body>';
            } else {
                // Gérer le cas où la tâche n'est pas trouvée
                echo '<body>
                        <div class="container">
                            <p>La tâche demandée n\'existe pas.</p>
                        </div>
                    </body>';
            }
        } else {
            // Gérer le cas où l'ID n'est pas défini ou est vide
            echo '<body>
                    <div class="container">
                        <p>ID de tâche non spécifié.</p>
                    </div>
                </body>';
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