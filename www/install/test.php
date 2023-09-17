<?php

$db_host = $_REQUEST['dbHost'];
$db_name = $_REQUEST['dbName'];
$db_user = $_REQUEST['dbUser'];
$db_pass = $_REQUEST['dbPassword'];

//test the connexion to the database
try {
    $pdo = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

