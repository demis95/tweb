<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
    include "connect.php";
    session_start();
    //session_unset();
    //session_destroy();
    redirect("index.php","sei correttamente Uscito!");
?>
