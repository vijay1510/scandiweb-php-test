<?php


require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/database/config.php";



use Src\database\Database;



$parts = explode("/", $_SERVER["REQUEST_URI"]);

$id = $parts[3] ?? null;

if($parts[2] !== "products"){
    http_response_code(404);
    echo json_encode(["message" => "page not found"]);
    exit;
}


$db = new Database();


