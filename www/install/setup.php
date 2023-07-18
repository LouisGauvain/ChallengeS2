<?php

$db_host = $_POST['db_host'];
$db_name = $_POST['db_name'];
$db_user = $_POST['db_user'];
$db_pass = $_POST['db_pass'];

$siteName = $_POST['site_name'];
$tablePrefix = $_POST['table_prefix'];
$adminEmail = $_POST['admin_email'];
$adminPass = $_POST['admin_pass'];

try{
    $pdo = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    die();
}

$sql = file_get_contents('schema.sql');
$sql = str_replace('esgi_', $tablePrefix, $sql);

$pdo->exec($sql);

$sql = "INSERT INTO {$tablePrefix}users (firstname, lastname, email, password, role_id, email_verified) VALUES (:firstname, :lastname, :email, :password, :role_id, :email_verified)";
$query = $pdo->prepare($sql);
$query->execute([
    'firstname' => 'Admin',
    'lastname' => 'Admin',
    'email' => $adminEmail,
    'password' => password_hash($adminPass, PASSWORD_DEFAULT),
    'role_id' => 1,
    'email_verified' => true
]);

$sql = "INSERT INTO {$tablePrefix}configurations (configuration_key, configuration_value) VALUES (:configuration_key, :configuration_value)";
$query = $pdo->prepare($sql);
$query->execute([
    'configuration_key' => 'site_name',
    'configuration_value' => $siteName
]);

$sql = "INSERT INTO {$tablePrefix}configurations (configuration_key, configuration_value) VALUES (:configuration_key, :configuration_value)";
$query = $pdo->prepare($sql);
$query->execute([
    'configuration_key' => 'table_prefix',
    'configuration_value' => $tablePrefix
]);

//create the .env file
$env = file_get_contents('../.env.example');
$env = str_replace('DB_HOST=', "DB_HOST=$db_host", $env);
$env = str_replace('DB_NAME=', "DB_NAME=$db_name", $env);
$env = str_replace('DB_USERNAME=', "DB_USERNAME=$db_user", $env);
$env = str_replace('DB_PASSWORD=', "DB_PASSWORD=$db_pass", $env);
$env = str_replace('DB_PREFIX=', "DB_PREFIX=$tablePrefix", $env);

$env = str_replace('SITE_NAME=', "SITE_NAME=$siteName", $env);

file_put_contents('../.env', $env);

echo json_encode(['success' => true]);