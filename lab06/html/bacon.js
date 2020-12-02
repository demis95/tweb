//codice per visualizzare i risultati
$(document).ready(function(){
    $("#results").hide(); //tengo i rusltati nascosti inizialmente
    $("input[name='submit']").on("click",request);
});


function request(){
    var name;
    var lastname;
    name=$(this).siblings("[name='firstname']").val();
    lastname=$(this).siblings("[name='lastname']").val();
    var stringanomi = "firstname=" + $(this).siblings("input[name='firstname']").val() + "&lastname=" + $(this).siblings("input[name='lastname']").val();
    console.log(stringanomi);
    //devo distinguere le due richieste: se all, o se solo kevin bacon
    //controllo il parent id? dovrebbero essere due parent

    if((this.parentNode.parentNode.id)=="searchall"){
        console.log("searchAll");
        //richesta ajax full
        $.ajax({
            url:"common.php?"+stringanomi+"&all=true",
            type:"GET",
            datatype: "json",
            success: showResults,
            }
        );
    }else{
        //richiesta ajax Kavin Bacon
        console.log(name);
        console.log(lastname);
        console.log("searchkevin");
        $.ajax({
            url:"common.php?"+stringanomi,
            type:"GET",
            datatype: "json",
            success: showResults,
            }
        );
        
    }
}


function showResults(json){
    //stampo i risultati sotto il div #results
    //avrò due colonne, name e year
    $("#list").empty();
    $("#results").show();
    $("#errMsg").html("");
    $("#firstN").html(json.info.firstname);
    $("#lastN").html(json.info.lastname);

    //populate the table with the result from the server
    let i = 0;
    json.data.forEach(function(obj) {
        i++;//okay che siamo programmatori, ma la gente normale inizia a contare da 1
        $('#list').append('<tr><td>'+i+'</td><td>'+obj.name+'</td><td>'+obj.year+'</td></tr>');
    });


}