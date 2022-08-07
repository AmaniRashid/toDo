<?php

// including database connection
/** @var $pdo \PDO */
require_once '../database.php';

//getting the data from the database
$statement = $pdo->prepare('SELECT * FROM activity');
$statement->execute();
$activities = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <body class="container text-center">
        <h1 class="m-5 text-center">Event Tracker</h1>
        <a href="create.php" class="btn btn-success">Add Event</a>
        <div class="row justify-content-center">
        <?php foreach ($activities as $i => $activity): ?>
            <div class="card text-center m-2 " style="width: 18rem;" >
                <div class="card-body">
                    <h5 class="card-title"><?php echo $activity['title'] ?></h5>
                    <p class="card-text">Deadline: <?php echo $activity['deadline'] ?></p>
                    <p class="card-text">Description: <?php echo $activity['description'] ?></p>
                    <p class="card-text">completed: <?php echo $activity['completed'] ?></p>
                    <div>

                        <a href="update.php?id=<?php echo $activity['id'] ?>" class="btn btn-sm btn-primary
                        m-1">update</a>
                        <form action="delete.php" method="POST" style="display:inline-block" class="m-1">
                            <input  type="hidden" name="id" value="<?php echo $activity['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </body>

</html>