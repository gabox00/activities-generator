<?php

namespace UF1\Config;

use mysqli;

class Database{
    public static function Connect(){
        $db = new mysqli("localhost", "root", "", 'ifpdb');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}