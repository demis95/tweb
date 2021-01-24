/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
var i=0;
var counter=0;
var first=false;

$(document).ready(function() {

    $( "#register" ).click( apriRegistrazione );
    $("#entra").click(registerstart);
    $("#login").click(loginstart);
    $( "#postdata" ).click(funzione);
    $( "#imgchange" ).click( function () {
        if (first == true) {
            changeImage( counter, first );
        }
    });

    var span = document.getElementById( 'time' );
    var countdown = new Countdown( span, 10 );

    $( '#start' ).on( 'click', function () {
        countdown.start();
        first = true;
        console.log( first );
        if (first == true) {
            changeImage( counter, first );
        } else {
            document.getElementById( "imgchange" ).src = "IMG/goku.png";
        }
    });
    $( '#reset' ).on( 'click', function () {
        first = false;
        counter = 0;
        countdown.init();
        document.getElementById( "spanres" ).innerText = counter;
        document.getElementById( "imgchange" ).src = "IMG/frame0.gif";
    });
    var el = document.getElementById( "divStatistiche1" );
    /*$( "#shareButton1" ).click( function () {
        //
        condividi( document.getElementById("divStatistiche1") );
    });
    */

    $("#stampaButton").click(printpagina);
    $("#shareButton1").click(function (){
        condividi(document.getElementById("divStatistiche1"));
    });
});

