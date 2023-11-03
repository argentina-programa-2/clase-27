<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
class Comentarios
{
    private $comentarios = [];
    private $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function listarComentarios($id, $key)
    {
        //return $key;
        $sql = "SELECT * FROM clase27_comentarios";
        if (isset($id)) {
            if ($key == "post_id") {
                $sql = $sql . " WHERE post_id =$id ORDER BY id ASC";
            }
            if ($key == "id") {
                $sql = $sql . " WHERE id =$id ORDER BY id ASC";
            }
        }
        $pdo = $this->bd->prepare($sql);
        $pdo->execute();
        $arr = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $arrResponse = [];

        for ($i = 0; $i < count($arr); $i++) {
            $arrResponse[$i]['id'] = $arr[$i]['id'];
            $arrResponse[$i]['post_id'] = $arr[$i]['post_id'];
            $arrResponse[$i]['content'] = $arr[$i]['content'];
            $arrResponse[$i]['created_at'] = $arr[$i]['created_at'];

            $idPublicacion = $arr[$i]['author_id'];
            $pdo = $this->bd->prepare("SELECT username FROM clase27_usuarios WHERE id='$idPublicacion'");
            $pdo->execute();
            $arrUser = $pdo->fetchAll(PDO::FETCH_ASSOC);
            $arrResponse[$i]['author_id'] = $arrUser[0]['username'];
        }

        return array("comentarios" => $arrResponse);
    }

    public function agregarComentario($post_id, $content, $author_id)
    {

        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $pdo = $this->bd->prepare("INSERT INTO clase27_comentarios(post_id, content, author_id, created_at) VALUES ($post_id, '$content', $author_id, '$date')");
        if ($pdo->execute()) {
            return array("message" => "Comentario creado con exito");
        } else {
            return array("message" => "Error al crear el comentario");
        }
    }

    public function editarComentario($id, $content)
    {

        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $pdo = $this->bd->prepare("UPDATE clase27_comentarios SET content='$content', created_at='$date' WHERE id = $id");
        if ($pdo->execute()) {
            return array("message" => "Comentario editado con exito");
        } else {
            return array("message" => "Error al editar el comentario");
        }
    }

    public function eliminarComentario($id)
    {

        $pdo = $this->bd->prepare("DELETE FROM clase27_comentarios WHERE id = $id");
        if ($pdo->execute()) {
            return array("message" => "Comentario eliminado con exito");
        } else {
            return array("message" => "Error al eliminar el comentario");
        }
    }
}
