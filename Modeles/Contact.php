<?php
class Contact
{
	protected $id_contact;
	protected $nom;
	protected $email;
	protected $message;
	protected $date;
	
	function __construct($id_contact, $nom,$email, $message = "", $date = "" )
	{
		$this->id_contact = $id_contact;
		$this->nom = $nom;
		$this->email = $email;
		$this->message = $message;
		$this->date = $date;
	
	}
	
	function getIdContact()
	{
		return $this->id_contact;
	}
	function getNom()
	{
		return $this->nom;
	}
	function getEmail()
	{
		return $this->email;
	}
	function getMessage()
	{
		return $this->message;
	}
	function getDate()
	{
		return $this->date;
	}
}

?>