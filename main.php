<?php

//$_SERVER => HASHMAP contenat
//information requete
require_once "./router.php";
$addresse = $_SERVER['REQUEST_URI'];

route_request($addresse);