<?php
//Our MySQL user account.
define('MYSQL_USER', 'root');
 
//Our MySQL password.
define('MYSQL_PASSWORD', '');
 
//The server that MySQL is located on.
define('MYSQL_HOST', 'localhost');

//The name of our database.
define('MYSQL_DATABASE', 'progetto');

if(!isset($_SESSION)){session_start();}

/**
 * Connect to MySQL and instantiate the PDO object.
 */
try{$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    );
}catch(PDOException $exception){
    die('Connessione al server fallita:'.$exception->getMessage());
    header('Location:index.php');
    exit;
}

function LoggedIN($pagVisitata){
    $_SESSION["currentPage"] = $pagVisitata;
    if(!isset($_SESSION["username"])){
        //se non e' presente una sessione allora non sono loggato quindi non mostro niente e redirecto alla pagina di login
        redirect("index.php", "Devi essere loggato per accedere a $pagVisitata!");
    }
}

function redirect($url, $messaggio){
    if ($messaggio){
        $_SESSION["flash"]=$messaggio;
    }
    //effettuo il redirect
    header("Location: $url");
    die;
}
//se tutto regolare invece mostro la pagina statistiche
?>