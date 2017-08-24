<?php
require_once ('../MODELE/AssociationModele.class.php');

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>

<?php

$msgERREUR = "";

if (isset ( $_POST ['nomASS'] ) && isset ( $_POST ['causeASS'] ) ) {
	
	$modeleASS = new AssociationModele ();
	try {
		
		$nb = $modeleASS->add( $_POST ['nomASS'],NULL, $_POST ['causeASS']);
		$msgERREUR = "SUCCESS : AJOUT de votre association";
	
		
	} catch ( PDOException $pdoe ) {
		// cas ou 2 pseudo ont deja mis un commentaire sur un jeu
		$msgERREUR = "ERREUR dans l'ajout de votre association ! : <br/>" . $pdoe->getMessage ();
	}
}

// redirection vers la page appelante en lui passant le message d'erreur 
header ( 'Location: ../VUE/ajoutAssociation.php?error='.$msgERREUR);
exit ();
?>
</html>
