<?php

include_once('../model/Task.php');
include_once('../model/bdd.php');

$connexion = Bdd::connexion();

$tasks = []; // Vous pouvez charger les tâches à partir d'une source de données

function display_tasks_view($tasks) {

    global $connexion;
    // Utiliser Twig ici pour afficher les tâches

    $taskList = "<h1>LISTE DES TACHES</h1>";

    $stmt = $connexion->prepare("SELECT * FROM taches");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    foreach ($results as $row) {
        echo "ID: " . $row['tache_id'] . " - Description: " . $row['tache_description'] . "<br>";
    }

    foreach ($tasks as $task) {
        $taskList .= "<p>" . $task->getDescription() . "</p>";
    }

    return $taskList;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_description'])) {

    global $connexion;

    $newTask = new Task($_POST['task_description']);
    $tasks[] = $newTask;

    // Insérer la nouvelle tâche dans la base de données
    $stmt = $connexion->prepare("INSERT INTO taches(tache_description) VALUES (:description)");
    $stmt->bindParam(':description', $_POST['task_description']);
    $stmt->execute();

    echo "<script>window.location.href = 'index.php?page=getTaches';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

    <?php echo display_tasks_view($tasks); ?>

    <form method="post" action="">
        <label for="task_description">Nouvelle tâche :</label>
        <input type="text" name="task_description" required>
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
