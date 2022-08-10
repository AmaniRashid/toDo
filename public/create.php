<?php
// including database connection
/** @var $pdo \PDO */
require_once '../database.php';


$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $event = $_POST['event'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $completed = $_POST['completed'];


    if(!$event){
        $errors[] = "Event name is required";
    }
    if(!$deadline){
        $errors[]= "Deadline is required";
    }
    if(empty($errors)){
        $statement =  $pdo->prepare(
            "INSERT INTO `activity`(title, deadline, completed, description) 
                VALUES ( :event, :deadline, :completed, :description) ");


        $statement->bindValue(':event', $event);
        $statement->bindValue(':deadline', $deadline);
        $statement->bindValue(':completed', $completed);
        $statement->bindValue(':description', $description);
        $statement->execute();
        header('location: index.php');
    }

}

?>

<?php include_once '../views/partials/header.php' ?>
<body class="container">
    <h1 class="m-3"> Add Event</h1>
    <?php include_once '../views/events/form.php' ?>
</body>
</html>
