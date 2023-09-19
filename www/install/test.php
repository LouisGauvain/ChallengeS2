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
    $errorCode = $e->getCode();
    $errorMessage = $e->getMessage();

    // Traduire ou personnaliser le message d'erreur en fonction de son code ou de son contenu
    switch ($errorCode) {
        case 1045:
            echo json_encode(["message"=>"Nom d'utilisateur ou mot de passe incorrect."]);
            break;
        case 2002:
            echo json_encode(["message"=> "Impossible de se connecter au serveur de base de données."]);
            break;
        default:
        echo json_encode(["message"=> "Une erreur est survenue lors de la connexion à la base de données."]);
            break;
    }
}

