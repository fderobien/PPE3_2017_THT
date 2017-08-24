<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/CoureurModele.class.php');

$json = array(); //tableau pour stocker les messages
$monModele = new CoureurModele ();

if (isset($_GET['idCOU'])){
	//requete presente dans le modele qui supprime les commentaires avec la cle fournie
	try{
		$monModele->SupprUnCoureur($_GET['idCOU']);
		$json['SUCCESS'] = (" : Suppression REUSSIE ! : <br/>");
	} catch ( PDOException $pdoe ) {
		$json['ERROR'] = (" : Suppression ECHOUEE ! : <br/>" . $pdoe->getMessage ());
	}
}
echo json_encode($json);
?>