<?php
class LicencePersonnelle
{
	protected $id_licence;
	protected $prix;
	protected $date;
	protected $description;
	
	function __construct($id_licence, $prix)
	{
		$this->id_licence = $id_licence;
		$this->prix = $prix;
	}
	
	function getIdLicencePersonnelle()
	{
		return $this->id_licence;
	}
	function getPrix()
	{
		return $this->prix;
	}
}

?>