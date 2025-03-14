<?php
require_once ("persistence/DashboardDAO.php");
require_once ("persistence/Connection.php");

class Dashboard {
	private $idDashboard;
	private $nombre;
	private $detalle;
	private $category;
	private $dashboardDAO;
	private $connection;
	private $usuario;

	function getIdDashboard() {
		return $this -> idDashboard;
	}

	function setIdDashboard($pIdDashboard) {
		$this -> idDashboard = $pIdDashboard;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getDetalle() {
		return $this -> detalle;
	}

	function setDetalle($pDetalle) {
		$this -> detalle = $pDetalle;
	}

	function getUsuario() {
		return $this -> usuario;
	}

	function setUsuario($pUsuario) {
		$this -> usuario = $pUsuario;
	}

	function getCategory() {
		return $this -> category;
	}

	function setCategory($pCategory) {
		$this -> category = $pCategory;
	}

	function __construct($pIdDashboard = "", $pNombre = "", $pDetalle = "", $pUsuario = "", $pCategory = ""){
		$this -> idDashboard = $pIdDashboard;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> usuario = $pUsuario;
		$this -> category = $pCategory;
		$this -> dashboardDAO = new DashboardDAO($this -> idDashboard, $this -> nombre, $this -> detalle, $this -> usuario, $this -> category);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idDashboard = $result[0];
		$this -> nombre = $result[1];
		$this -> detalle = $result[2];
		$this -> category = $result[3];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> selectAll());
		$dashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($dashboards, new Dashboard($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $dashboards;
	}

	function selectAllByUsuario(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> selectAllByUsuario());
		$dashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			$usuario = new Usuario($result[3]);
			$usuario -> select();
			array_push($dashboards, new Dashboard($result[0], $result[1], $result[2], $usuario, $result[4]));
		}
		$this -> connection -> close();
		return $dashboards;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> selectAllOrder($order, $dir));
		$dashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($dashboards, new Dashboard($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $dashboards;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> search($search));
		$dashboards = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($dashboards, new Dashboard($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $dashboards;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dashboardDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
