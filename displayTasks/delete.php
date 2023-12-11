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
        include_once('../model/bdd.php');
        $connexion = Bdd::connexion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $taskId = $_POST['id'];

            // Supprimer la tâche de la base de données
            $stmt = $connexion->prepare("DELETE FROM taches WHERE tache_id = :id");
            $stmt->bindParam(':id', $taskId);
            $stmt->execute();

            echo "<h1>Tâche supprimée avec succès</h1>";
            echo "<p><a href='view.php'>Retour à la liste des tâches</a></p>";
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $taskId = $_GET['id'];

            // Récupérer les informations de la tâche à supprimer
            $stmt = $connexion->prepare("SELECT * FROM taches WHERE tache_id = :id");
            $stmt->bindParam(':id', $taskId);
            $stmt->execute();
            $task = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($task) {
                // Afficher la confirmation de suppression
                echo "<h1>Supprimer la tâche</h1>";
                echo "<p>Êtes-vous sûr de vouloir supprimer la tâche : " . $task['tache_description'] . " ?</p>";
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='id' value='" . $task['tache_id'] . "'>";
                echo "<button type='submit'>Confirmer la suppression</button>";
                echo "</form>";
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