/*
AUTORE: Demis Mazzotta
Corso B
*/
window.onload=function(){
    cellaVuota=[3,3];
    posizionoCaselleStart();
    controlloCasella();
    document.getElementById("shufflebutton").onclick = shuffle;
}

var cellaVuota;
var movibile = [];


function posizionoCaselleStart(){
    //acquisisco i vari pezzi figli del div
    var pezzipuzzle = document.getElementById("puzzlearea").children;
    var ncolonna=0; var nriga=0;
    for(var i = 0; i<pezzipuzzle.length; i++){
        if(ncolonna>3){
            //resetto colonna e incremento riga
            ncolonna=0;
            nriga++;
        }
        pezzipuzzle[i].style.left = parseInt(100*ncolonna) + "px";
        pezzipuzzle[i].style.top = parseInt(100*nriga) + "px";
        pezzipuzzle[i].id = "tile_" + nriga +"_"+ ncolonna;
        pezzipuzzle[i].style.backgroundImage ="url('android.jpg')";
        var posX = (-100*ncolonna); var posY = (-100*nriga);
        pezzipuzzle[i].style.backgroundPosition = posX +'px '+ posY+'px';
        ncolonna++;
        pezzipuzzle[i].onclick = spostapezzo;
    }
}

function spostapezzo(){
    //anche se scritto di non splittare la stringa, non mi vengono in mente altri modi
    //quindi la splitto..
    var positionString = this.id.split("_");

    /*
    parso la stringa associando riga e colonna ad un array
    positionString[1] riga
    positionString[2] colonna
    */
    var position = [parseInt(positionString[1]),parseInt(positionString[2])];
    console.log(position);
    var posizionamento = [cellaVuota[0]-position[0],cellaVuota[1]-position[1]];
    console.log(posizionamento);
    
    /* controllo se la casella su cui mi trovo è movibile 
    ossia se è presente nell'array dei pezzi movibili */

    if(movibile.includes(this)){
        if(Math.abs(posizionamento[0]) === 1){
            position[0] = position[0] + posizionamento[0];
            console.log( "position" + position[0]);
            cellaVuota[0] = cellaVuota[0] - posizionamento[0];
            this.style.left = (100 * position[1]) + "px";
            console.log(this.style.left);
            this.style.top = (100 * position[0]) + "px";
            this.id = "tile_" + position[0] + "_" + position[1];
        }else{
            position[1] = position[1] + posizionamento[1];
            cellaVuota[1] = cellaVuota[1] -posizionamento[1];
            this.style.left = (100 * position[1]) + "px";
            this.style.top = (100 * position[0]) + "px";
            this.id = "tile_" + position[0] + "_" + position[1];
        }
    }
    controlloCasella();
    checkVittoria();




}

function controlloCasella(){
    for (var i = 0; i <movibile.length ; i++) {
        movibile[i].className="";
    }
    movibile = [];
    var i = 0;
    var tile = document.getElementById("tile_" + (cellaVuota[0] + 1) + "_" + cellaVuota[1]);
    console.log(tile);
    if (tile){
        movibile[i] = tile;
        tile.className = "movibile"
        i++;
    }
    tile = document.getElementById("tile_" + (cellaVuota[0] - 1) + "_" + cellaVuota[1]);
    console.log(tile);
    if (tile){
        movibile[i] = tile;
        tile.className = "movibile"
        i++;
    }
    tile = document.getElementById("tile_" + cellaVuota[0] + "_" +  (cellaVuota[1] + 1));
    console.log(tile);
    if (tile){
        movibile[i] = tile;
        tile.className = "movibile"
        i++;
    }
    tile = document.getElementById("tile_" + cellaVuota[0] + "_" +  (cellaVuota[1] - 1));
    console.log(tile);
    if (tile){
        movibile[i] = tile;
        tile.className = "movibile"
        i++;
    }

    
console.log("cellavuota " + cellaVuota);

}

function shuffle(){
    var indice;
    var casuale = Math.random() *200;
    for (var i= 0; i<casuale; i++){
        indice = parseInt(Math.random()*movibile.length);

        /*uso la funzione call, con la quale posso chimare la funzione spostapezzo
        sull'array movibile, che conterrà le caselle che si possono muovere
        */
        spostapezzo.call(movibile[indice]);
    }

}

function checkVittoria(){
 var pezzi = document.getElementById("puzzlearea").children;
 /*controllo se l'ordine degli elementi dom è lo stesso delle posizini riga e colonna

 */
var riga=0;
var colonna=0;
    var id = "";
    for (var i=0; i<pezzi.length; i++) {
        if (colonna > 3) {
            colonna = 0;
            riga++;
        }
        id = "tile_" + riga + "_" + colonna;
        if (pezzi[i].id !== id)
            return null;
        colonna++;
    }

    paragraph = document.createElement("p");
    paragraph.innerText = "Congratulazioni hai vinto";
    paragraph.id = "winner"
    document.getElementsByTagName("body")[0].insertBefore(paragraph,document.getElementById("w3c"));

}

