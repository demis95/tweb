window.onload =eventi;

function eventi(){

    document.getElementById("formmetabolismo").addEventListener("submit",function (event) {
        event.preventDefault();
        document.getElementById("CalorieButton").onclick=calcolometabolismo();

        //var calcolomet = document.getElementById("CalorieButton");
        //calcolomet.onclick=calcolometabolismo;
    });
}
function calcolometabolismo(){

    var pesoformaa = $('input[name="pesoformaa"]').val();
    var sessoo = $("#sessoselect option:selected").val();
    var eta = $('select[name=etaa] option:selected').val();
    var lavoro = $('select[name=lavoro] option:selected').val();
    var lavoroindex = $('select[name=lavoro] option:selected').index();
    var attivita = $('select[name=sport] option:selected').index();
    var metaabolismo=0;
    var cal=0;
    //var sessoo = sexo.options[sexo.selectedIndex].text;
    console.log(sessoo);
    console.log(pesoformaa);
    console.log(eta);
    console.log(lavoro);
    console.log(lavoroindex);
    console.log(attivita);

    if (sessoo == "Maschio")
    {
        if (eta=="18-29") metaabolismo= 15.3 * pesoformaa + 679;
        else if (eta=="30-59") metaabolismo= 11.6 * pesoformaa + 879;
        else if (eta=="60-74") metaabolismo= 11.9 * pesoformaa + 700;
        else if (eta=="74") metaabolismo= 8.4 * pesoformaa + 819;
    }

    //effettivamente posso usare l'index ed eviatare di scrivermi ogni valore dell'option
    if (lavoroindex==0) cal=metaabolismo*1.78;
    else if (lavoroindex==1) cal=metaabolismo*1.78;
    else if (lavoroindex==2) cal=metaabolismo*1.55;
    else if (lavoroindex==3) cal=metaabolismo*1.55;
    else if (lavoroindex==4) cal=metaabolismo*2.10;
    else if (lavoroindex==5) cal=metaabolismo*2.10;
    else if (lavoroindex==6) cal=metaabolismo*1.55;
    else if (lavoroindex==7) cal=metaabolismo*1.78;
    else if (lavoroindex==8) cal=metaabolismo*2.10;
    else if (lavoroindex==9) cal=metaabolismo*1.58;


    if (attivita==0) cal2=cal;
    else if (attivita==1) cal2= cal + ((1.5*pesoformaa*9.5)/7);
    else if (attivita==2) cal2= cal + ((4*pesoformaa*9.5)/7);
    else if (attivita==3) cal2= cal + ((6*pesoformaa*9.5)/7);


    if (sessoo == "Femmina")

    {
        if (eta=="18-29") metaabolismo= 14.7*pesoformaa+496;
        else if (eta=="30-59") metaabolismo=8.7*pesoformaa+829;
        else if (eta=="60-74") metaabolismo=9.2*pesoformaa+688;
        else if (eta=="74") metaabolismo=9.8*pesoformaa+624;
    }

    if (lavoroindex==0) cal=metaabolismo*1.78;
    else if (lavoroindex==1) cal=metaabolismo*1.78;
    else if (lavoroindex==2) cal=metaabolismo*1.55;
    else if (lavoroindex==3) cal=metaabolismo*1.55;
    else if (lavoroindex==4) cal=metaabolismo*2.10;
    else if (lavoroindex==5) cal=metaabolismo*2.10;
    else if (lavoroindex==6) cal=metaabolismo*1.55;
    else if (lavoroindex==7) cal=metaabolismo*1.78;
    else if (lavoroindex==8) cal=metaabolismo*2.10;
    else if (lavoroindex==9) cal=metaabolismo*1.58;

    if (attivita==0) cal2=cal;
    else if (attivita==1) cal2= cal + ((1.5*pesoformaa*9.5)/7);
    else if (attivita==2) cal2= cal + ((4*pesoformaa*9.5)/7);
    else if (attivita==3) cal2= cal + ((6*pesoformaa*9.5)/7);

    //soluzione piu semplice, setto la visibility della tablella e assegno i valori

    $.ajax({
        url:"../PHP/sendValue.php",
        type:"GET",
        dataType: "json",
        data    : {'fabbisogno':cal2,'pesoX':pesoformaa},
        success: function(response){
            document.getElementById("risultatometabolismo").value = metaabolismo;
            document.getElementById("risultatocalorie").value = response;
            var tableresults = document.getElementById("formapesoclass");
            tableresults.style.visibility="visible";
            document.getElementById("risultatocalorie").readOnly=true;
            document.getElementById("risultatometabolismo").readOnly = true;
        },error : function(response){
            console.log(response);
        }
    });
}