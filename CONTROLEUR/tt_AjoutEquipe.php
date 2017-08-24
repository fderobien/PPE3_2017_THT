<?php
require_once ('../MODELE/EquipeModele.class.php');

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>

<?php
$msgERREUR = "";

if (isset ( $_POST ['nomEQU'] ) && isset ( $_POST ['sloganEQU'] ) && isset ( $_POST['radioASS'] )) {
	
	// ajout de l'équipe en récupérant l'Id de l'association (ici dans radioASS)
	$modeleEQU = new EquipeModele ();
	try {
		//pour traiter les eventuelles apostrophes dans la chaine du slogan
		$chaineSlogan = addslashes($_POST ['sloganEQU']);
		
		$nb = $modeleEQU->add( $_POST ['nomEQU'],$chaineSlogan, $_POST ['radioASS']);

		$msgERREUR = "SUCCESS : AJOUT de votre équipe";
		
		//récupération de l'ID de l'équipe qui vient d'être insérée
		$IDE = $modeleEQU->getMAXidEquipe();
		
		
	} catch ( PDOException $pdoe ) {
		// cas ou 2 pseudo ont deja mis un commentaire sur un jeu
		$msgERREUR = "ERREUR : vous avez déjà ajouté une équipe avec le même nom ! : <br/>" . $pdoe->getMessage ();
	}
}
	

// redirection vers la page appelante en lui passant le message d'erreur et l'ID de l'équipe qui vient d'être créée
header ( 'Location: ../VUE/inscriptionEquipeCoureurs.php?error='.$msgERREUR.'&idE='.$IDE);
exit ();
?>
</html>
