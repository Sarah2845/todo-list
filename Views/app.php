<?php
include_once('../Controllers/ControllerTask.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Accueil</title>
</head>
<body>

    <h3 class="title"> TO-DO LIST APP </h3>

    <?php echo display_tasks_view($tasks); ?>

    <form class="form" method="post" action="../Controllers/ControllerTask.php" style="padding: 40px 0px;">
        <label for="task_description">Nouvelle tâche :</label>
        <input type="text" name="task_description" placeholder="Descritpion de la tâche" required>
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
