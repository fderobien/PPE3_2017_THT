<?php
require_once ('../MODELE/PersonneModele.class.php');
require_once ('../MODELE/CoureurModele.class.php');

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>

<?php

$msgERREUR = "";

if (isset ($_POST ['nomCOU'] ) && isset ( $_POST ['prenomCOU'] )) {
	
	$modelePER = new PersonneModele();
	$modeleCOU = new CoureurModele();
	
	try {
		//récupération de l'ID de la dernière équipe insérée soit par le POST, soit par le GET
		if (isset($_POST['idE'])) $IDE=$_POST['idE'];
		if (isset($_GET['idE']))  $IDE=$_GET['idE'];
		
		//requête qui récupère le nombre de coureur inscrit pour une équipe
		$cptCOU = $modeleCOU->compteCoureursParEquipe($IDE);
		if ($cptCOU < 4) //4 étant le nombre maximum de coureurs par équipe
		{
			//requête permettant d'ajouter une personne
			$nbPER = $modelePER->add($_POST['nomCOU'],$_POST['prenomCOU'],$_POST['mailCOU']);
			
			//requête qui récupère l'ID de la dernière personne insérée
			$maxidPer = $modelePER->getMaxIdPER();
			if ($nbPER==1) 	$msgERREUR .= "SUCCESS : AJOUT d\'une personne avec ID = ".$maxidPer. " - ";
			
			//requête permettant d'ajouter un coureur
			$nbCOU = $modeleCOU->add($maxidPer,$_POST['idE'],NULL,0);
			if ($nbCOU==1) 	$msgERREUR .= "AJOUT d\'un coureur - ";
			
			
			$cptCOU = $modeleCOU->compteCoureursParEquipe($IDE);
			if ($cptCOU == 4){
				$msgERREUR .= "BRAVO : Vous avez inscrit TOUS les coureurs de votre EQUIPE";
			}
			else{
				$nbCoureurManquant = 4 - $cptCOU;
				$msgERREUR .= "ERREUR : il vous manque ENCORE ".$nbCoureurManquant ." coureur(s) dans votre EQUIPE !";
			}
		}
		else{
			$msgERREUR .= "ERREUR : AJOUT IMPOSSIBLE : Il y a déjà 4 coureurs dans cette équipe !";
		}
		
	} catch ( PDOException $pdoe ) {
		// erreur attrapée de MySQL
		$msgERREUR .= "ERREUR dans l\'ajout du coureur !  <br/>" . $pdoe->getMessage ();
	}
}
	
// redirection vers la page appelante en lui passant le message d'erreur et l'ID de l'équipe qui vient d'être créée
header ( 'Location: ../VUE/inscriptionEquipeCoureurs.php?error='.$msgERREUR.'&idE='.$IDE);
exit ();
?>
</html>
