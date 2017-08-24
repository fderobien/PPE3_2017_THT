<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageIndex = new pageSecurisee ( "Bienvenue sur THT..." );
} else {
	$pageIndex = new pageBase ( "Bienvenue sur THT..." );
}

$pageIndex->contenu = '<section>
		<article>
			<img src="./Image/trail4.jpg" alt="photos de 4 coureurs"> 
		</article>	
	</section>';
				

$pageIndex->afficher ();

?>


