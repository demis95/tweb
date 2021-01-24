<?php

/*
CREATE TABLE IF NOT EXISTS users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  password varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  email varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT keylog UNIQUE(username,email)
);
*/


/**
 * Start the session.
 */
session_start();
 
/**
 * Include ircmaxell's password_compat library.
 */
//require 'lib/password.php';
 
/**
 * Include our MySQL connection.
 */
require 'connect.php';
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['uname']) ? trim($_POST['uname']) : null;
    $pass = !empty($_POST['psw']) ? trim($_POST['psw']) : null;
    $email=$_POST['email'];
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC); //ottengo un array associativo
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        $_SESSION['messages'][]="L'utente è già presente nel database, inseriscine uno nuovo o vai al Login";
        print("errore");
        //header('Location:register.php');
        exit;
    }else{
        //Hash the password as we do NOT want to store our passwords in plain text.
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
        //Prepare our INSERT statement.
        $sql = "INSERT INTO users (username, password,email) VALUES (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);
        
        //Bind our variables.
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':email',$email);
    
        //Execute the statement and insert the new account.
        $result = $stmt->execute();

        if($result){



            //What you do here is up to you!
            echo 'Thank you for registering with our website.';
        }
    }
    
    
?>