<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . "/../vendor/autoload.php";

// Conectarnos a la BD

use App\ActiveRecord;

$db = conectarDB();
ActiveRecord::setDB($db);
