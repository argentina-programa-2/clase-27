<?php

class Usuario
{
    private $conn;

    public function __construct($bd)
    {
        $this->conn = $bd;
    }

    public function listarUsuario($id, $key)
    {
        $sql = "SELECT id, username, email FROM clase27_usuarios";
        if (isset($id)) {
            if ($key == "username") {
                $sql = $sql . " WHERE username ='$id'";
            }
            if ($key == "id") {
                $sql = $sql . " WHERE id =$id";
            }
        }
        $pdo = $this->conn->prepare($sql);
        $pdo->execute();
        $arr = $pdo->fetchAll(PDO::FETCH_ASSOC);
        return  $arr[0];
    }

    public function registrar($username, $password, $email)
    {
        $pdo = $this->conn->prepare("SELECT * FROM clase27_usuarios WHERE username = '$username'");
        $pdo->execute();
        $arr = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if (count($arr) > 0) {
            return array("message" => "El nombre de usuario ya está en uso.");
        }
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $pdo = $this->conn->prepare("INSERT INTO clase27_usuarios (username, pass, email) VALUES ('$username', '$hashed_password', '$email')");
        if ($pdo->execute()) {
            return array("message" => "Usuario creado con exito");
        } else {
            return array("message" => "Error al crear el usuario");
        }
    }

    public function iniciarSesion($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM clase27_usuarios WHERE username = '$username'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrResponse[0]['id'] = $result[0]['id'];
        $arrResponse[0]['username'] = $result[0]['username'];
        $arrResponse[0]['email'] = $result[0]['email'];
        if (count($result) == 1 && password_verify($password, $result[0]['pass'])) {
            return array("message" => "Iniciaste sesion correctamente", "user" => $arrResponse);
        } else {
            return array("message" => "Error al iniciar sesion");
        }
    }
}
