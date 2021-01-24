<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
include "top.php";
if(isset($_SESSION["username"])){
    $name=$_SESSION["username"];
}else{
    $name="Utente Visitatore";
}

include "market.php";
//include "../HTML/market.html";
?>
    <div class ="maindescription">
        <p> Ormai le feste sono finite, e si sa, i kg aumentano come ogni volta, le paleste sono chiuse e pesi non se ne trovano</p>
        <p> Nel mentre che aspettiamo che aprano le palestre o che arrivino scorte di pesi, puoi divertirti con questo piccolo universitario sotto sessione che cerca di tenersi in forma :)</p>
        <p> Il giochino e' molto semplice, 10 secondi a disposizione e tutti i push up che riesci a fargli fare.</p>
            basta cliccare sull'immagine per far muovere il povero studente.
        <p> clicca sul bottone START e dacci dentro con quel dito!!!</p>
    </div>
    <div id="gamediv">
        <div id="result">
            <span id="spanres"></span>
        </div>
        <div id="imgdiv">
            <img id="imgchange" src="../IMG/frame0.gif" alt="pushup" >
        </div>
        <div id="countdown">
            <span id="time" class="time">00:00.00</span>
        </div>
        <div class="btn-wrap">
            <button id="start">Start</button>
            <button id="reset">Reset</button>
        </div>
    </div>
<?php include "../HTML/bottom.html";?>