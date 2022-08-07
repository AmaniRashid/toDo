<?php
// creates a coonection to the databse

$pdo = new PDO('mysql:dbname=todo; localhost; port = 3306', 'root', '' );
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);