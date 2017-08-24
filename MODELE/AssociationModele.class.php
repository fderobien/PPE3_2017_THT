<?php
require_once '../Class/Connexion.class.php';

class AssociationModele {

	private $idcASS = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionASS = new Connexion();
			$this->idcASS = $ConnexionASS->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($nomASS, $logoASS, $causeASS){
		// ajoute cette équipe dans  la BDD
		$nb = 0;
		if ($this->idcASS) {
			$req = "INSERT INTO Association(`NOMASS`, `LOGOASS`, `CAUSEASS`) VALUES  ('". $nomASS . "','" . $logoASS ."','" . $causeASS . "');";
			$nb = $this->idcASS->exec($req);
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	public function getMaxID() {
		// recupere l'idmax de l'association qui vient d'être insérée
		if ($this->idcASS) {
			$req= "SELECT max(IDASS) as MAXIDASS from association";
			$resultID = $this->idcASS->query($req)->fetch()->MAXIDASS;
			return $resultID;
		}
	}
	
	public function getAssociationS() {
		// recupere TOUTES les Associations de  la BDD
		if ($this->idcASS) {
			$req ="SELECT * from Association;" ;
			$resultASS = $this->idcASS->query($req);
			return $resultASS;
		}
	}
}