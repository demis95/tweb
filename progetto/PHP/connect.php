<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */

define('MYSQL_USER', 'root');
 

define('MYSQL_PASSWORD', '');
 

define('MYSQL_HOST', 'localhost');


define('MYSQL_DATABASE', 'progetto');

if(!isset($_SESSION)){session_start();}


try{$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE,
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
?>