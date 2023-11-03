<?php

include("./clases/Usuario.php");

// $conn = new PDO("mysql:host=localhost;dbname=clase27;", "root", "");
$conn = new PDO("mysql:host=localhost;dbname=c1582153_ap;", "c1582153_ap", "33seGOvose");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Access-Control-Allow-Origin: *');

$usuario = new Usuario($conn);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $key = key($_GET);
    $id = $_GET[$key];
    // echo json_encode($id);
    echo json_encode($usuario->listarUsuario($id, $key));
    header("HTTP/1.1 200 OK");
    exit();
}
