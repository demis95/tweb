<!DOCTYPE html>

<!--------------------------------------------------------------------------------------------------
Title: Movie.php
Autore: Demis Mazzotta
Original: soluzione tmnt.html from lab02
Last Modified: Oct 30 12:58
--------------------------------------------------------------------------------------------------->

<?php
    #----funzione per decidere l'immagine della recensione (fresh o rotten)
    function reviewImage($tipo){
    if(strcmp($tipo,"ROTTEN")<0){
        print "https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/fresh.gif";
        }else{
            print "https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif";
        }
	} //---fine funzione reviewImage

	$movie = $_GET["film"];
	list($titolo,$anno,$rating) = file($movie.'/info.txt',FILE_IGNORE_NEW_LINES);

	//impostare l'immagine variabile in base al rating 

	if( $rating>=60){
    	$rating_image = "https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/freshbig.png";
	}else{
    	$rating_image = "https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rottenbig.png";
	}

	
	//	procedimento per acquisire i path delle recensioni e contarne il numero
	
	$array_reviews = glob($movie.'/review*.txt');
	$n_recensioni=count($array_reviews);
	if($n_recensioni<=10){
		
		//approssimo la metà se dispari per eccesso con la funzione round:
		//  se  7---> 4sx - 3dx
		//	se  8---> 4sx - 4dx
		//	stabilisco i numero max di recensioni per colonna in base alle recensioni totali
		
		$limiteSX = round($n_recensioni/2);
		$limiteDX = $n_recensioni;

	}else{

		$limiteSX=5;
		$limiteDX=10; 
		
		//soluzione molto orribile e discutibile
		//dato che poi sarebbe da rigestire il tutto 
		//per esempio in una seconda pagina di recensioni 
	}
		
?>

<html lang="en">
	<head> 
		<title>Rancid Tomatoes</title>
		
        <link href="http://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif" rel="icon">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="movie.css" type="text/css" rel="stylesheet">
	</head>

    <body>  
		<div id = "banner">
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
		</div>
                
		<h1><?=$titolo." ".$anno ?></h1>
                
        <div id = "main"> <!-- il div "main" e' stato aggiunto per contenere 
            					sia la componente sinistra e destra del layout -->
            <div id = "right">
				<div>
				<img src = <?= $movie.'/overview.png' ?> alt="general overview">
				</div>
				<dl>
				
				<?php
				
				// overview_film acquisisce l'intero contenuto del file overview.txt
				// ciclo for per acquisire e smistare gli elementi nella sezione general overview

				$overview_film =file($movie.'/overview.txt',FILE_IGNORE_NEW_LINES);
				for($i = 0; $i <count($overview_film); $i++){
					$overview_explode=explode(":",$overview_film[$i]);
				?>
					<dt><?=$overview_explode[0]?></dt>
					<dd><?=$overview_explode[1]?></dd>
				<?php
					}
				?>
				
				</dl>
                   
            </div> <!-- chiusura div "right" -->
            <div id = "left">
				<div id ="left-top">
					<img src=<?=$rating_image?> alt="Rotten">
                    <span class="evaluation"><?=$rating?>%</span>
				</div>
                <div id="columns">
                    <div id="leftcolumn"> 
					<?php
				
					
					//Ciclo di stampa review nella colonna SX, sfruttando i limiti precendentemente dichiarati

					for($i=0; $i<$limiteSX; $i++){
						list($recensione,$tipo,$autore,$produzione) = file($array_reviews[$i],FILE_IGNORE_NEW_LINES);
						?>
						<p class="quotes">

						<!-- sostituisco le recensioni con il contenuto delle variabili
						  $recensione	<-- la recensione
						  $tipo			<-- rotten/fresh. va anche a sostituire l'alt dell'immagine
						  $autore		<-- l'autore della recensione
						  $produzione	<-- società/testata giornalistica dell'autore
						-->

                			<span >
								<img src= <?=reviewImage($tipo) ?> alt=<?="$tipo" ?>>
								<q> <?= $recensione ?> </q>
							</span>
						</p>
						<p class="reviewers">
							<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
							<?= $autore ?> <br>
                        	<span class="publications"><?= $produzione ?></span>
						</p>
					<?php

					}//fine ciclo

					?>

                    </div> <!-- chiusura div "leftcolumn" -->
                    <div id = "rightcolumn">
					<?php

					//Ciclo di stampa review nella colonna DX, sfruttando i limiti precendentemente dichiarati

        			for($i=$limiteSX; $i< 10; $i++){
						if (isset($array_reviews[$i])){
						list($recensione,$tipo,$autore,$produzione) = file($array_reviews[$i],FILE_IGNORE_NEW_LINES);
            		?>
						<p class="quotes">
						<img src= <?=reviewImage($tipo) ?> alt=<?="$tipo" ?>>
						<q> <?= $recensione ?></q>
						</p>
						<p class="reviewers">
							<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
							<?= $autore ?> <br>
                        	<span class="publications"><?= $produzione ?></span>
						</p>

						<?php
						}
					}//fine ciclo

					?>

                    </div> <!-- chiusura div "rigthcolumn" -->
                </div> <!-- chiusura div "columns" -->
            </div> <!-- chiusura div "left" -->
            
			<p id="bottom">(1- <?=$limiteDX?>) of <?=$n_recensioni?> </p>
            
        </div><!-- chiusura div "main" -->
		<div id="validators">
			<a href="http://validator.w3.org/check/referer">
				<img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png " alt="Valid HTML5!">
			</a>			
			<br>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!">
			</a>
		</div> <!-- chiusura div "validators" -->
	</body>
</html>
