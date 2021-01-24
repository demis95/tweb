<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */

//file contenente funzioni per la ricezione e l'invio dei dati utente
$name=$_SESSION['username'];


function getID($name,$pdo){
    $sqlGetID="SELECT id FROM users WHERE username=:username";
    $stmt=$pdo->prepare($sqlGetID);
        //print($name);
        $stmt->bindValue(':username', $name);
        $stmt->execute();
        $riga=$stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($riga);
        $id=$riga['id'];
        //var_dump($id);
        return $id;
}

function checkdata($id,$pdo){
    $rows=datareceive($id,$pdo);
    //print_r($rows);
    $registered=1;
    //essendo che non voglio controllare l'id ma tutto il resto, faccio un array shift
    $shiftedData = array_shift($rows);
    //print_r($rows);
    foreach($rows as $data =>$data_value){
        if($data_value!==NULL){
            $registered=$registered*1;
        }else{
            $registered=$registered*0;
        }
    }
    return $registered;
}
function datareceive($id,$pdo){
    //se i check sono ok, allora query per ricevere dati from DB
    $sqldatacheck="SELECT * FROM dati_utente WHERE ref_user=:id";
    $stmt=$pdo->prepare($sqldatacheck);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $rows=$stmt->fetch(PDO::FETCH_ASSOC);

    return $rows;

}
?>