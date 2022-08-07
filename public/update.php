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

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>ToDo List</title>
</head>
<body class="container">
<h1 class="m-3"> Update Event <b> <?php echo $activity['title'] ?> </b> </h1>

<?php  if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<form method="POST" action="">
    <div class="form-group m-2">
        <label >Event Title</label>
        <input type="text" name="event" class="form-control" placeholder="" value="<?php echo $event ?>">
    </div>
    <div class="form-group m-2">
        <label >Description</label>
        <textarea  name="description" class="form-control" placeholder="" value="<?php echo $description
        ?>"> </textarea>
    </div>
    <div class="form-group m-2">
        <label >Deadline</label>
        <input type="datetime-local" name="deadline" class="form-control" placeholder="<?php echo $deadline
        ?>" value="">
    </div>
    <div class="form-group m-2">
        <label >Completed</label>
        <input type="checkbox" name="completed" class="form-control" placeholder="" value="<?php echo $completed ?>">
    </div>

    <button type="submit" class="btn btn-primary">submit</button>
</form>
</body>
</html>
