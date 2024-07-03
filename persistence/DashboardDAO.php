<?php
class DashboardDAO{
	private $idDashboard;
	private $nombre;
	private $detalle;
	private $usuario;

	function __construct($pIdDashboard = "", $pNombre = "", $pDetalle = "", $pUsuario = ""){
		$this -> idDashboard = $pIdDashboard;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> usuario = $pUsuario;
	}

	function insert(){
		return "insert into Dashboard(nombre, detalle, usuario_idUsuario)
				values('" . $this -> nombre . "', '" . $this -> detalle . "','".$this -> usuario."')";
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

	function selectAllByUsuario() {
		return "select idDashboard, nombre, detalle, usuario_idUsuario
				from Dashboard
				where usuario_idUsuario = '" . $this -> usuario . "'";
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
