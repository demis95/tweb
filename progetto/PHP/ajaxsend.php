
<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
require 'connect.php';
$name=$_SESSION['username'];
$id=getID($name,$pdo);
$ret=InsertData($pdo,$id);

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

    function InsertData($pdo,$id){
        $agecheck ="^/(0?[1-9]|[1-9][0-9])$/";
        $pesocheck="^/([3-9][0-9])$/";
        $echeck="/^\S+@\S+\.\S+$/";
        $error=0;
        //print($data);
        $email=($_POST['email']);
        if(preg_match($echeck,$email)==0){
            $_SESSION["flash"]="mail inserita non valida";
            $error=1;}
        $altezza=($_POST['altezza']);
        $genere=($_POST['genere']);
        $eta=($_POST['eta']);
        if(preg_match($agecheck,$eta)==0){
            $_SESSION["flash"]="eta' inserita non valida";
            $error=1;}
        $peso0=($_POST['peso0']);
        if(preg_match($pesocheck,$peso0)==0){
            $_SESSION["flash"]="peso attuale inserito non valido";
            $error=1;}
        $pesoX=($_POST['pesoX']);
        if(preg_match($pesocheck,$pesoX)==0){
            $_SESSION["flash"]="peso obiettivo inserito non valido";
            $error=1;
        }
        if($error==1){
            print json_encode($_SESSION["flash"]);
        }else{
            $sqlupdate="UPDATE dati_utente SET email= :email, Altezza = :altezza,genere =:genere,eta=:eta,peso0=:peso0,pesoX=:pesoX WHERE ref_user=:id";
            $stmt2=$pdo->prepare($sqlupdate);
            //cazzata, la mail la tengo gia in registrazione, devo prelevarla dalla table users :/
            $stmt2->bindValue(':email', $email);
            $stmt2->bindValue(':altezza', $altezza);
            $stmt2->bindValue(':genere', $genere);
            $stmt2->bindValue(':eta', $eta);
            $stmt2->bindValue(':peso0', $peso0);
            $stmt2->bindValue(':pesoX', $pesoX);
            $stmt2->bindValue(':id', $id);
            $stmt2->execute();
            if(isset($stmt2)){
                //da migliorare pagina datasend.php per avere un aspetto migliore dopo il send dei dati
                $_SESSION["flash"]="dati inviati correttamente";
                print json_encode("query success");

                //header( "refresh:3;url=progressi.php" );
            }else{
                $_SESSION['flash']="dati non inviati";
                print json_encode("error");
            }
        }

    }
?>