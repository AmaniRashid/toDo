<?php
// including database connection
/** @var $pdo \PDO */
require_once '../database.php';

$id = $_POST['id'] ?? null;
print_r($id);
if(!$id){
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare("DELETE FROM `activity` WHERE  `id` = :id ");
$statement->bindValue(':id', $id);
$statement->execute();
header('Location: index.php');