<?php 

require_once '../Models/Task.php';
include_once('../Models/bdd.php');

$connexion = Bdd::connexion();

$tasks = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_description'])) {

    insert_task($_POST['task_description']);
    echo "<script>window.location.href = 'http://todolist/Views/index.php';</script>";
}

function display_tasks_view($tasks) {

    $taskList = "<h1 class='top'>LISTE DES TACHES</h1>";

    // Afficher les résultats
    foreach (get_tasks() as $row) {
        $taskList .= "<form class='task-container' method='POST' action='../Controllers/ControllerTask.php'";
        $taskList .= "<div class='task-info'>";
        $taskList .= "<div class='description'> " . $row['tache_description'] . "</div>";
        $taskList .= "<div class='actions'>";
        $taskList .= "<a class='edit' href='details.php?id=" . $row['tache_id'] . "'>Voir</a> ";
        $taskList .= "<a class='edit' href='edit.php?id=" . $row['tache_id'] . "'>Modifier</a> ";
        $taskList .= "<a class='red' href='delete.php?id=" . $row['tache_id'] . "'>Supprimer</a>";
        $taskList .= "</div>";
        $taskList .= "</div>";
        $taskList .= "</form>";
    }

    return $taskList;
}

function get_tasks(){
    global $connexion;
    //recupere taches de la base de donnée
    $stmt = $connexion->prepare("SELECT * FROM taches");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function get_task_by_id($task_id) {
    global $connexion;

    $stmt = $connexion->prepare("SELECT * FROM taches WHERE tache_id = :id");
    $stmt->bindParam(':id', $task_id);

    $success = $stmt->execute();

    if ($success) {
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        return $task;
    } else {
        return false;
    }
}

function insert_task($description) {
    global $connexion;

    $newTask = new Task($description);
    $tasks[] = $newTask;

    // Insérer la nouvelle tâche dans la base de données
    $stmt = $connexion->prepare("INSERT INTO taches(tache_description) VALUES (:description)");
    $stmt->bindParam(':description', $_POST['task_description']);
    $stmt->execute();
}

function delete_task($task_id) {

    global $connexion;

    // Supprimer la tâche de la base de données
    $stmt = $connexion->prepare("DELETE FROM taches WHERE tache_id = :id");
    $stmt->bindParam(':id', $task_id);
    $stmt->execute();
    
}

function get_before_delete($task_id) {
    global $connexion;

    $stmt = $connexion->prepare("SELECT * FROM taches WHERE tache_id = :id");
    $stmt->bindParam(':id', $taskId);
    $stmt->execute();

    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    return $task;
}

function edit_data_post($taskId, $newDescription) {
    global $connexion;
    $stmt = $connexion->prepare("UPDATE taches SET tache_description = :description WHERE tache_id = :id");
    $stmt->bindParam(':description', $newDescription);
    $stmt->bindParam(':id', $taskId);
    $stmt->execute();
}

function edit_data_get($taskId) {
    global $connexion;
    $stmt = $connexion->prepare("SELECT * FROM taches WHERE tache_id = :id");
    $stmt->bindParam(':id', $taskId);
    $stmt->execute();
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    return $task;
}