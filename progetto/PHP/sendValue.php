<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
require 'connect.php';
 //inizializzo una variabile ospite per ovviare ad un grosso problema di query automatiche.
$pesocheck="/^([3-9][0-9]|[0-1][0-1][0-9]|[0-1][2][0])$/"; //"/^([3-9][0-9])$/";
if(isset($_SESSION["username"])) {
    $name = $_SESSION["username"];
    $guest=0;
    $id=getID($name,$pdo);
    $date = date('Y-m-d');
    // controllo se la data e' uguale o diversa, in base a cio faccio update o insert.
    $dateentry=dateServer($id,$pdo,$date);
}else{
    $guest=1;
    //soluzione molto scomoda, ma dovrei riscrivere tutto e ho capito il problema
    //ma non posso stravolgere tutta la parte di backend per questo errore di progettazione
}

//questo mega if e' schifoso lo so. ma gestisto le varie chiamate da fare con i vari print json.
//in base a se si tratta di IMC, FABBISOGNO ENERGETICO , pagina statistiche ecc.
    if(isset($_GET["imc"])) {
        $peso0 = $_GET["peso0"];
        $imc = $_GET["imc"];

        if (preg_match($pesocheck,$peso0)==0) {
            print json_encode("Inserisci dei valori peso CORRETTI");
        }else {
            if ($guest == 1) {
                print json_encode($imc);
            } else if ($dateentry == true && $guest == 0) {
                updateStatisticheIMC($imc, $peso0, $id, $pdo);

            } else if ($dateentry == false && $guest == 0) {
                insertStatisticheIMC($imc, $peso0, $id, $pdo);
            }
        }
    }else if (isset($_GET["fabbisogno"])) {

            $pesoX = $_GET["pesoX"];
            $fabbisogno = $_GET["fabbisogno"];
            if(preg_match($pesocheck,$pesoX)==0){
                print json_encode("inserisci valori Peso corretti");
            }else{
                if ($guest == 1) {
                    print json_encode($fabbisogno);
                } else if ($dateentry == true && $guest == 0) {
                    updateStatisticheMB($fabbisogno, $pesoX, $id, $pdo);
                } else if ($dateentry == false && $guest == 0) {
                    insertStatisticheMB($fabbisogno, $pesoX, $id, $pdo);
                }
            }
    } else if (isset($_POST["query"])) {
        $val=$_POST["query"];
            //eseguo codice per get stats utente
            querystats($id, $pdo,$val);
    }

function getID($name,$pdo){
    $sqlGetID="SELECT id FROM users WHERE username=:username";
    $stmt=$pdo->prepare($sqlGetID);
    //print($name);
    $stmt->bindValue(':username', $name);
    $stmt->execute();
    if($stmt){
        $riga=$stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($riga);
        $id=$riga['id'];
        //var_dump($id);
        return $id;
    }else{
        return $stmt;
    }

}


    function querystats($id,$pdo,$val){
        //if($val==)
        if($val=="dataD"){
            $query="SELECT * FROM statisticheutente WHERE idUtente = :id ORDER BY data DESC";
        }else if($val=="dataC"){
            $query="SELECT * FROM statisticheutente WHERE idUtente = :id ORDER BY data ASC";
        }else if($val=="peso0d"){
            $query="SELECT * FROM statisticheutente WHERE idUtente = :id ORDER BY peso0 DESC";
        }else if($val=="peso0c"){
            $query="SELECT * FROM statisticheutente WHERE idUtente = :id ORDER BY peso0 ASC";
        }
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        //print json_encode("encoded");
        $i=0;
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $results[$i] = $row;
                $i++;
            }
            echo json_encode($results);
        }else{
            echo json_encode("query non eseguita");
        }
    }

    function dateServer($id,$pdo,$date){
        //controllo se la data dell'ultima entry della tabella e' uguale a quella nel momento in cui si chiama la funzione

        $check ="SELECT data FROM statisticheutente WHERE idUtente=:id
                ORDER BY data DESC
                LIMIT 1";
        $stmt= $pdo->prepare($check);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if($result['data']==$date){
            //print json_encode("ciao");
            //print("data uguale");
            return true;
        }else{
            //print json_encode("ciao");
            //print("data diversa");
            return false;
        }
    }


    function updateStatisticheIMC($imc,$peso0,$id,$pdo) {
            //fa un update dei valori del IMC passati tramite ajax
        $date = date('Y-m-d');
        $update ="UPDATE statisticheutente SET imc =:imc, peso0 =:peso0 WHERE statisticheutente.idUtente =:id AND data=:date";
        //print ($imc);
        $stmt1 = $pdo->prepare($update);
        $stmt1->bindValue(':imc', $imc);
        $stmt1->bindValue(':peso0', $peso0);
        $stmt1->bindValue(':id', $id);
        $stmt1->bindValue(':date',$date);
        $stmt1->execute();
        if ($stmt1){print json_encode($imc);}else(print json_encode("error db"));
    }

    function insertStatisticheIMC($imc,$peso0,$id,$pdo){
        // fa una insert creando direttamente una nuova riga con data e valori.
        $date = date('Y-m-d');
        $insert="INSERT INTO statisticheutente (idUtente,data,peso0,imc) VALUES (:id,:data,:peso0,:imc)";
        $stmt = $pdo->prepare($insert);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':data',$date);
        $stmt->bindValue(':peso0',$peso0);
        $stmt->bindValue(':imc',$imc);
        $stmt->execute();
        if ($stmt){print json_encode($imc);}else(print json_encode("error DB"));

    }
    function updateStatisticheMB($fabbisogno,$pesoX,$id,$pdo){
        /*
         * update dei valori del fabbisogno e del peso obiettivo
         */
        $date = date('Y-m-d');
        $update ="UPDATE statisticheutente SET fabbisogno =:fabbisogno, pesoX=:pesoX WHERE statisticheutente.idUtente=:id AND data=:date";
        $stmt=$pdo->prepare($update);
        $stmt->bindValue(':fabbisogno',$fabbisogno);
        $stmt->bindValue(':pesoX', $pesoX);
        $stmt->bindValue(':date',$date);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if ($stmt){print json_encode($fabbisogno);}else(print json_encode("error db"));
    }
    function insertStatisticheMB($fabbisogno,$pesoX,$id,$pdo){
        $date = date('Y-m-d');
        $insert="INSERT INTO statisticheutente (idUtente,data,pesoX,fabbisogno) VALUES (:id,:data,:pesoX,:fabbisogno)";
        $stmt = $pdo->prepare($insert);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':data',$date);
        $stmt->bindValue(':pesoX',$pesoX);
        $stmt->bindValue(':fabbisogno',$fabbisogno);
        $stmt->execute();
        if ($stmt){print json_encode($fabbisogno);}else(print json_encode("error DB"));

    }
?>

