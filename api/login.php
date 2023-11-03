<?php

include("./clases/Usuario.php");
include("./clases/DataBase.php");

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

// $conn = new PDO("mysql:host=localhost;dbname=clase27;", "root", "");
$conn = new PDO("mysql:host=localhost;dbname=c1582153_ap;", "c1582153_ap", "33seGOvose");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $bd->conectar();

$usuarios = new Usuario($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($usuarios->iniciarSesion($data['username'], $data['password']));
    header("HTTP/1.1 200 OK");
    exit();
}


//$bd->desconectar();
