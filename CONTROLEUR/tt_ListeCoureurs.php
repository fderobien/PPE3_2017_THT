<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/CoureurModele.class.php');

$json = array(); //tableau pour stocker les coureurs
$monModele = new CoureurModele ();

if (isset($_GET['idEQU'])){
	//requete presente dans le modele qui retourne les coureurs propres a une equipe
	$liste = $monModele->getCoureursParEquipe($_GET['idEQU']); 
}
else{
	//requete presente dans le modele qui renvoie TOUS LES coureurs
	$liste = $monModele->getcoureurS();
}

//parcours de tous les resultats contenus dans $liste
foreach ($liste as $unCou ) {
// je remplis un tableau JSON avec  le nom et prénom du coureur et sa date de naissance
		$index= $unCou->IDCOU;
		$valeur = $unCou->NOMPER." ".$unCou->PRENOMPER." ".$unCou->DATENAISCOU ;
		
		$json[$index] = ($valeur);
		
		}
			
$liste->closeCursor (); // pour liberer la memoire occupee par le resultat de la requete
$liste = null; // pour une autre execution avec cette variable

// envoi du resultat formate en json
echo json_encode($json);
?>