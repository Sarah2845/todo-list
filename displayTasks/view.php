<?php

include_once('../model/Task.php');
include_once('../model/bdd.php');

$connexion = Bdd::connexion();

$tasks = []; // Vous pouvez charger les tâches à partir d'une source de données

function display_tasks_view($tasks) {

    global $connexion;
    // Utiliser Twig ici pour afficher les tâches

    $taskList = "<h1 class='top'>LISTE DES TACHES</h1>";

    $stmt = $connexion->prepare("SELECT * FROM taches");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    foreach ($results as $row) {
        $taskList .= "<div class='task-container'>";
        $taskList .= "<div class='task-info'>";
        $taskList .= "<div class='description'> " . $row['tache_description'] . "</div>";
        $taskList .= "<div class='actions'>";
        $taskList .= "<a class='edit' href='edit.php?id=" . $row['tache_id'] . "'>Modifier</a> ";
        $taskList .= "<a class='red' href='delete.php?id=" . $row['tache_id'] . "'>Supprimer</a>";
        $taskList .= "</div>";
        $taskList .= "</div>";
        $taskList .= "</div>";
    }

    foreach ($tasks as $task) {
        $taskList .= "<div class='task-container'>";
        $taskList .= "<div class='task-info'>";
        $taskList .= "<div class='description'> " . $task->getDescription() . "</div>";
        $taskList .= "<div class='actions'>";
        $taskList .= "<a href='edit.php?id=" . $task->getId() . "'>Modifier</a> ";
        $taskList .= "<a href='delete.php?id=" . $task->getId() . "'>Supprimer</a>";
        $taskList .= "</div>";
        $taskList .= "</div>";
        $taskList .= "</div>";
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

    echo "<script>window.location.href = 'view.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Accueil</title>
</head>
<body>

    <h3 class="title"> TO-DO LIST APP </h3>

    <?php echo display_tasks_view($tasks); ?>

    <form method="post" action="" style="padding: 40px 0px;">
        <label for="task_description">Nouvelle tâche :</label>
        <input type="text" name="task_description" placeholder="Descritpion de la tâche" required>
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
