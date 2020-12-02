<?php
header("Content-type:application/json");


//creo connessione al db tramite oggetto PDO
//dbserver:dbname=[dbname];host=[hostname]:[port] sintassi stringa connessione


    //$db = new PDO($connect_str,"root","");
    try {
        $db = new PDO("mysql:dbname=imdb_small;host=localhost:3306","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        die(json_encode(array('info' => array('firstname' => $_REQUEST["firstname"], 'lastname' => $_REQUEST["lastname"]),'error' => array('message' => 'database auth error','exception' => $ex->getMessage()))));
    }
    if (!isset($_REQUEST["firstname"]) || !isset($_REQUEST["lastname"]))
    die(json_encode(array('info' => array('firstname' => $_REQUEST["firstname"], 'lastname' => $_REQUEST["lastname"]),'error' => array('message' => 'incorrect data received from client','errCode' => 'noParam'))));


    
    $firstname = $db->quote($_REQUEST["firstname"]. "%");
    $lastname = $db->quote($_REQUEST["lastname"]);
    $id = idActor($firstname,$lastname);


    if (isset($_REQUEST["all"]) && $_REQUEST["all"] == "true"){
        entire_list($id);
    }else{
        testBacon($id);
    }



function entire_list($id){
    global $db;
    #scrivere una query che restituisca la lista di tutti i film di un dato attore che abbiamo nel database.
    #uso l'id calcolato dalla funzione idActor
    $queryres= $db->query("SELECT movies.name FROM movies join roles on movies.id=roles.movie_id join actors on roles.actor_id=actors.id WHERE actors.id='$id'");
    echo json_encode(array('info' => array('firstname' => $_REQUEST["firstname"], 'lastname' => $_REQUEST["lastname"]), 'data' => $queryres->fetchAll()));
}

function idActor($firstname,$lastname){
    #trova l'ID per il dato attore
    global $db;
    /*
    bozza query:

    gestire ambiguita?
    cosi seleziono gli id degli attori con stessi nomi, ma scelgo quello con piu film e id piu basso
    select distinct id FROM actors join roles on actor.id=roles.actor_id where last_name=$lastname and first_name LIKE $firstname
    ORDER BY film_count,id;
    successivamente prendo solo la prima riga

    */
    $query = $db->query("SELECT DISTINCT id FROM actors JOIN roles on actors.id=roles.actor_id WHERE last_name=$lastname AND first_name LIKE $firstname ORDER BY film_count,id;");
    if ($query->rowCount() == 0) {
        die(json_encode(array('info' => array('firstname' => $_REQUEST["firstname"], 'lastname' => $_REQUEST["lastname"]),'error' => array('message' => 'no such actor in the database','errCode' => 'noActor'))));
    }
    return $query->fetch()["id"];

}

function testBacon($id){
    global $db;
    //id bacon= 22591
    //trovare tutti i film dell'attore in cui compare anche Kevin Bacon
    $query = $db->query("SELECT movies.name,movies.year 
    FROM roles as rolesact1 
    JOIN roles as rolesact2 on rolesact1.movie_id=rolesact2.movie_id JOIN movies on rolesact1.movie_id=movies.id 
    WHERE rolesact1.actor_id='22591' and rolesact2.actor_id=$id");
     echo json_encode(array('info' => array('firstname' => $_REQUEST["firstname"], 'lastname' => $_REQUEST["lastname"]), 'data' => $query->fetchAll()));
    
}



?>