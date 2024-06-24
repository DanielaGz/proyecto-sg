<?php
require_once ("persistence/DashboardDAO.php");
require_once ("persistence/Connection.php");

class Dashboard {
	private $idDashboard;
	private $nombre;
	private $detalle;
	private $dashboardDAO;
	private $connection;

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

	function __construct($pIdDashboard = "", $pNombre = "", $pDetalle = ""){
		$this -> idDashboard = $pIdDashboard;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> dashboardDAO = new DashboardDAO($this -> idDashboard, $this -> nombre, $this -> detalle);
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
