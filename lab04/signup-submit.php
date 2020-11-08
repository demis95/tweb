<?php
    //acquisisco i valori passati dal POST
    $name = $_REQUEST['name'];
    $gender = $_REQUEST['gender'];
    $age = $_REQUEST['age'];
    $personality = $_REQUEST['personality'];
    $os = $_REQUEST['favoriteOS'];
    $ageMin = $_REQUEST['min'];
    $ageMax = $_REQUEST['max'];
    $i=0;
    foreach($_REQUEST as $param => $dati){
        $dataArray[]= $dati;
    }
    //copio i dati acquisiti dentro al file singles.txt
    $dataToFile =implode("," , $dataArray)."\n";
    file_put_contents("singles.txt",$dataToFile,FILE_APPEND);
?>

<html>
<?php include "top.html"; ?>
    <head>
    </head>
    <body>
        <h1> Thank you! </h1>
        <p>
            Welcome to NerdLuv , <?= $name ?>
        </P>
        <p>
            Now <a href="matches.php">log in to see your matches!</a>
        </p>
    </body>
    <?php include "bottom.html"; ?>
</html>
