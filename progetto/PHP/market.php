<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
if(isset($_SESSION["username"])){
    $_SESSION["logged"]=true;
}else{

}
?>
 <div class=navbar>
        <ul class="navbarlist">
            <li><a class="active" href="home.php">Home</a></li>
            <li><a id="progressi" href="progressi.php">I tuoi Dati</a></li>
            <li><a id="contatti" href="statistiche.php">Statistiche</a></li>
            <li><a id="IMC" href="calcoloIMC.php">Calcolo IMC</a></li>
            <li><a id="fabisogno" href="metabolismo_basale.php">Calcolo metabolismo/fabbisogno energetico</a> </li>
            <li><a id="pushup" href="pushupgame.php">Push Up Game</a> </li>
            <?php
            if( isset($_SESSION["logged"])){
            ?>
                <li style="float:right"><a id="logout" href="logout.php">Logout</a></li>
            <?php
            }else{
            ?>
            <li style="float:right"><a href="index.php">Login</a></li>
            <?php
            }
            ?>


        </ul>

    </div>
