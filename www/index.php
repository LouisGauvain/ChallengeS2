<?php

namespace App;
//Contrainte : utilisation des Namespace
require __DIR__ . '/vendor/autoload.php';

use App\Core\Utils;
use App\Models\Pages;
use App\Controllers\Sitemap;

spl_autoload_register(function ($class) {
  //Core/View.php
  $class = str_replace("App\\", "", $class);
  $class = str_replace("\\", "/", $class) . ".php";
  if (file_exists($class)) {
    include $class;
  }
});

$envFilePath = '.env';
$exampleFilePath = '.env.example';

// Read the contents of the files
  if (!file_exists($envFilePath)) {
    Utils::redirect("install.php");
  }
  $envContent = file_get_contents($envFilePath);
$exampleContent = file_get_contents($exampleFilePath);

// Convert the contents into arrays of lines
$envLines = explode(PHP_EOL, $envContent);
$exampleLines = explode(PHP_EOL, $exampleContent);

// Remove empty lines
$envLines = array_filter($envLines);
$exampleLines = array_filter($exampleLines);

// Extract the keys (lines before the equal sign)
$envKeys = array_map(function($line) {
    return substr($line, 0, strpos($line, '='));
}, $envLines);

$exampleKeys = array_map(function($line) {
    return substr($line, 0, strpos($line, '='));
}, $exampleLines);

// Check if the same keys are present
$missingKeys = array_diff($exampleKeys, $envKeys);

if(!empty($missingkeys)) {
  Utils::redirect("install.php");
}

//S'il y a des paramètres dans l'url il faut les enlever :
$uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
$uri = rtrim(strtolower(trim($uriExploded[0])), "/");
//Dans le cas ou nous sommes à la racine $uri sera vide du coup je remets /
$uri = (empty($uri)) ? "/" : $uri;

$found = false;
$pages = new Pages();
$uriPages = $pages->getUriPages();
foreach ($uriPages as $uriPage) {
  $uriP = $uriPage['url_page'];
  $controller = $uriPage["controller_page"];
  $action = $uriPage["action_page"];
  if ($uriP == $uri) {
    if (empty($controller) || empty($action)) {
      die("Absence de controller ou d'action dans le ficher de routing pour la route " . $uri);
    }
    $controller = "\\App\\Controllers\\" . $controller;
    if (!class_exists($controller)) {
      die("La class " . $controller . " n'existe pas");
    }
    $objet = new $controller();
    if (!method_exists($objet, $action)) {
      die("L'action " . $action . " n'existe pas");
    }
    $objet->$action();
    $found = true;
  }
}

if (!$found) {
  header("HTTP/1.0 404 Not Found");
  die("Page 404");
}


$sitemapController = new Sitemap();
$sitemapController->generateSitemap();