<?php
include "connect.php";
loggedIN("progressi.php");
include "top.php";
include "market.php";
//include "../HTML/market.html";

$name=$_SESSION['username'];
//require 'connect.php';
require 'dataSend.php';
?>

    <div class="maindescription" id="beforeerr">
        <p>I tuoi dati sono molto importanti per noi,
            ci aiutano a stabilire un profilo personale per poterti offrire solo il meglio che possiamo dare</p>
        <p>Usa il form sottostante per inserire i tuoi dati, inserisci dati veritieri ed attieniti alle unita' di misura richieste </p>
    </div>
    <div class="personalData">
        <div class="avatar">
            <img class="img" src="../IMG/avatar_res.png" alt="Avatar">
        </div>
        <?php
        if(isset($name)){
            $id=getID($name,$pdo);
            $datainfo=checkdata($id,$pdo);
            if($datainfo==1){
                $arraydata=datareceive($id,$pdo);
                //stampo tutti i dati ottenuti dalla query con un for??? boh per ora faccio cosi
                //prima tolgo l'id con uno shift
                $datashifted=array_shift($arraydata);
            ?>
                <div class="dataSample">
                    <ul class="dataSamplelist">
                        <li><b>NOME</b></li>
                        <li><b>E-Mail</b></li>
                        <li><b>ALTEZZA</b></li>
                        <li><b>GENERE</b></li>
                        <li><b>PESO Iniziale</b></li>
                        <li><b>PESO Attuale</b></li>
                        <li><b>ETA'</b></li>
                    </ul>
                </div>
                <div class="dataINFO">
                    <ul class="dataInfolist">
                        <li><b><?=$name?></b></li>
                        <?php
                        foreach($arraydata as $data=>$datacicle){?>
                            <li><b><?=$datacicle?></b></li>
                            <?php
                            }
                        ?>
                    </ul>
                </div>
        <?php
            }else{
            //se datainfo==0 allora mostro il form per i dati
        ?>
                <div class="datainfoForm">
                    <form id="ajaxsend">
                        <legend>Inserisci i Tuoi Dati: <?= $name ?></legend>
                        <ul class="dataInfolist">
                            <li>
                                <label><strong>E-mail:</strong></label>
                                <input type="email" maxlength="30" name="email">
                            </li>
                            <li>
                                <label><strong>Altezza (CM):</strong></label>
                                <input type="number" size="3" maxlength="3" name="altezza" pattern="\d{3}" title="l'altezza deve essere un numero in cm">
                            </li>
                            <li>
                                <label><strong>Genere:</strong></label>
                                <input type="radio" name="genere" value="M" checked="checked"><label>Maschio</label>
                                <input type="radio" name="genere" value="F"><label>Femmina</label>
                            </li>
                            <li>
                                <label><strong>Età</strong></label>
                                <input type="number" size="3" maxlength="3" name="eta" pattern="\d{1,2}" min="1" max="99" title="Eta' non negativa">
                            </li>
                            <li>
                                <label><strong>Il tuo Peso Attuale</strong></label>
                                <input type="number" size="3" maxlength="3" name="peso0" pattern="\d{3}" min="30" max="120" title="Il peso deve essere un numero compreso tra 30 e 120">
                            </li>
                            <li>
                                <label><strong>Il Peso che vuoi raggiungere</strong></label>
                                <input type="number" size="3" maxlength="3" name="pesoX" pattern="\d{3}" min="30" max="120" title="Il peso deve essere un numero compreso tra 30 e 120">
                            </li>
                            <li>
                                <!--<label><strong>Invia i Dati</strong></label>-->
                                <button id="postdata" value="send" name="send"> INVIA i DATI</button>


                        </ul>

                    </form>
                </div>
            <?php
            }
        }//devo fare check sui dati, se corretti
            ?>
    </div>
<?php include "../HTML/bottom.html";?>

