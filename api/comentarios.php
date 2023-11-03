<?php

include("./clases/Comentarios.php");

// $conn = new PDO("mysql:host=localhost;dbname=clase27;", "root", "");
$conn = new PDO("mysql:host=localhost;dbname=c1582153_ap;", "c1582153_ap", "33seGOvose");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Access-Control-Allow-Origin: *');

$comentarios = new Comentarios($conn);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $key = key($_GET);
    $id = $_GET[$key];
    echo json_encode($comentarios->listarComentarios($id, $key));
    header("HTTP/1.1 200 OK");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($comentarios->agregarComentario($data['post_id'], $data['content'], $data['author_id']));
    header("HTTP/1.1 200 OK");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($comentarios->editarComentario($data['id'], $data['content']));
    header("HTTP/1.1 200 OK");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($comentarios->eliminarComentario($data['id']));
    header("HTTP/1.1 200 OK");
    exit();
}
