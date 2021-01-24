<?php
include("connect.php");
loggedIN("statistiche.php");

//se tutto regolare invece mostro la pagina statistiche
include "top.php";

include "market.php";
//include "../HTML/market.html";

?>

    <script src ="../JS/statistiche.js" type="text/javascript"></script>
    <div class="maindescription">
        <p>In questa pagina puo vedere i tuoi progressi e l'andamento del tuo lavoro<p>
        <p>questi sono i tuoi progressi <strong><?=$_SESSION["username"]?></strong> </p>
    </div>
    <div id="filtrodiv">
        <label for="ordine" name="ordine">Ordina i risultati per:</label>
        <select id="filtro" name="filtro">
            <option value="dataD" selected="selected">data decrescente</option>
            <option value="dataC">data crescente</option>
            <option value="peso0d">peso iniz. decrescente</option>
            <option value="peso0c">peso iniz. crescente</option>
        </select>

    </div>
    <div id="divStatistiche1">
        <div id="grid-container">
            <div>data</div>
            <div>peso attuale</div>
            <div>imc (Attuale)</div>
            <div>metabolismo(per obiettivo)</div>
            <div>peso Obiettivo</div>
        </div>
    </div>
    <div id="condividi"><br><br></div>
        <!-- creo i soliti due button, uno per stampare la pagina e uno per esportarlo come immagine -->
        <div id="divCondivisioni">
            <button id="stampaButton" type="button">Stampa i Risultati</button>
            <button id="shareButton1" type="button">Condividi i Risultati</button>
        </div>

<?php include "../HTML/bottom.html";?>




