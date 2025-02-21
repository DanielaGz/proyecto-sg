<?php
require_once ("persistence/UsuarioDashboardDAO.php");
require_once ("persistence/Connection.php");

class UsuarioDashboard {
	private $idUsuarioDashboard;
	private $usuario;
	private $dashboard;
	private $usuarioDashboardDAO;
	private $connection;

	function getIdUsuarioDashboard() {
		return $this -> idUsuarioDashboard;
	}

	function setIdUsuarioDashboard($pIdUsuarioDashboard) {
		$this -> idUsuarioDashboard = $pIdUsuarioDashboard;
	}

	function getUsuario() {
		return $this -> usuario;
	}

	function setUsuario($pUsuario) {
		$this -> usuario = $pUsuario;
	}

	function getDashboard() {
		return $this -> dashboard;
	}

	function setDashboard($pDashboard) {
		$this -> dashboard = $pDashboard;
	}

	function __construct($pIdUsuarioDashboard = "", $pUsuario = "", $pDashboard = ""){
		$this -> idUsuarioDashboard = $pIdUsuarioDashboard;
		$this -> usuario = $pUsuario;
		$this -> dashboard = $pDashboard;
		$this -> usuarioDashboardDAO = new UsuarioDashboardDAO($this -> idUsuarioDashboard, $this -> usuario, $this -> dashboard);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idUsuarioDashboard = $result[0];
		$usuario = new Usuario($result[1]);
		$usuario -> select();
		$this -> usuario = $usuario;
		$dashboard = new Dashboard($result[2]);
		$dashboard -> select();
		$this -> dashboard = $dashboard;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> selectAll());
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function selectAllByUsuario(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> selectAllByUsuario());
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function selectAllByDashboard(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> selectAllByDashboard());
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> selectAllOrder($order, $dir));
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function selectAllByUsuarioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> selectAllByUsuarioOrder($order, $dir));
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function selectAllByDashboardOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> selectAllByDashboardOrder($order, $dir));
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> search($search));
		$usuarioDashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[1]);
			$usuario -> select();
			$dashboard = new Dashboard($result[2]);
			$dashboard -> select();
			array_push($usuarioDashboards, new UsuarioDashboard($result[0], $usuario, $dashboard));
		}
		$this -> connection -> close();
		return $usuarioDashboards;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDashboardDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
