<?php
class DashboardDAO{
	private $idDashboard;
	private $nombre;
	private $detalle;

	function __construct($pIdDashboard = "", $pNombre = "", $pDetalle = ""){
		$this -> idDashboard = $pIdDashboard;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
	}

	function insert(){
		return "insert into Dashboard(nombre, detalle)
				values('" . $this -> nombre . "', '" . $this -> detalle . "')";
	}

	function update(){
		return "update Dashboard set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "'	
				where idDashboard = '" . $this -> idDashboard . "'";
	}

	function select() {
		return "select idDashboard, nombre, detalle
				from Dashboard
				where idDashboard = '" . $this -> idDashboard . "'";
	}

	function selectAll() {
		return "select idDashboard, nombre, detalle
				from Dashboard";
	}

	function selectAllOrder($orden, $dir){
		return "select idDashboard, nombre, detalle
				from Dashboard
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idDashboard, nombre, detalle
				from Dashboard
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Dashboard
				where idDashboard = '" . $this -> idDashboard . "'";
	}
}
?>
