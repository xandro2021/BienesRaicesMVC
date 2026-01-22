<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'Vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    /**
     * @return array<string>
     */
    public function validar(): array
    {
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio";
        }

        /* Validar con expresion regular que el telefono sea numerico */
        if (!preg_match('/^[2|5-8]\d{7}$/', $this->telefono)) {
            self::$errores[] = "Formato no válido";
        }

        return self::$errores;
    }
}
