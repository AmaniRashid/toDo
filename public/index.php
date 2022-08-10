<?php

// including database connection
/** @var $pdo \PDO */
require_once '../database.php';

//getting the data from the database
$statement = $pdo->prepare('SELECT * FROM activity');
$statement->execute();
$activities = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once '../views/partials/header.php' ?>
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