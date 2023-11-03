<?php

include("./clases/Publicacion.php");

$conn = new PDO("mysql:host=localhost;dbname=c1582153_ap;", "c1582153_ap", "33seGOvose");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Access-Control-Allow-Origin: *');

$publicacion = new Publicacion($conn);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $key = key($_GET);
    $id = $_GET[$key];
    echo json_encode($publicacion->listarPublicaciones($id, $key));
    header("HTTP/1.1 200 OK");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$data = json_decode(file_get_contents("php://input"), true);
    
    echo json_encode($publicacion->agregarPublicacion($_POST['title'], $_POST['content'], $_POST['author_id'], $_FILES['image']));
    header("HTTP/1.1 200 OK");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($publicacion->actualizarPublicacion($data['id'], $data['title'], $data['content']));
    header("HTTP/1.1 200 OK");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($publicacion->eliminarPublicacion($data['id']));
    header("HTTP/1.1 200 OK");
    exit();
}
