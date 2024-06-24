<?php
require_once ("persistence/AdministratorDAO.php");
require_once ("persistence/Connection.php");

class Administrator {
	private $idAdministrator;
	private $name;
	private $lastName;
	private $email;
	private $password;
	private $picture;
	private $phone;
	private $mobile;
	private $state;
	private $administratorDAO;
	private $connection;

	function getIdAdministrator() {
		return $this -> idAdministrator;
	}

	function setIdAdministrator($pIdAdministrator) {
		$this -> idAdministrator = $pIdAdministrator;
	}

	function getName() {
		return $this -> name;
	}

	function setName($pName) {
		$this -> name = $pName;
	}

	function getLastName() {
		return $this -> lastName;
	}

	function setLastName($pLastName) {
		$this -> lastName = $pLastName;
	}

	function getEmail() {
		return $this -> email;
	}

	function setEmail($pEmail) {
		$this -> email = $pEmail;
	}

	function getPassword() {
		return $this -> password;
	}

	function setPassword($pPassword) {
		$this -> password = $pPassword;
	}

	function getPicture() {
		return $this -> picture;
	}

	function setPicture($pPicture) {
		$this -> picture = $pPicture;
	}

	function getPhone() {
		return $this -> phone;
	}

	function setPhone($pPhone) {
		$this -> phone = $pPhone;
	}

	function getMobile() {
		return $this -> mobile;
	}

	function setMobile($pMobile) {
		$this -> mobile = $pMobile;
	}

	function getState() {
		return $this -> state;
	}

	function setState($pState) {
		$this -> state = $pState;
	}

	function __construct($pIdAdministrator = "", $pName = "", $pLastName = "", $pEmail = "", $pPassword = "", $pPicture = "", $pPhone = "", $pMobile = "", $pState = ""){
		$this -> idAdministrator = $pIdAdministrator;
		$this -> name = $pName;
		$this -> lastName = $pLastName;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> picture = $pPicture;
		$this -> phone = $pPhone;
		$this -> mobile = $pMobile;
		$this -> state = $pState;
		$this -> administratorDAO = new AdministratorDAO($this -> idAdministrator, $this -> name, $this -> lastName, $this -> email, $this -> password, $this -> picture, $this -> phone, $this -> mobile, $this -> state);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idAdministrator = $result[0];
			$this -> name = $result[1];
			$this -> lastName = $result[2];
			$this -> email = $result[3];
			$this -> password = $result[4];
			$this -> picture = $result[5];
			$this -> phone = $result[6];
			$this -> mobile = $result[7];
			$this -> state = $result[8];
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> update());
		$this -> connection -> close();
	}

	function updatePassword($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> updatePassword($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> existEmail($email));
		if($this -> connection -> numRows()==1){
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function recoverPassword($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImagePicture($value){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> updateImagePicture($value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idAdministrator = $result[0];
		$this -> name = $result[1];
		$this -> lastName = $result[2];
		$this -> email = $result[3];
		$this -> password = $result[4];
		$this -> picture = $result[5];
		$this -> phone = $result[6];
		$this -> mobile = $result[7];
		$this -> state = $result[8];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> selectAll());
		$administrators = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($administrators, new Administrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8]));
		}
		$this -> connection -> close();
		return $administrators;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> selectAllOrder($order, $dir));
		$administrators = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($administrators, new Administrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8]));
		}
		$this -> connection -> close();
		return $administrators;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> search($search));
		$administrators = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($administrators, new Administrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8]));
		}
		$this -> connection -> close();
		return $administrators;
	}
}
?>
