<?php

    include 'connect.php';

    $username = !empty($_POST['uname']) ? trim($_POST['uname']) : null;
    $pass = !empty($_POST['psw']) ? trim($_POST['psw']) : null;

    if((isset($_POST["uname"])) && (isset($_POST["psw"]))) {

        //allora proseguo con la procedura di login
        //$username = empty($_POST["username"]);
        //$pass = empty($_POST["password"]);

        //gestisco XSS con funzione strips_tags
        $username = strip_tags($username);
        $pass = strip_tags($pass);
        $passEnc = md5($pass);

        //per quanto riguarda i parametri, il bind value svolge una funzione simile al 'quote'
        //concede solamente il % e il _


        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        //controllo se è presente
        if ($result) {
            if ($result['username'] === $username && $result['password'] === $passEnc) {
                if (isset($_SESSION)){
                    if(isset($_SESSION["currentPage"])){
                        $currentPage = $_SESSION["currentPage"];
                    }else{
                        $currentPage = NULL;
                        unset($currentPage);
                    }
                    session_destroy();
                    session_start();
                    //in questo modo se ho dati che non dovrei avere, resetto tutto e restarto la session
                }
                $_SESSION['username'] = $username; //addo l'utente alla sessione
                $_SESSION['email'] = $result['email'];
                if(isset($currentPage)){
                    $output = array('res' => 1 ,'page' => $currentPage,'text' => "hai effettuato il login");
                    //$_SESSION["flash"]="hai effettuato il login";

                    //redirect($currentPage,"Hai effettuto il Login");
                    print json_encode($output);
                }else{
                    $output = array('res' => 1 ,'page' => "home.php",'text' => "hai effettuato il login");
                    //redirect("home.php","Hai effettuato il Login");
                    //$_SESSION["flash"]="hai effettuato il login";
                    print json_encode($output);
                    //redirect("home.php","Hai effettuato il Login");
                }
            } else {
                $output = array('res' => 0 ,'page' => "index.php",'text' => "utente e/o password errati");
                session_destroy();
                session_start();
                //$_SESSION["flash"]="utente e/o password errati ";
                print json_encode($output);
                //redirect("index.php","utente e/o password errati ");
            }
        }else{
            //sono nel caso in cui la query non ritorna, probabilmente utente inesistente
            $output = array('res' => -1 ,'page' => "register.php",'text' => "utente non registrato, registrati qui!");
            //session_start();
            //$_SESSION["flash"]="utente non registrato, registrati qui!";
            print json_encode($output);
            //redirect("register.php","utente non registrato, registrati qui!");
        }
    }else{
        //vuol dire che in qualche modo l'utente ha inviato qualcosa di null
        //non dovrebbe mai arrivare qui, ma se lo fa...
    }
?>
