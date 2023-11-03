<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
class Publicacion
{
    private $publicaciones = [];
    private $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function listarPublicaciones($id, $key)
    {
        $sql = "SELECT * FROM clase27_publicaciones";
        if (isset($id)) {

            if ($key == "id") {
                $sql = $sql . " WHERE id=$id";
            }

            if ($key == "author_id") {
                $sql = $sql . " WHERE author_id=$id";
            }
        }
        $pdo = $this->bd->prepare($sql);
        $pdo->execute();
        $arr = $pdo->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        $arrResponse = [];
        for ($i = 0; $i < count($arr); $i++) {
            $arrResponse[$i]['id'] = $arr[$i]['id'];
            $arrResponse[$i]['title'] = $arr[$i]['title'];
            $arrResponse[$i]['content'] = $arr[$i]['content'];
            $arrResponse[$i]['imagen'] = base64_encode($arr[$i]['imagen']);
            $arrResponse[$i]['author_id'] = $arr[$i]['author_id'];
            $arrResponse[$i]['created_at'] = $arr[$i]['created_at'];
        }
        return array("publicaciones" => $arrResponse);
    }

    public function agregarPublicacion($title, $content, $author_id, $filesImage)
    {
        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $imagenTmpName = file_get_contents($filesImage['tmp_name']);

        $sql = "INSERT INTO clase27_publicaciones(title, content, imagen, author_id, created_at) VALUES (:title, :content, :imagen, :author_id, :created_at)";

        $pdo = $this->bd->prepare($sql);
        $pdo->bindParam(':title', $title);
        $pdo->bindParam(':content', $content);
        $pdo->bindParam(':imagen', $imagenTmpName, PDO::PARAM_LOB);
        $pdo->bindParam(':author_id', $author_id);
        $pdo->bindParam(':created_at', $date);
        if ($pdo->execute()) {
            return array("message" => "Publicacion creada con exito");
        } else {
            return array("message" => "Error al crear la publicacion");
        }
    }

    public function actualizarPublicacion($id, $title, $content)
    {
        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $pdo = $this->bd->prepare("UPDATE clase27_publicaciones SET title='$title', content='$content', created_at='$date' WHERE id = '$id'");
        if ($pdo->execute()) {
            return array("message" => "Publicacion editada con exito");
        } else {
            return array("message" => "Error al editar la publicacion");
        }
    }

    public function eliminarPublicacion($id)
    {
        $comentarios = $this->bd->prepare("DELETE FROM clase27_comentarios WHERE post_id= $id");
        $comentarios->execute();

        $pdo = $this->bd->prepare("DELETE FROM clase27_publicaciones WHERE id = $id");
        if ($pdo->execute()) {
            return array("message" => "Publicacion eliminada con exito");
        } else {
            return array("message" => "Error al eliminar la publicacion");
        }
    }
}