window.onload = eventi;

    function eventi() {
        var sliderP = document.getElementById( "myRange" );
        var peso = document.getElementById( 'rangepeso' );
        sliderP.onchange = equal;
        peso.onchange = swap;

        var sliderH = document.getElementById( "myHeigh" );
        var altezza = document.getElementById( 'rangeh' );
        sliderH.addEventListener( 'input', function (e) {
            altezza.value = sliderH.value;
        } );
        altezza.addEventListener( 'input', function (e) {
            sliderH.value = altezza.value;
        } );

        var imcbutton = document.getElementById( "imcbutton" ); //.onclick = CalcoloIMC;
        document.getElementById( "imc" ).addEventListener( "submit", function (event) {
            event.preventDefault();
            imcbutton.onclick = CalcoloIMC();
        } );

    }
    function registerstart(){
        document.getElementById("regform").addEventListener("submit",function(event){
            event.preventDefault();
        });
        register();
    }
    function loginstart(){
        document.getElementById("loginform").addEventListener("submit",function (event){
            event.preventDefault();
        });
        login();
    }
    function register(){
        var username= $('input[name="unamer"]').val();
        var passw = $('input[name="pswr"]').val();
        var email = $('input[name="emailr"]').val();
        console.log(username);
        console.log(passw);
        console.log(email);

        $.ajax({
            url:"../PHP/signup.php",
            type: "POST",
            dataType: "JSON",
            data: {'unamer' : username,'pswr': passw, 'emailr' : email},
            success: function(response){
                if (response.res ==-1 || response.res==0){
                    console.log(response.res);
                    console.log(response.page);
                    //redirect register
                    //window.location.href = response.page;
                    divflash(response.text);

                }else if (response.res ==1 || response.res==-2){
                    console.log( response.res );
                    console.log( response.page );
                    //redirect index
                    window.location.href = response.page;
                    divflash(response.text);
                }
            },error:function(response){
                divflash("errore inaspettato");
                console.log(response);
            }

        });
    }

    function login(){
        //funzione che si occupa di inviare una richiesta ajax alla pagina login

        var username= $('input[name="uname"]').val();
        var passw = $('input[name="psw"]').val();
        console.log(username);
        console.log(passw);

        $.ajax({
            url:"../PHP/login.php",
            type: "POST",
            dataType: "JSON",
            data: {'uname' : username,'psw': passw},
            success: function(response){
                if (response.res ==1){
                    console.log(response.res);
                    console.log(response.page);
                    window.location.href = response.page;
                    divflash(response.text);

                }else if(response.res == 0){
                    console.log(response.res);
                    console.log(response.page);

                    //window.location.href=response.page;
                    divflash(response.text);

                }else if(response.res == -1){
                    console.log(response.res);
                    console.log(response.page);
                    divflash(response.text);
                    window.location.href='register.php';
                }

            },error:function(response){
                divflash("errore inaspettato");
                console.log(response);
            }
        });

    }
    function divflash(text){
        //si occupa di creare un div per i messaggi di stampa del login/registrazione

        if(document.getElementById("responsetext")){
            document.getElementById("responsetext").innerText=text;
        }else{
            var div = document.createElement("div");
            div.id='responsetext';
            div.innerText=text;

            var parent =document.getElementById('area').parentNode;
            var logf=document.getElementById("loginform");
            div.style["backgroundColor"] = '#ffffcc';
            div.style["border"]='1px dotted #ccccaa';
            div.style["margin"]='0.5 em';
            div.style["padding"]='0.5 em';
            div.style["textAlign"]='center';
            parent.insertBefore(div,logf);

        }



    }

    function funzione(){
        //disabilito la chiamata generale di php per il form e chiamo la funzione contenete ajax
        document.getElementById( "ajaxsend" ).addEventListener( "submit", function (event) {
            event.preventDefault();
        });
        SendDdataInfoForm();

    }

    function equal() {

        var peso = document.getElementById( 'rangepeso' );
        peso.value = this.value;
    }

    function swap() {
        document.getElementById( "myRange" ).value = this.value;
    }

    function newDiv() {
        //ora creo due button
        //button stampa risultati
        //button condividi risultati ad un amico
        var stampaButton = document.createElement( "button" );
        var shareButton = document.createElement( "button" );
        stampaButton.id = 'stampaButton';
        stampaButton.type = 'button';
        shareButton.id = 'shareButton';
        shareButton.type = 'button';
        stampaButton.innerHTML = 'Stampa i Risultati';
        shareButton.innerHTML = 'Condividi i Risultati';


        if (document.getElementById( "divCondivisioni" )) {
            //se ho gia il div non faccio niente
        } else {
            //prima esecuzione, creo il div e posizioni i button
            var div = document.createElement( "div" );
            div.id = 'divCondivisioni';
            document.getElementById( "imc" ).appendChild( div );
            document.getElementById( "divCondivisioni" ).appendChild( stampaButton );
            document.getElementById( "divCondivisioni" ).appendChild( shareButton );

        }
        document.getElementById( "stampaButton" ).onclick = printpagina;
        document.getElementById( "shareButton" ).onclick = function () {
            condividi( document.getElementById( "imc" ) );
        };

    }

    function condividi(el) {

        //sfrutto la libreia canvas per esportare il div e scaricarlo come immagine

        window.scrollTo( 0, 0 );
        var imgoutput = null;
        //html2canvas(document.getElementById("formimc")).then(function(canvas){
        html2canvas( el ).then( function (canvas) {
            imgoutput = canvas.toDataURL( "image/png", 0.9 );
            //console.log( imgoutput );
            var link = document.createElement( "a" );


            link.href = imgoutput;
            link.download = "il tuo risultato.png";
            document.body.appendChild( link );
            link.click();
            console.log('stampa?');
            /*
            var parag = document.createElement( "a" );
            var text = document.createElement( "textarea" );
            text.id = "linkdacopiare";
            text.value = imgoutput
            downloadURI( imgoutput, "il tuo risultato.png" );
            */
        });


    }

    function downloadURI(uri, name) {
        var link = document.createElement( "a" );

        link.download = name;
        link.href = uri;
        document.body.appendChild( link );
        link.click();
    }

    function printpagina() {
        print();
    }

    function CalcoloIMC() {
        var $scala_obeso_3 = 40;
        var $scala_obeso_2 = 35;
        var $scala_obeso_1 = 30;
        var $scala_sovrappeso = 25;
        var $scala_normopeso = 18.5;
        var $scala_sottopeso = 16;
        var $scala_grave = 0;
        var $peso = $( '#peso input' ).val();
        console.log( $peso );
        var $altezza = $( '#altezza input' ).val() / 100;
        console.log( $altezza );
        var $imc = ($peso / ($altezza * $altezza)).toFixed( 2 );
        if ($imc > $scala_obeso_3) {
            var $posizione = 93;
        } else if ($imc > $scala_obeso_2) {
            var $posizione = 78.5;
        } else if ($imc > $scala_obeso_1) {
            var $posizione = 64.5;
        } else if ($imc > $scala_sovrappeso) {
            var $posizione = 50;
        } else if ($imc > $scala_normopeso) {
            var $posizione = 36;
        } else if ($imc > $scala_sottopeso) {
            var $posizione = 21.5;
        } else {
            var $posizione = 7;
        }
        var risultato = document.getElementById( "risultato" );

        $.ajax( {
            url: "sendValue.php",
            type: "GET",
            dataType: "json",
            data: {'peso0': $peso, 'imc': $imc},
            success: function (response) {
                risultato.innerText = response;
                risultato.style.left = $posizione + "%";
                document.getElementById( "risultato" ).style.visibility = "visible";
                var data = new Date().toISOString().slice( 0, 19 ).replace( 'T', ' ' );
                newDiv();
            }
            , error: function (response) {
                console.log( response.message );
            }
        } );

        //ora invio i dati al server che li processera'

    }

    function apriRegistrazione() {
        window.location.href = "register.php";
    }

    function SendDdataInfoForm() {
        //funzione che si occupa di inviare i dati del form
            var formData = {
                //acquisisco i dati del form
                'email': $( '#ajaxsend input[name=email]' ).val(),
                'altezza': $( '#ajaxsend input[name=altezza]' ).val(),
                'genere': $( '#ajaxsend input[name=genere]' ).val(),
                'eta': $( '#ajaxsend input[name=eta]' ).val(),
                'peso0': $( '#ajaxsend input[name=peso0]' ).val(),
                'pesoX': $( '#ajaxsend input[name=pesoX]' ).val()
            };
            $.ajax( {
                type: 'POST',
                url: '../PHP/ajaxsend.php',
                data: formData,
                dataType: 'json', //il tipo di data che ci aspettiamo dal server
                success: function (response) {

                    console.log( "dati FORM correttamente inviati" + response );

                   if( document.getElementById("errid")){
                       document.getElementById("errid").innerText= response;

                   }else{
                       var err= document.createElement("div");
                       err.id="errid";
                       document.getElementById("beforeerr").appendChild(err);
                       document.getElementById("errid").innerText= response;
                   }

                }, error: function (response) {
                    console.log( "dati form NOT sended " + response );
                }
            });

    }

    function changeImage(countclick, first) {
        if (first == false) {
            document.getElementById( "imgchange" ).src = "../IMG/goku.png";
        } else {
            var span = document.getElementById( 'time' );
            if (span.innerText != "00:00.00") {

                //ovviamente il src vuole un path completo, e se lo provo mi dice unable to access this resurce.
                //faccio un substring va
                var src = document.getElementById( "imgchange" ).src;
                var imgsrc = src.substring( src.lastIndexOf( "/" ) + 1 );
                if (imgsrc == "frame0.gif") {
                    counter = counter + 1;
                    console.log( counter );
                    document.getElementById( "spanres" ).innerText = counter;
                    //cambio img , potrei fare un replace child del div imgdiv, ma provo prima a cambiare src
                    document.getElementById( "imgchange" ).src = "../IMG/frame1.gif";
                } else {
                    countclick = countclick + 1;
                    document.getElementById( "spanres" ).innerText = counter;
                    document.getElementById( "imgchange" ).src = "../IMG/frame0.gif";
                }
            } else {
                i = 1;
                first = false;
                document.getElementById( "spanres" ).innerText = counter;
                if (counter > 18) {
                    document.getElementById( "imgchange" ).src = "../IMG/goku.png";
                }
            }
        }

    }

    function Countdown(elem, seconds) {
        var that = {};

        that.elem = elem;
        that.seconds = seconds;
        that.totalTime = seconds * 100;
        that.usedTime = 0;
        that.startTime = +new Date();
        that.timer = null;

        that.count = function () {
            that.usedTime = Math.floor( (+new Date() - that.startTime) / 10 );

            var tt = that.totalTime - that.usedTime;
            if (tt <= 0) {
                that.elem.innerHTML = '00:00.00';
                clearInterval( that.timer );
            } else {
                var mi = Math.floor( tt / (60 * 100) );
                var ss = Math.floor( (tt - mi * 60 * 100) / 100 );
                var ms = tt - Math.floor( tt / 100 ) * 100;

                that.elem.innerHTML = that.fillZero( mi ) + ":" + that.fillZero( ss ) + "." + that.fillZero( ms );
            }
        };

        that.init = function () {
            if (that.timer) {
                clearInterval( that.timer );
                that.elem.innerHTML = '00:00.00';
                that.totalTime = seconds * 100;
                that.usedTime = 0;
                that.startTime = +new Date();
                that.timer = null;
            }
        };

        that.start = function () {
            if (!that.timer) {
                that.timer = setInterval( that.count, 10 );
            }
        };

        that.stop = function () {
            console.log( 'usedTime = ' + countdown.usedTime );
            if (that.timer) clearInterval( that.timer );
        };

        that.fillZero = function (num) {
            return num < 10 ? '0' + num : num;
            //first=false;
        };

        return that;
    }






