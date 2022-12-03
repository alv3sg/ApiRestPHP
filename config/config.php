<?php
    define("ROOT_PATH", __DIR__ . "/../");//variavel global com o caminho padrao do projeto//
    define("DATABASE_FILE", ROOT_PATH . "database.json");//variavel global para acessar o database 

    require_once ROOT_PATH . "/Controller/API/BaseController.php";
    require_once ROOT_PATH . "/Model/UserModel.php";//vai conter metodos e interagir com a base de dados

?>