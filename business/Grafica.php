<?php
require_once ("persistence/GraficaDAO.php");
require_once ("persistence/Connection.php");

class Grafica {
	private $idGrafica;
	private $nombre;
	private $detalle;
	private $config;
	private $fila;
	private $posicion;
	private $tam;
	private $dashboard;
	private $graficaDAO;
	private $connection;

	function getIdGrafica() {
		return $this -> idGrafica;
	}

	function setIdGrafica($pIdGrafica) {
		$this -> idGrafica = $pIdGrafica;
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

	function getConfig() {
		return $this -> config;
	}

	function setConfig($pConfig) {
		$this -> config = $pConfig;
	}

	function getFila() {
		return $this -> fila;
	}

	function setFila($pFila) {
		$this -> fila = $pFila;
	}

	function getPosicion() {
		return $this -> posicion;
	}

	function setPosicion($pPosicion) {
		$this -> posicion = $pPosicion;
	}

	function getTam() {
		return $this -> tam;
	}

	function setTam($pTam) {
		$this -> tam = $pTam;
	}

	function getDashboard() {
		return $this -> dashboard;
	}

	function setDashboard($pDashboard) {
		$this -> dashboard = $pDashboard;
	}

	function __construct($pIdGrafica = "", $pNombre = "", $pDetalle = "", $pConfig = "", $pFila = "", $pPosicion = "", $pTam = "", $pDashboard = ""){
		$this -> idGrafica = $pIdGrafica;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> config = $pConfig;
		$this -> fila = $pFila;
		$this -> posicion = $pPosicion;
		$this -> tam = $pTam;
		$this -> dashboard = $pDashboard;
		$this -> graficaDAO = new GraficaDAO($this -> idGrafica, $this -> nombre, $this -> detalle, $this -> config, $this -> fila, $this -> posicion, $this -> tam, $this -> dashboard);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idGrafica = $result[0];
		$this -> nombre = $result[1];
		$this -> detalle = $result[2];
		$this -> config = $result[3];
		$this -> fila = $result[4];
		$this -> posicion = $result[5];
		$this -> tam = $result[6];
		$dashboard = new Dashboard($result[7]);
		$dashboard -> select();
		$this -> dashboard = $dashboard;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> selectAll());
		$graficas = array();
		while ($result = $this -> connection -> fetchRow()){
			$dashboard = new Dashboard($result[7]);
			$dashboard -> select();
			array_push($graficas, new Grafica($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $dashboard));
		}
		$this -> connection -> close();
		return $graficas;
	}

	function selectAllByDashboard(){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> selectAllByDashboard());
		$graficas = array();
		while ($result = $this -> connection -> fetchRow()){
			$dashboard = new Dashboard($result[7]);
			$dashboard -> select();
			array_push($graficas, new Grafica($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $dashboard));
		}
		$this -> connection -> close();
		return $graficas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> selectAllOrder($order, $dir));
		$graficas = array();
		while ($result = $this -> connection -> fetchRow()){
			$dashboard = new Dashboard($result[7]);
			$dashboard -> select();
			array_push($graficas, new Grafica($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $dashboard));
		}
		$this -> connection -> close();
		return $graficas;
	}

	function selectAllByDashboardOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> selectAllByDashboardOrder($order, $dir));
		$graficas = array();
		while ($result = $this -> connection -> fetchRow()){
			$dashboard = new Dashboard($result[7]);
			$dashboard -> select();
			array_push($graficas, new Grafica($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $dashboard));
		}
		$this -> connection -> close();
		return $graficas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> search($search));
		$graficas = array();
		while ($result = $this -> connection -> fetchRow()){
			$dashboard = new Dashboard($result[7]);
			$dashboard -> select();
			array_push($graficas, new Grafica($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $dashboard));
		}
		$this -> connection -> close();
		return $graficas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> graficaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
