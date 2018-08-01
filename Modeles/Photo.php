<?php
class Photo
{
	private $id_photo;
	private $id_utilisateur;
	private $nom;
	private $date;
	private $description;

	private $listeErreurs=[

		"nom-est-vide" => "Le nom ne doit pas être vide",
		"nom-contient-chiffres" => "Le nom ne doit pas contenir des chiffres",
		"nom-trop-long" => "Le nom ne doit pas contenir plus de 255 caractères",

		"id_utilisateur-est-vide" => "L'id utilisateur ne doit pas être vide",
		"id_utilisateur-incorrect" => "L'id utilisateur est incorrect",

		"id_photo-est-vide" => "L'id photo ne doit pas être vide",
		"id_photo-incorrect" => "L'id photo est incorrect"

	];

	private $listeErreursActives = [];

	public function construireAvecDonneesSecurisees($id_photo, $id_utilisateur, $nom, $date = "", $description = ""){

		$this->id_photo = $id_photo;
		$this->id_utilisateur = $id_utilisateur;
		$this->nom = $nom;
		$this->date = $date;
		$this->description = $description;
	}

	public function getIdPhoto()
	{
		return $this->id_photo;
	}
	public function getIdUtilisateur()
	{
		return $this->id_utilisateur;
	}
	public function getNom()
	{
		return $this->nom;
	}

	public function getNomSansExtention()
	{
		return explode(".",$this->nom)[0];
	}

	public function getExtention()
	{
		return '.'.explode(".",$this->nom)[1];
	}

	public function getDate()
	{
		return $this->date;
	}
	public function getDescription()
	{
		return $this->description;
	}

	public function setIdPhoto($id_photo)
	{
		if($id_photo == null){
			$this->listeErreursActives['id_photo'][]=$this->listeErreurs['id_photo-est-vide'];
		}else if (!filter_var($id_photo, FILTER_VALIDATE_INT)) {
			$this->listeErreursActives['id_photo'][]=$this->listeErreurs['id_photo-incorrect'];
		} else {
			$this->id_photo = $id_photo;
		}
	}
	public function setIdUtilisateur($id_utilisateur)
	{
		if($id_utilisateur == null){
			$this->listeErreursActives['id_utilisateur'][]=$this->listeErreurs['id_utilisateur-est-vide'];
		}else if (!filter_var($id_utilisateur, FILTER_VALIDATE_INT)) {
			$this->listeErreursActives['id_utilisateur'][]=$this->listeErreurs['id_utilisateur-incorrect'];
		} else {
			$this->id_utilisateur=$id_utilisateur;
		}
	}
	public function setNom($nom)
	{
		$nomTemporaire = filter_var($nom, FILTER_SANITIZE_STRING);
		if(empty($nom) || strlen(trim($nom))==0){
			$this->listeErreursActives['nom'][]=$this->listeErreurs['nom-est-vide'];
		}elseif(!ctype_alpha($nomTemporaire)){
			$this->listeErreursActives['nom'][]=$this->listeErreurs['nom-contient-chiffres'];
		}elseif(strlen($nom)>255){
			$this->listeErreursActives['nom'][]=$this->listeErreurs['nom-trop-long'];
		}else{
			$this->nom=trim($nom);
		}
	}

	public function setExtentionNom($extention)
	{
		$this->nom=$this->nom.$extention;
	}
	public function setDate($date)
	{
		$this->date = $date;
	}
	public function setDescription($description)
	{
		if(strlen($description)>0){
			$descriptionTemporaire = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
			$this->description=$descriptionTemporaire;
		}
	}

	public function estValide(){
		return empty($this->listeErreursActives);
	}

	public function getErreursActives(){
		return $this->listeErreursActives;
	}
}


?>
