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

//create the tables
//lance le script de création des tables schema.sql
$sql = file_get_contents('schema.sql');
$sql = str_replace('esgi_', $tablePrefix, $sql);

$pdo->exec($sql);

//insert the admin user
/* 
CREATE TABLE "public"."esgi_users" (
    "id" integer DEFAULT nextval('esgi_users_id_seq') NOT NULL,
    "firstname" character varying(255) NOT NULL,
    "lastname" character varying(255) NOT NULL,
    "email" character varying(255) NOT NULL,
    "password" character varying(255) NOT NULL,
    "role_id" integer DEFAULT '6' NOT NULL,
    "verification_token" character varying(255),
    "email_verified" boolean DEFAULT false,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP,
    "date_updated" timestamp,
    CONSTRAINT "esgi_users_email_key" UNIQUE ("email"),
    CONSTRAINT "esgi_users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);
 */
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
/* DROP TABLE IF EXISTS "test_configurations";
CREATE TABLE "public"."test_configurations" (
    "id" integer NOT NULL,
    "configuration_key" character varying(255) NOT NULL,
    "configuration_value" text NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp
) WITH (oids = false); */
$sql = "INSERT INTO {$tablePrefix}configurations (configuration_key, configuration_value) VALUES (:configuration_key, :configuration_value)";
$query = $pdo->prepare($sql);
$query->execute([
    'configuration_key' => 'site_name',
    'configuration_value' => $siteName
]);

echo json_encode(['success' => true]);