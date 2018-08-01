<?php
class Utilisateur
{
	private $id_utilisateur;
	private $nom;
	private $prenom;
	private $pseudo;
	private $email;
	private $mot_de_passe;
	private $estAdministrateur;

	private $listeErreurs=[
		"id_utilisateur-est-vide" => "L'id utilisateur ne doit pas être vide",
		"id_utilisateur-incorrect" => "L'id utilisateur photo est incorrect",

		"nom-est-vide" => "Le nom ne doit pas être vide",
		"nom-contient-chiffres" => "Le nom ne doit pas contenir des chiffres",
		"nom-trop-long" => "Le nom ne doit pas contenir plus de 255 caractères",

		"prenom-est-vide" => "Le prenom ne doit pas être vide",
		"prenom-contient-chiffres" => "Le prenom ne doit pas contenir des chiffres",
		"prenom-trop-long" => "Le prenom ne doit pas contenir plus de 255 caractères",

		"pseudo-est-vide" => "Le pseudo ne doit pas être vide",
		"pseudo-contient-caracteres-interdits" => "Le pseudo contient des caracteres interdits",
		"pseudo-trop-long" => "Le pseudo ne doit pas contenir plus de 255 caractères",

		"email-est-vide" => "L'adresse email ne doit pas être vide",
		"email-non" => "L'adresse email doit être valide",
		"email-non-valide" => "L'adresse email ne doit pas contenir plus de 255 caractères",

		"mot_de_passe-est-vide" => "Le mot de passe ne doit pas être vide",
		"mot_de_passe-trop-long" => "Le mot de passe ne doit pas contenir plus de 255 caractères",

		"estAdministrateur-est-vide" => "EstAdministrateur ne doit pas être vide",
		"estAdministrateur-non-booleen" => "EstAdministrateur doit être un booleen"

	];

	private $listeErreursActives = [];

	public function construireAvecDonneesSecurisees($id_utilisateur, $prenom, $nom, $pseudo, $email, $mot_de_passe,$estAdministrateur){

		$this->id_utilisateur = $id_utilisateur;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->pseudo = $pseudo;
		$this->email = $email;
		$this->mot_de_passe = $mot_de_passe;
		$this->estAdministrateur = $estAdministrateur;

	}

	public function construirePourConnexion($pseudo,$mot_de_passe){

		$this->pseudo = $pseudo;
		$this->mot_de_passe = $mot_de_passe;

	}

	public function construirePourListeNoms($id_utilisateur,$prenom,$nom){

		$this->id_utilisateur = $id_utilisateur;
		$this->prenom = $prenom;
		$this->nom = $nom;

	}

	public function getIdUtilisateur()
	{
		return $this->id_utilisateur;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function getPseudo()
	{
		return $this->pseudo;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getMotDePasse()
	{
		return $this->mot_de_passe;
	}
	public function estAdministrateur()
	{
		return $this->estAdministrateur;
	}

	public function setIdUtilisateur($id_utilisateur)
	{
		if($id_utilisateur == null){
			$this->listeErreursActives['id_utilisateur'][]=listeErreurs['id_utilisateur-est-vide'];
		}else if (!filter_var($id_utilisateur, FILTER_VALIDATE_INT)) {
			$this->listeErreursActives['id_utilisateur'][]=listeErreurs['id_utilisateur-incorrect'];
		} else {
			$this->id_utilisateur = $id_utilisateur;
		}
	}

	public function setNom($nom)
	{
		$nomTemporaire = filter_var($nom, FILTER_SANITIZE_STRING);
		if(empty($nomTemporaire)){
			$this->listeErreursActives['nom'][]=$this->listeErreurs['nom-est-vide'];
		}elseif(!ctype_alpha($nomTemporaire)){
			$this->listeErreursActives['nom'][]=$this->listeErreurs['nom-contient-chiffres'];
		}elseif(strlen($nomTemporaire)>255){
			$this->listeErreursActives['nom'][]=$this->listeErreurs['nom-trop-long'];
		}else{
			$this->nom=trim($nomTemporaire);
		}

	}
	public function setPrenom($prenom)
	{
		$prenomTemporaire = filter_var($prenom, FILTER_SANITIZE_STRING);
		if(empty($prenomTemporaire)){
			$this->listeErreursActives['prenom'][]=$this->listeErreurs['prenom-est-vide'];
		}elseif(!ctype_alpha($prenomTemporaire)){
			$this->listeErreursActives['prenom'][]=$this->listeErreurs['prenom-contient-chiffres'];
		}elseif(strlen($prenomTemporaire)>255){
			$this->listeErreursActives['prenom'][]=$this->listeErreurs['prenom-trop-long'];
		}else{
			$this->prenom=trim($prenomTemporaire);
		}
	}
	public function setPseudo($pseudo)
	{
		$pseudoTemporaire = filter_var($pseudo, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($pseudoTemporaire)){
			$this->listeErreursActives['pseudo'][]=$this->listeErreurs['pseudo-est-vide'];
		}elseif(!ctype_alnum($pseudoTemporaire)){
			$this->listeErreursActives['prenom'][]=$this->listeErreurs['pseudo-contient-caracteres-interdits'];
		}elseif(strlen($pseudoTemporaire)>255){
			$this->listeErreursActives['pseudo'][]=$this->listeErreurs['pseudo-trop-long'];
		}else{
			$this->pseudo=trim($pseudoTemporaire);
		}
	}
	public function setEmail($email)
	{
		$emailTemporaire = filter_var($email, FILTER_SANITIZE_EMAIL);
		if(empty($emailTemporaire)){
			$this->listeErreursActives['email'][]=$this->listeErreurs['email-est-vide'];
		}elseif(strlen($emailTemporaire)>255){
			$this->listeErreursActives['email'][]=$this->listeErreurs['email-trop-long'];
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->listeErreursActives['email'][]=$this->listeErreurs['email-non-valide'];
		}else{
			$this->email=trim($emailTemporaire);
		}
	}
	public function setMotDePasse($mot_de_passe)
	{
		$mot_de_passeTemporaire = filter_var($mot_de_passe, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($mot_de_passeTemporaire)){
			$this->listeErreursActives['mot_de_passe'][]=$this->listeErreurs['mot_de_passe-est-vide'];
		}elseif(strlen($mot_de_passeTemporaire)>255){
			$this->listeErreursActives['mot_de_passe'][]=$this->listeErreurs['mot_de_passe-trop-long'];
		}else{
			$this->mot_de_passe=trim($mot_de_passeTemporaire);
		}
	}
	public function setAdministrateur($estAdministrateur)
	{
			$this->estAdministrateur=$estAdministrateur;
	}

	public function estValide(){
		return empty($this->listeErreursActives);
	}

	public function getErreursActives(){
		return $this->listeErreursActives;
	}
}

?>
