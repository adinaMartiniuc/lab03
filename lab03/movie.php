<!DOCTYPE html>
<!-- Autrice Martiniuc Adina matricola 865044 -->
<!-- ho cambiato il file dell'esercizio due mettendo il codice php per il loading dinamico di foto rating nomi etc -->
<html lang="en">
    <?php
    $movie = $_GET['film']; 
    $linea = file($movie . "/info.txt", FILE_IGNORE_NEW_LINES); // ogni riga viene salvata in un array 
    // uso il parametro FILE_IGNORE_NEW_LINES per ridurre il numero di righe vuote nel vettore linea
    ?>
	<head>
		<title><?= "$linea[0]" ?> - Rancid Tomatoes</title>
    <link href="http://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif" rel="icon">
		<meta charset="UTF-8">
		<link href="movie.css" type="text/css" rel="stylesheet">
	</head>
    <body>
      	<div id = "nav">
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
        </div>
        <h1><?= "$linea[0] ($linea[1])" ?></h1>
        <div id = "content">
          	<div id = "right_side">
				<div>
					<img src="<?= $movie ?>/overview.png" alt="general overview">
				</div>
				<dl>
                 <?php
                    // uso ciclo foreach che permette di ciclare array senza effettuare controlli sulla loro dimensione
                    foreach (file($movie . "/overview.txt") as $overview) {
                        $explanation = explode(":", trim($overview));
                ?>                        
                            <dt><?= "$explanation[0]" ?></dt>
                            <dd><?= "$explanation[1]" ?></dd>                        
                <?php } ?>
				</dl>
			</div> <!-- close "right_side" -->
            <?php
				// glob identifica tutti i files che iniziano con review
				//count conta il numero di review
				$view = glob($movie . "/review*.txt");
				$nView = count($view);
				$allView = $nView;
            ?>
            <div id = "left_side">
				<div id ="percent_ban">
					<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/<?= ($linea[2] >= 60 ? "freshbig" : "rottenbig"); ?>.png" alt="Rotten">
                    <span id="vote"><?= "$linea[2]" ?>%</span>
				</div>
                
                <?php                                                          
                    if ($allView > 10) {
                        $nView = 10;
                    }
                    // se il numero di review è pari ne pongo metà a sinistra e l'altra metà a destra
                    if ($nView % 2 == 0) {
                        $par = $nView / 2;
                    } else {
                        $par = (int) ($nView / 2) + 1;
                    }
                    for ($w = 0; $w < $nView; $w++) {
       			                   if ($w == 0){
       			?>
                <div id="col">
                    <div id="col_left">
					<?php 
       					} else 
							if ($w == $par) {
       				?>            
                    </div> <!-- close "col_left" -->
                    <div id = "col_right">
					<?php
       					}
       					/* 
       					* salvo nel vettore review i campi che compongono una sola recensione 
                                        * uso strtolower per convertire in minuscolo una stringa per riuscire a trovare la giusta immagine
                                        * uso ucfirst per convertire in maiuscolo la prima lettera della prima parola
					*/
                        $review=file($view[$w], FILE_IGNORE_NEW_LINES);
                    ?>
                        <p class="recensione">
							<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/<?= strtolower($review[1]) ?>.gif" alt="<?= ucfirst(strtolower($review[1])) ?>">
							<q><?= "$review[0]" ?></q>
						</p>
						<p class="autor">
							<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
								<?= "$review[2]" ?> <br>
							<span  ><?= "$review[3]" ?></span>
						</p>
                    <?php } ?>
					</div>
                </div> 
            </div> 
			<p id="num_pages">(1-<?= "$nView" ?>) of <?= "$allView" ?></p>
		</div><!-- close "content" -->
		<div id="validation">
			<a href="https://validator.w3.org/">
				<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/w3c-xhtml.png" alt="Validate">
			</a>
			<br>
			<a href="https://jigsaw.w3.org/css-validator/">
				<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!">
			</a>
		</div> <!-- close validation" -->
	</body>
</html>
