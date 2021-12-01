<?php
include_once 'autoload.php';
include_once 'models/db.php';
$models = ["doctor", "inspection", "medicament", "patient", "recipe"];
$query = explode('&', $_SERVER['QUERY_STRING']);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v1.1">
    <script src="index.js?v1.0"></script>
    <title>D8</title>
</head>

<body>
    <header>
        <nav>
            <?php foreach ($models as $model) : ?>
                <a href=<?= 'index?' . $model ?>><?= ucfirst($model) ?></a>
            <?php endforeach ?>
            <div class="vl"></div>
            <div class="editor">
                <a href=<?= "index?$query[0]&" . 'add' ?>>Add</a>
                <a class="edit blocked" href=<?= "index?$query[0]&" . 'edit' ?>>Edit</a>
                <a class="delete blocked" href=<?= "index?$query[0]&" . 'delete' ?>>Delete</a>
                <input class="input-id" type="number" placeholder="Enter id">
            </div>
        </nav>
    </header>
    <main>
        <?php
        //Actions
        if (count($_POST)) {
            require "./actions/actionManager.php";
        }
        //Templates
        if (isset($query[1]) && file_exists("./templates/forms/$query[0].php")) { // Forms
            echo "<h2>$query[1] $query[0]</h2>";

            require "./templates/forms/$query[0].php";
        } else if (file_exists("./templates/$query[0].php")) { // Tables
            echo "<h2>SELECTED $query[0] </h2>";
            require "./templates/$query[0].php";
        } else {
            echo "<h2>Table not found</h2>"; // Other
        }
        ?>
    </main>
</body>

</html>