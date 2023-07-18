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

echo json_encode(['success' => true]);