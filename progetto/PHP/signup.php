<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
include 'connect.php';


 //Retrieve the field values from our registration form.
 $username = !empty($_POST['unamer']) ? trim($_POST['unamer']) : null;
 $pass = !empty($_POST['pswr']) ? trim($_POST['pswr']) : null;
 $email=!empty($_POST['emailr']) ? trim($_POST['emailr']) : null;
    $echeck="/^\S+@\S+\.\S+$/";
    $ucheck ="/^\S+$/";
    $username = strip_tags($username);
    $pass = strip_tags($pass);
    if(preg_match($echeck,$email)==0){
        $output = array('res' => -1 ,'page' => "register.php",'text' => "mail inserita non valida");
        print json_encode($output);
        exit;
        //redirect("register.php","email inserita non valida");
    }else if(preg_match($ucheck,$username)==0){
        $output = array('res' => -1 ,'page' => "register.php",'text' => "username inserito non valido");
        print json_encode($output);
        exit;
        //redirect("register.php","username inserito non valido");
    }else{
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        if($pdo) {
            $stmt->bindValue(':username', $username);
            //Execute.
            $stmt->execute();
            //Fetch the row.
            if ($stmt) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['num'] > 0) {
                    //header('refresh:2; url=register.php');
                    //$_SESSION["flash"] = "Utente gia registrato, effettua il login";
                    $output = array('res' => -2, 'page' => "index.php", 'text' => "utente gia registrato");
                    print json_encode($output);
                    //print('utente gia registrato');
                    exit;
                }else {
                    $sql = "INSERT INTO users (username, password,email) VALUES (:username, :password, :email)";
                    $stmt = $pdo->prepare($sql);
                    $pass = md5($pass);
                    //Bind our variables.
                    $stmt->bindValue(':username', $username);
                    $stmt->bindValue(':password', $pass);
                    $stmt->bindValue(':email', $email);

                    //Execute the statement and insert the new account.
                    $result = $stmt->execute();
                    if ($result) {

                        /*
                        * fix vincoli database, primo try:
                        * oltre a creare l'utente creo direttamente le latre entry nelle tablelle datiutente e statistiche utente
                        * teoricamente dovrei fixare il missing reference che avrei all'avvio
                        */
                        $id = getID($username, $pdo);
                        $bool = createEntrydati_Utente($pdo, $id);
                        if ($bool == true) {
                            //$_SESSION["flash"] = "Registrazione avvenuta con successo. effettua il login";
                            $output = array('res' => 1, 'page' => "index.php", 'text' => "Registrazione avvenutacon successo. effettua il login");
                            print json_encode($output);
                            exit;
                        } else {
                            //$_SESSION["flash"] = "Errore creazione tabelle ausiliarie";
                            $output = array('res' => 0, 'page' => "register.php", 'text' => "Errore Registrazione Utente");
                            print json_encode($output);
                        }


                        //header('refresh:2; url=index.php');
                        //echo 'grazie per esserti registrato, verrai reindirizzato automaticamente verso la pagina di login';

                    } else {
                        //$_SESSION["flash"] = "Errore Registrazione Utente";
                        $output = array('res' => 0, 'page' => "register.php", 'text' => "Errore Registrazione Utente");
                        //print("errore insert utente");
                        print json_encode($output);
                    }
                }
            }else{
                    // non torna nessuna count quindi prob db error
                    $output = array('res' => 0 ,'page' => "register.php",'text' => "Errore comunicazione server");
                    print json_encode($output);
            }
        }else{
            //pdo fail
            $output = array('res' => 0 ,'page' => "register.php",'text' => "Errore comunicazione server");
            print json_encode($output);
        }
    }

    function getID($name,$pdo){
    $sqlGetID="SELECT id FROM users WHERE username=:username";
    $stmt=$pdo->prepare($sqlGetID);
    $stmt->bindValue(':username', $name);
    $stmt->execute();
    $riga=$stmt->fetch(PDO::FETCH_ASSOC);
    $id=$riga['id'];
    return $id;
    }
    function createEntrydati_Utente($pdo,$id){
        $q="INSERT INTO dati_utente (ref_user) VALUE (:id)";
        $stmt = $pdo->prepare($q);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if($stmt){
            return $bool=createEntrystatistiche($pdo,$id);
        }else{
            return false;
        }
    }

    function createEntrystatistiche($pdo,$id){
        $date = date('Y-m-d');
        $q = "INSERT INTO statisticheutente (idUtente ,data) VALUES (:id,:data)";
        $stmt= $pdo->prepare($q);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':data',$date);
        $stmt->execute();
        if($stmt){
            return true;
        }else{
            return false;
        }
    }
    //include "bottom.html";
?>