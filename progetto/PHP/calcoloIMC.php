<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
include "top.php";
include "market.php";
//include "../HTML/market.html";
if(isset($_SESSION["username"])){
    $name=$_SESSION["username"];
    $mail=$_SESSION["email"];
}else{
    $name="Utente Visitatore";
    $mail ="Visitatore";
}
?>
<div class="maindescription">
    <h3>Cos'è l'indice di massa corporea?</h3>
    <p>
        L'indice di massa corporea (IMC o BMI, acronimo Inglese di Body Mass Index) è un parametro che mette in relazione la massa corporea e la statura di un soggetto.
        L'IMC fornisce una stima delle dimensioni corporee più accurata rispetto alle vecchie tabelle basate semplicemente su altezza e peso.
        L'indice di massa corporea si calcola dividendo il proprio peso espresso in kg per il quadrato dell'altezza espressa in metri:
    </p>
    <p>
        IMC = massa corporea (Kg) / statura (m2)
    </p>
    <p>
        Per semplificare un po' il tutto (a voi,perche' per farlo in js non e' affatto semplice)
        Ecco a voi un simpatico tool interattivo per calcolare il vostro IMC
    </p>
</div>
<div id="formimc">
    <form id="imc">
        <p>Muovi l'indicatore per definire la tua altezza e peso, oppure digita i valori (numeri interi) nei campi appositi.</p>
        <p dysplay="inline">NOME :   <?= $name ?></p><p display="inline">       MAIL:      <?= $mail ?> </p>
        <!--<fieldset>-->
        <div id="peso">
            <label for="peso">PESO</label>
            <div class="figura">
                <img src="../IMG/ominobilancia.png" alt="omino bilancia">
            </div>
            <div class="slider">
                <div class="progresso"></div>
                <div class="coordinate">
                </div>
                <table id="scalapeso" class="scala">
                    <!--
                    <div class="slidecontainer">
                        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                    </div>
                    -->

                    <tbody id="dimensionebox">
                    <input type="range" min="30" max="120" value="50" class="handle" id="myRange">
                    <tr>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    </td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="misure">
                    <tbody>
                    <tr>
                        <td>30</td>
                        <td>40</td>
                        <td>50</td>
                        <td>60</td>
                        <td>70</td>
                        <td>80</td>
                        <td>90</td>
                        <td>100</td>
                        <td>110</td>
                        <td>120</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <span class="misura">KG</span>
            <input id="rangepeso" type="number" name="peso" value="50" maxlength="4" pattern="d{3}" min="30" max="120" title="Il peso deve essere un numero compreso tra 30 e 120">
            <!--<span class="misura">KG</span> -->
        </div>
        <div id="altezza">
            <label for="altezza">Altezza</label>

            <div class="figura">
                <img src="../IMG/ominometro.png" alt="omino metro">
            </div>
            <div class="slider">
                <div class="progresso"></div>
                <table class="scala">
                    <tbody>
                    <input type="range" min="120" max="210" value="170" class="handle" id="myHeigh">
                    <tr>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="minore">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="misure">
                    <tbody>
                    <tr>
                        <td>120</td>
                        <td>130</td>
                        <td>140</td>
                        <td>150</td>
                        <td>160</td>
                        <td>170</td>
                        <td>180</td>
                        <td>190</td>
                        <td>200</td>
                        <td>210</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <span class="misura">Cm</span>
            <input id="rangeh" type="number" name="altezza" value="170"  maxlength="4" pattern="d{3}" min="120" max="210" title="Altezza deve essere in cm e compresa tra 120 e 210">

        </div>
        <div class="buttonCalcola">
            <button id="imcbutton" type="submit" class="calcola" style="border-radius: 4px;">
                <span>Calcola</span>
            </button>
        </div>
        <div class="clearboth">
            <br>
        </div>
        <div id="scala">
            <div id="risultato" style="visibility: hidden"><strong>25</strong></div>
            <ul>
                <li class="grave">
                    <span class="definizione">Grave magrezza</span>
                    <span class="range">(&lt; 16,00)</span>
                </li>
                <li class="sottopeso">
                    <span class="definizione">Sottopeso</span>
                    <span class="range">(16,00-18,49)</span>
                </li>
                <li class="normopeso">
                    <span class="definizione">Normopeso</span>
                    <span class="range">(18,50-24,99)</span>
                </li>
                <li class="sovrappeso">
                    <span class="definizione">Sovrappeso</span>
                    <span class="range">(25,00-29,99)</span>
                </li>
                <li class="obeso-1">
                    <span class="definizione">Obeso classe 1</span>
                    <span class="range">(30,00-34,99)</span>
                </li>
                <li class="obeso-2">
                    <span class="definizione">Obeso classe 2</span>
                    <span class="range">(35,00-39,99)</span>
                </li>
                <li class="obeso-3">
                    <span class="definizione">Obeso classe 3</span>
                    <span class="range">(≥ 40,00)</span>
                </li>
            </ul>
        </div>
        <div id="clearboth"></div>
    </form>
</div>
<div id="OutputCanvas"></div>
<?php
include "../HTML/bottom.html"; ?>
