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
    <div class="homepage">
        <h2>Benvenuto in style your Life <?= $name?> </h2>
        <p>  prenditi cura di te stesso e della tua salute con stile.
            Siamo pronti ad offrirti tutte le informazioni di cui hai bisogno per vivere la tua vita al meglio,
            esercizi, consigli,rimedi e tanto altro fatti su misura per te, senza dover rinunciare alle tue passioni e
            alle tue abitudini
        </p>
        <p>
            Come puoi immaginare ogni corpo e' diverso, ognuno di noi infatti ha abitudini, caratteristiche e routine che ci caratterizzano
            C'e' chi conduce uno stile di vita sedentario (uffici, scrivanie, automobilisti), chi invece e' sempre in movimento, esegue lavori manuali,
            o semplicemente fa molta attivita' fisica.
            Ti sara' capitato di vedere amici, mangiare tantissimo e risultare piu magri di te che fai sport e sei sempre attento alla dieta.
            Non spaventarti, questa non e' magia, e non hanno fatto nessun patto con il diavolo, molto probabilmente il vostro amico avr' un consumo
            calorico giornaliero molto piu alto del vostro.
            Questo puo dipendere da tanti fattori, a volte anche stando seduti per tante ore si possono consumare energie,
            un esempio possono essere gli studenti che consumano energie stando seduti a "studiare"
            Per offrirti quindi una valutazione quanto piu precisa possibile ti invitiamo a completare la tua registrazione inserendo i tuoi dati se non lo hai ancora fatto

        </p>

        <p>
            Se non lo hai gia fatto, compila il form nella sezione "I tuoi Dati" con i tuoi dati per permetterci di aiutarti al meglio e in maniera piu precisa
            oppure clicca qui per andare direttamente alla pagina <a href="progressi.php">clicca qui!</a>
        </p>

        <p></p>

    </div>
<?php include "../HTML/bottom.html";?>