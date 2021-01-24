/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
$(document).ready(function() {
    $( "#filtro" ).change( function () {
        $( "select option:selected" ).each( function () {
            var filtro = $( "select option:selected" ).val();
            queryres(filtro);
        } )
    } );
    var filtro = $( "select option:selected" ).val();
    queryres(filtro)
});
    function queryres(filtro){
        console.log(filtro);
        $.ajax( {
            type: "POST",
            url: "../PHP/sendValue.php",
            dataType: "json",
            data: {'query': filtro},
            success: function (response) {
                //essendo una grid container creo un div per ogni risultato e lo appendo
                var lenght = response.length;
                //in base alla lenght creo div
                // elimino quello precendente e ne creo un altro.
                $(".reSTATS").remove();
                for (var i = 0; i < lenght; i++) {
                    var div = document.createElement( "div" );
                    div.className="reSTATS"
                    div.innerHTML = response[i].data;
                    document.getElementById( "grid-container" ).appendChild( div );

                    var div1 = document.createElement( "div" );
                    div1.className="reSTATS"
                    div1.innerHTML = response[i].peso0;
                    document.getElementById( "grid-container" ).appendChild( div1 );

                    var div2 = document.createElement( "div" );
                    div2.className="reSTATS"
                    div2.innerHTML = response[i].imc;
                    document.getElementById( "grid-container" ).appendChild( div2 );

                    var div3 = document.createElement( "div" );
                    div3.className="reSTATS"
                    div3.innerHTML = response[i].fabbisogno;
                    document.getElementById( "grid-container" ).appendChild( div3 );

                    var div4 = document.createElement( "div" );
                    div4.className="reSTATS"
                    div4.innerHTML = response[i].pesoX
                    document.getElementById( "grid-container" ).appendChild( div4 );
                }
            }, error: function (response) {
                console.log( response );
            }
        } );
    }

    //});
//});