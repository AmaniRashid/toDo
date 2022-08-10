<?php
// including database connection
/** @var $pdo \PDO */
require_once '../database.php';


$id = $_GET['id'] ?? null;

if(!$id){
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare("SELECT * FROM `activity` WHERE `id` = :id ");
$statement->bindValue(':id', $id);
$statement->execute();
$activity = $statement->fetch(PDO::FETCH_ASSOC);


$event = $activity['title'];
$description = $activity['description'];
$deadline = $activity['deadline'];
$completed = $activity['completed'];
$errors = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_GET['id'];
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
            "UPDATE `activity` 
                        SET title = :event, deadline = :deadline, completed = :completed, description =:description 
                    WHERE id = :id;
                   ");


        $statement->bindValue(':event', $event);
        $statement->bindValue(':deadline', $deadline);
        $statement->bindValue(':completed', $completed);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header('location: index.php');
    }

}

?>

<?php include_once '../views/partials/header.php' ?>
<body class="container">
<h1 class="m-3"> Update Event <b> <?php echo $activity['title'] ?> </b> </h1>
<?php include_once '../views/events/form.php' ?>
</body>
</html>
