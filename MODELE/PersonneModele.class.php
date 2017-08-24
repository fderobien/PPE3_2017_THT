<?php
require_once '../Class/Connexion.class.php';

class PersonneModele {

	private $idcPER = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionPER = new Connexion();
			$this->idcPER = $ConnexionPER->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($nom, $prenom, $email){
		// ajoute ce coureur dans  la BDD
		$nb = 0;
		if ($this->idcPER) {
		$req = "INSERT INTO personne(NOMPER, PRENOMPER, EMAILPER) VALUES ('".$nom."','".$prenom ."','". $email."');";
		$nb = $this->idcPER->exec($req);
		}
		return $nb; // si nb ==1 alors l'insertion s est bien passee
	}
	
	public function getIdPER($nom, $prenom, $email) {
		// donne l'id de la personne dont les paramètres correspondent
		if ($this->idcPER) {
			$req ="SELECT IDPER from personne p WHERE NOMPER='" .$nom . "' and  `PRENOMPER='" . $prenom .  "' and `EMAILPER`='" . $email."');";
			$resultUNidPER = $this->idcPER->query($req)->fetch()->IDPER;
			return $resultUNidPER;
		}
	}
	public function getMaxIdPER() {
		// donne le dernier id inséré dans la table personne
		if ($this->idcPER) {
			$req ="SELECT MAX(IDPER) as IDP from personne ;" ;
			$resultMAXID = $this->idcPER->query($req)->fetch()->IDP;
			return $resultMAXID;
		}
	}
	}