<?php
require_once ("persistence/LogUsuarioDAO.php");
require_once ("persistence/Connection.php");

class LogUsuario {
	private $idLogUsuario;
	private $action;
	private $information;
	private $date;
	private $time;
	private $ip;
	private $os;
	private $browser;
	private $usuario;
	private $logUsuarioDAO;
	private $connection;

	function getIdLogUsuario() {
		return $this -> idLogUsuario;
	}

	function setIdLogUsuario($pIdLogUsuario) {
		$this -> idLogUsuario = $pIdLogUsuario;
	}

	function getAction() {
		return $this -> action;
	}

	function setAction($pAction) {
		$this -> action = $pAction;
	}

	function getInformation() {
		return $this -> information;
	}

	function setInformation($pInformation) {
		$this -> information = $pInformation;
	}

	function getDate() {
		return $this -> date;
	}

	function setDate($pDate) {
		$this -> date = $pDate;
	}

	function getTime() {
		return $this -> time;
	}

	function setTime($pTime) {
		$this -> time = $pTime;
	}

	function getIp() {
		return $this -> ip;
	}

	function setIp($pIp) {
		$this -> ip = $pIp;
	}

	function getOs() {
		return $this -> os;
	}

	function setOs($pOs) {
		$this -> os = $pOs;
	}

	function getBrowser() {
		return $this -> browser;
	}

	function setBrowser($pBrowser) {
		$this -> browser = $pBrowser;
	}

	function getUsuario() {
		return $this -> usuario;
	}

	function setUsuario($pUsuario) {
		$this -> usuario = $pUsuario;
	}

	function __construct($pIdLogUsuario = "", $pAction = "", $pInformation = "", $pDate = "", $pTime = "", $pIp = "", $pOs = "", $pBrowser = "", $pUsuario = ""){
		$this -> idLogUsuario = $pIdLogUsuario;
		$this -> action = $pAction;
		$this -> information = $pInformation;
		$this -> date = $pDate;
		$this -> time = $pTime;
		$this -> ip = $pIp;
		$this -> os = $pOs;
		$this -> browser = $pBrowser;
		$this -> usuario = $pUsuario;
		$this -> logUsuarioDAO = new LogUsuarioDAO($this -> idLogUsuario, $this -> action, $this -> information, $this -> date, $this -> time, $this -> ip, $this -> os, $this -> browser, $this -> usuario);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogUsuario = $result[0];
		$this -> action = $result[1];
		$this -> information = $result[2];
		$this -> date = $result[3];
		$this -> time = $result[4];
		$this -> ip = $result[5];
		$this -> os = $result[6];
		$this -> browser = $result[7];
		$usuario = new Usuario($result[8]);
		$usuario -> select();
		$this -> usuario = $usuario;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> selectAll());
		$logUsuarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[8]);
			$usuario -> select();
			array_push($logUsuarios, new LogUsuario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $usuario));
		}
		$this -> connection -> close();
		return $logUsuarios;
	}

	function selectAllByUsuario(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> selectAllByUsuario());
		$logUsuarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[8]);
			$usuario -> select();
			array_push($logUsuarios, new LogUsuario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $usuario));
		}
		$this -> connection -> close();
		return $logUsuarios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> selectAllOrder($order, $dir));
		$logUsuarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[8]);
			$usuario -> select();
			array_push($logUsuarios, new LogUsuario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $usuario));
		}
		$this -> connection -> close();
		return $logUsuarios;
	}

	function selectAllByUsuarioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> selectAllByUsuarioOrder($order, $dir));
		$logUsuarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[8]);
			$usuario -> select();
			array_push($logUsuarios, new LogUsuario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $usuario));
		}
		$this -> connection -> close();
		return $logUsuarios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logUsuarioDAO -> search($search));
		$logUsuarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[8]);
			$usuario -> select();
			array_push($logUsuarios, new LogUsuario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $usuario));
		}
		$this -> connection -> close();
		return $logUsuarios;
	}
}
?>
