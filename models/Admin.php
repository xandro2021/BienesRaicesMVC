<?php

namespace Model;

use mysqli_result;

class Admin extends ActiveRecord
{
    protected static $tabla = 'Usuario';
    protected static $columnasDB = ['id', 'email', 'password_hash'];

    public $id;
    public $email;
    public $password_hash;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password_hash = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }

        if (!$this->password_hash) {
            self::$errores[] = "El password es obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        // Revisar si existe el usuario
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '$this->email' LIMIT 1;";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword(mysqli_result $resultado): bool
    {
        $usuario = $resultado->fetch_object();

        // Verificar el password hasheado
        $autenticado = password_verify($this->password_hash, $usuario->password_hash);

        if (!$autenticado) {
            self::$errores[] = "El password es incorrecto";
        }

        return $autenticado;
    }

    public function autenticar()
    {
        session_start();
        // Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}
