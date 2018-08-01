<?php
class Facture
{
	protected $id_transaction;
	protected $id_utilisateur;
	protected $client_transaction;
	protected $date;
	protected $montant;
	protected $devise;

	public function construireAvecDonneesSecurisees($id_transaction, $id_utilisateur, $client_transaction, $date, $montant, $devise){

		$this->id_transaction = $id_transaction;
		$this->id_utilisateur = $id_utilisateur;
		$this->client_transaction = $client_transaction;
		$this->date = $date;
		$this->montant = $montant;
		$this->devise = $devise;

	}

	public function construire($id_transaction, $id_utilisateur, $client_transaction, $montant, $devise){

		$this->id_transaction = $id_transaction;
		$this->id_utilisateur = $id_utilisateur;
		$this->client_transaction = $client_transaction;
		$this->montant = $montant;
		$this->devise = $devise;

	}
	function getIdTransaction()
	{
		return $this->id_transaction;
	}
	function getIdUtilisateur()
	{
		return $this->id_utilisateur;
	}
	function getClientTransaction()
	{
		return $this->client_transaction;
	}
	function getDate()
	{
		return $this->date;
	}
	function getMontant()
	{
		return $this->montant;
	}
	function getDevise()
	{
		return $this->devise;
	}

	function setIdTransaction($id_transaction)
	{
		$this->id_transaction = $id_transaction;
	}
	function setIdUtilisateur($id_utilisateur)
	{
		$this->id_utilisateur = $id_utilisateur;
	}
	function setClientTransaction($client_transaction)
	{
		$this->client_transaction = $client_transaction;
	}
	function setDate($date)
	{
		$this->date = $date;
	}
	function setMontant($montant)
	{
		$this->montant = $montant;
	}
	function setDevise($devise)
	{
		$this->devise = $devise;
	}
}

?>
