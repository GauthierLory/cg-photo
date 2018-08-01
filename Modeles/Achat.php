<?php
class Achat
{
	protected $id_photo;
	protected $id_facture;

	public function construireAvecDonneesSecurisees($id_photo, $id_facture){

		$this->id_photo = $id_photo;
		$this->id_facture = $id_facture;
	}

	function getIdPhoto()
	{
		return $this->id_photo;
	}
	function getIdFacture()
	{
		return $this->id_facture;
	}


	function setIdPhoto($id_photo)
	{
		$this->id_photo = $id_photo;
	}
	function setIdFacture($id_facture)
	{
		$this->id_facture = $id_facture;
	}
}

?>
