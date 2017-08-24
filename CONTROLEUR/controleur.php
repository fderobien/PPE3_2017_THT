<?php

require_once ('../MODELE/EquipeModele.class.php');
require_once ('../MODELE/AssociationModele.class.php');


//permet à la VUE consultationEquipesCoureur de récupérer la liste des équipes avec leur association
//pas besoin d'AJAX ici, cette récupération est faite au chargement de la page
function listeEquipeAssociation()
{
$EQUMod = new EquipeModele();
return $EQUMod->getEquipesAssociations(); //requete via le modele
}

function listeAssociationS()
{
	$ASSMod = new AssociationModele();
	return $ASSMod->getAssociationS(); //requete via le modele
}

function infoEquipe($idE){
	$EQUMod = new EquipeModele();
	return $EQUMod->getEquipe($idE); //requete via le modele
}

?>


