<?php

namespace UF1\Config;

use mysqli;

/**
 * Class Database connection to database
 * @package UF1\Config
 */
class Database{

    /**
     * Metodo que se conecta a la base de datos
     * @return mysqli
     */
    public static function Connect(){
        $db = new mysqli("localhost", "root", "", 'ifpdb');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}