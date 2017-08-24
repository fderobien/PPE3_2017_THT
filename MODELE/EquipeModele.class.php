<?php
require_once '../Class/Connexion.class.php';

class EquipeModele {

	private $idcEQU = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionEQU = new Connexion();
			$this->idcEQU = $ConnexionEQU->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($nomEqu, $sloganEqu, $idAss){
		// ajoute cette équipe dans  la BDD
		$nb = 0;
		if ($this->idcEQU) {
			$req = "INSERT INTO equipe(`NOMEQU`, `SLOGANEQU`, `IDASS`) VALUES  ('" .$nomEqu . "','" . $sloganEqu .  "','" . $idAss."');";
			$nb = $this->idcEQU->exec($req);
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	
	public function getEquipeS() {
		// recupere TOUTES les equipes de  la BDD
		if ($this->idcEQU) {
			$req ="SELECT * from equipe ORDER BY NOMEQU;" ;
			$resultEQU = $this->idcEQU->query($req);
			return $resultEQU;
		}
	}
		
		public function getEquipesAssociations() {
			// recupere TOUTES les equipes avec leurs associations  la BDD
			if ($this->idcEQU) {
				$req ="SELECT * from equipe e inner join association a on e.IDASS= a.IDASS ORDER BY NOMEQU;" ;
				$resultEQU = $this->idcEQU->query($req);
				return $resultEQU;
			}
	}
	
	public function getMAXidEquipe() {
		// recupere l'ID de la derniere equipe insérée dans la BDD
		if ($this->idcEQU) {
			$req ="SELECT MAX(IDEQU) as IDE from equipe;" ;
			$resultEQU = $this->idcEQU->query($req);
			// retourne la valeur de l'ID
			return $resultEQU->fetch()->IDE;
		}
	}
	
	public function getEquipe($idE) {
		// recupere l'ID de la derniere equipe insérée dans la BDD
		if ($this->idcEQU) {
			$req ="SELECT* from equipe where IDEQU =".$idE.";" ;
			$resultEQU = $this->idcEQU->query($req);
			// retourne un seul tuple donc on peut faire un fetch() pour se positionner sur le premier tuple
			return $resultEQU->fetch();
		}
	}
	
}