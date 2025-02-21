<?php
class UsuarioDAO{
	private $idUsuario;
	private $name;
	private $lastName;
	private $email;
	private $password;
	private $picture;
	private $phone;
	private $mobile;
	private $state;

	function __construct($pIdUsuario = "", $pName = "", $pLastName = "", $pEmail = "", $pPassword = "", $pPicture = "", $pPhone = "", $pMobile = "", $pState = ""){
		$this -> idUsuario = $pIdUsuario;
		$this -> name = $pName;
		$this -> lastName = $pLastName;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> picture = $pPicture;
		$this -> phone = $pPhone;
		$this -> mobile = $pMobile;
		$this -> state = $pState;
	}

	function logIn($email, $password){
		return "select idUsuario, name, lastName, email, password, picture, phone, mobile, state
				from Usuario
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into Usuario(name, lastName, email, password, picture, phone, mobile, state)
				values('" . $this -> name . "', '" . $this -> lastName . "', '" . $this -> email . "', md5('" . $this -> password . "'), '" . $this -> picture . "', '" . $this -> phone . "', '" . $this -> mobile . "', '" . $this -> state . "')";
	}

	function update(){
		return "update Usuario set 
				name = '" . $this -> name . "',
				lastName = '" . $this -> lastName . "',
				email = '" . $this -> email . "',
				phone = '" . $this -> phone . "',
				mobile = '" . $this -> mobile . "',
				state = '" . $this -> state . "'	
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function updatePassword($password){
		return "update Usuario set 
				password = '" . md5($password) . "'
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function existEmail($email){
		return "select idUsuario, name, lastName, email, password, picture, phone, mobile, state
				from Usuario
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Usuario set 
				password = '" . md5($password) . "'
				where email = '" . $email . "'";
	}

	function updateImagePicture($value){
		return "update Usuario set 
				picture = '" . $value . "'
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function select() {
		return "select idUsuario, name, lastName, email, password, picture, phone, mobile, state
				from Usuario
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function selectAll() {
		return "select idUsuario, name, lastName, email, password, picture, phone, mobile, state
				from Usuario";
	}

	function selectAllOrder($orden, $dir){
		return "select idUsuario, name, lastName, email, password, picture, phone, mobile, state
				from Usuario
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idUsuario, name, lastName, email, password, picture, phone, mobile, state
				from Usuario
				where name like '%" . $search . "%' or lastName like '%" . $search . "%' or email like '%" . $search . "%' or phone like '%" . $search . "%' or mobile like '%" . $search . "%' or state like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Usuario
				where idUsuario = '" . $this -> idUsuario . "'";
	}
}
?>
