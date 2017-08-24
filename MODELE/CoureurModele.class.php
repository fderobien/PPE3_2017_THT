<?php
require_once '../Class/Connexion.class.php';

class CoureurModele {

	private $idcCOU = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionCOU = new Connexion();
			$this->idcCOU = $ConnexionCOU->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($idCou, $idEqu, $dateNaisCou,$cm){
		// ajoute ce coureur dans  la BDD
		$nb = 0;
		if ($this->idcCOU) {
			$req = "INSERT INTO coureur VALUES (".$idCou .",". $idEqu .",'".$dateNaisCou."',".$cm.");";
			$nb = $this->idcCOU->exec($req);
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	
	public function getCoureurS() {
		// recupere TOUS les coureurs de  la BDD
		if ($this->idcCOU) {
			$req ="SELECT * from coureur c inner join personne p on  c.IDCOU = p.IDPER ORDER BY NOMPER;" ;
			$resultEQU = $this->idcCOU->query($req);
			return $resultEQU;
		}
	}
	//Pas possible de redefinir de la méthode getCoureurS en PHP
	public function getCoureursParEquipe($idEQU) {
		// recupere TOUS les coureurs pour une EQUIPE passée en paramètre
		if ($this->idcCOU) {
			$req ="SELECT * from coureur c inner join personne p on  c.IDCOU = p.IDPER WHERE IDEQU=".$idEQU." ORDER BY p.NOMPER ASC;" ;
			$resultEQU = $this->idcCOU->query($req);
			return $resultEQU;
		}
	}
	
	//Pas possible de redefinir de la méthode getCoureurS en PHP
	public function compteCoureursParEquipe($idEQU) {
		// recupere TOUS les coureurs pour une EQUIPE passée en paramètre
		if ($this->idcCOU) {
			$req ="SELECT count(*) as CPTCOU from coureur c  WHERE IDEQU=".$idEQU.";" ;
			$resultEQU = $this->idcCOU->query($req)->fetch()->CPTCOU;
			return $resultEQU;
		}
	}
	
	//Pas possible de redefinir de la méthode getCoureurS en PHP
	public function SupprUnCoureur($id) {
		// supprime un coureur dont son id est passé en paramètre
		if ($this->idcCOU) {
			$req ="DELETE from coureur WHERE IDCOU=".$id.";" ;
			$nb = $this->idcCOU->exec($req);
			return $nb;
		}
	}
	}