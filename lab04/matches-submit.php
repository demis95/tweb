<?php
$name = $_REQUEST['name'];
//cilco per trovare utente nel file
//quindi parso il file con la funzione file
$LineeFile=file("singles.txt");
$i=0;
$find=false;
    while($i<count($LineeFile) && $find==false){
        $ArrayUtente = explode(",",$LineeFile[$i]);
        if($name==$ArrayUtente[0]){
            $find=true; //trovato il nome nel fine mi fermo dalla scansione
            list($name,$gender,$age,$personality,$os,$minAge,$maxAge)=$ArrayUtente;
        }
        $i++;
    }  
?>
<html>
<?php include "top.html"; ?>
<head></head>
    <body>
        <h1>Matches for <?=$name = $_REQUEST['name']; ?> </h1>
            <div class ="match">
                <?php
                //codice per partner ideale:
                    foreach(file("singles.txt") as $persona){
                        list($nameMatch,$gendMatch,$ageMatch,$persMatch,$osMatch,$minMatch,$maxMatch)=explode(",",$persona);
                        if(($name!=!$nameMatch) && ($gendMatch!=$gender) && ($os==$osMatch) && ($ageMatch>=$minAge) && ($ageMatch<=$maxAge)){
                    
                            //controllo la personalità
                            $p =str_split($personality);
                            $pM = str_split($persMatch);
                            $match=0;
                            for($y=0; $y<count($p); $y++){
                                if ($p[$y]==$pM[$y]){
                                    $match=$match+1;
                                }      
                            }
                            //se ho match stampo
                            if($match>0){
                ?>
                <p>
                    <img src="https://courses.cs.washington.edu/courses/cse190m/12sp/homework/4/user.jpg" alt="user">
                    <?= $nameMatch ?>
                    <ul>    
                        <li><strong>gender:</strong><?= $gendMatch ?></li>
                        <li><strong>age:</strong> <?= $ageMatch ?></li>
                        <li><strong>type:</strong> <?= $persMatch ?><li>
                        <li><strong>OS:</strong> <?= $osMatch ?></li>
                    </ul>           
                </p>
                <?php
                            }
                        }
                    }
                ?>
            </div>      
    </body>
    <?php include "bottom.html"; ?>
</html>



