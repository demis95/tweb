<?php
include "top.php";
include "market.php";
//include "../HTML/market.html";
//session_start();
if(isset($_SESSION["username"])){
    $name=$_SESSION["username"];
}else{
    //$name="Utente Visitatore";
    //$_SESSION["username"]=$name;
}
?>
<script src ="../JS/metabolismo.js" type="text/javascript"></script>
<div class="maindescription">
    <h3>Cos'è il metabolismo basale?</h3>
    <p>
        Il metabolismo basale rappresenta la quantità di energia impiegata in condizioni di neutralità termica, dal soggetto sveglio,
        ma in uno stato di totale rilassamento fisico e psichico, a digiuno da almeno 12 ore.
        In altre parole, il metabolismo basale è il minimo dispendio energetico necessario a mantenere le funzioni vitali e lo stato di veglia.
    </p>
    <p>
    </p>
    <p>
        Per semplificare un po' il tutto (a voi,perche' per farlo in js non e' affatto semplice)
        Ecco a voi un simpatico tool interattivo per calcolare il vostro IMC
    </p>
</div>
<div id="divForm">
    <form id="formmetabolismo">
        <table width="94%" class="imgcenter" id="formapeso">
            <tbody>
            <tr>
                <td bgcolor="#f0f7fb" class="pot2">PESO</td>
                <td bgcolor="#F7F7FB" class="pot2">
                <span class="relax">
                    <input id="pesoinput"  size="8" value="75" name="pesoformaa" type="number" required pattern="\d{3}" min="30" max="120" title="Il peso deve essere un numero compreso tra 30 e 120">
                </span>Kg
                </td>
            </tr>
            <tr>
                <td width="147" bgcolor="#f0f7fb" class="pot2"> Sesso</td>
                <td width="549" bgcolor="#F7F7FB" class="pot2">
                <span class="relax">
                    <select name="sessoo" id="sessoselect" size="1">
                        <option value="Maschio">Maschio</option>
                        <option value="Femmina">Femmina</option>
                    </select>
                </span>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f0f7fb" class="pot2">Età</td>
                <td bgcolor="#F7F7FB" class="pot2">
                <span class="relax">
                    <select onfocus="vclear()" name="etaa" size="1">
                        <option value="18-29">18-29</option>
                        <option value="30-59">30-59</option>
                        <option value="60-74">60-74</option>
                        <option value="+74"> 74</option>
                    </select>
                </span>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f0f7fb" class="pot2">Lavoro</td>
                <td class="pot2" bgcolor="#F7F7FB">
                    <select size="1" name="lavoro">
                        <option>Casalingo/a collaboratori domestici</option>
                        <option>Commesso/a</option>
                        <option>Dirigente</option>
                        <option>Impiegato/a</option>
                        <option>Lavori agricoli</option>
                        <option>Lavori edili</option>
                        <option>Libero professionismo</option>
                        <option>Operaio/a (leggero)</option>
                        <option>Operaio/a (pesante)</option>
                        <option>Studente</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f0f7fb" class="pot2">Attività fisica </td>
                <td class="pot2" bgcolor="#F7F7FB">
                    <select size="1" name="sport">
                        <option>Nessuna</option>
                        <option>Fino a 2 ore settimanali</option>
                        <option>Da 3 a 5 ore settimanali</option>
                        <option>Oltre 5 ore settimanali</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="147" bgcolor="#f0f7fb" align="center" class="pot2">
                    <input id="CalorieButton" name="calcolaCalorie" type="submit" value="Calcola calorie">
                </td>
                <td width="549" class="pot2" bgcolor="#F7F7FB">&nbsp;</td>
            </tr>
            </tbody>
        </table>
        <table id="formapesoclass">
            <tbody>
            <tr >
                <td class="pot2" bgcolor="#f0f7fb">METABOLISMO BASALE</td>
                <td class="pot2"bgcolor="#F7F7FB"><textarea class="textarea" id="risultatometabolismo" name="mb" bgcolor="#F7F7FB"></textarea>
                </td>
            </tr>
            <tr>
                <td class="pot2" width="147" bgcolor="#f0f7fb">FABBISOGNO CALORICO QUOTIDIANO</td>
                <td class="pot2" width="549" bgcolor="#F7F7FB"><textarea class="textarea" id="risultatocalorie" name="calorie" bgcolor="#F7F7FB"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="pot2"><br>
                    <blockquote>
                        Il fabbisogno energetico quotidiano rappresenta con buona approssimazione la quantità giornaliera di calorie che: <br>
                        consente di raggiungere gradualmente il peso forma se il peso attuale è superiore (dieta dimagrante)
                        consente di raggiungere gradualmente il peso forma se il peso attuale è inferiore (dieta ingrassante)
                    </blockquote></td>
            </tr>
            </tbody>
        </table>
    </form>

</div>
<?php include "../HTML/bottom.html";?>
