<?php
class GraficaDAO{
	private $idGrafica;
	private $nombre;
	private $detalle;
	private $config;
	private $fila;
	private $posicion;
	private $tam;
	private $dashboard;

	function __construct($pIdGrafica = "", $pNombre = "", $pDetalle = "", $pConfig = "", $pFila = "", $pPosicion = "", $pTam = "", $pDashboard = ""){
		$this -> idGrafica = $pIdGrafica;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> config = $pConfig;
		$this -> fila = $pFila;
		$this -> posicion = $pPosicion;
		$this -> tam = $pTam;
		$this -> dashboard = $pDashboard;
	}

	function insert(){
		return "insert into Grafica(nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard)
				values('" . $this -> nombre . "', '" . $this -> detalle . "', '" . $this -> config . "', '" . $this -> fila . "', '" . $this -> posicion . "', '" . $this -> tam . "', '" . $this -> dashboard . "')";
	}

	function update(){
		return "update Grafica set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "',
				config = '" . $this -> config . "',
				fila = '" . $this -> fila . "',
				posicion = '" . $this -> posicion . "',
				tam = '" . $this -> tam . "',
				dashboard_idDashboard = '" . $this -> dashboard . "'	
				where idGrafica = '" . $this -> idGrafica . "'";
	}

	function select() {
		return "select idGrafica, nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard
				from Grafica
				where idGrafica = '" . $this -> idGrafica . "'";
	}

	function selectAll() {
		return "select idGrafica, nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard
				from Grafica";
	}

	function selectAllByDashboard() {
		return "select idGrafica, nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard
				from Grafica
				where dashboard_idDashboard = '" . $this -> dashboard . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idGrafica, nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard
				from Grafica
				order by " . $orden . " " . $dir;
	}

	function selectAllByDashboardOrder($orden, $dir) {
		return "select idGrafica, nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard
				from Grafica
				where dashboard_idDashboard = '" . $this -> dashboard . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idGrafica, nombre, detalle, config, fila, posicion, tam, dashboard_idDashboard
				from Grafica
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%' or config like '%" . $search . "%' or fila like '%" . $search . "%' or posicion like '%" . $search . "%' or tam like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Grafica
				where idGrafica = '" . $this -> idGrafica . "'";
	}
}
?>
