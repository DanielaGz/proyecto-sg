<?php
require_once ("persistence/CalificacionDAO.php");
require_once ("persistence/Connection.php");

class Calificacion {
	private $idCalificacion;
	private $nivel;
	private $detalle;
	private $criterio;
	private $calificacionDAO;
	private $connection;

	function getIdCalificacion() {
		return $this -> idCalificacion;
	}

	function setIdCalificacion($pIdCalificacion) {
		$this -> idCalificacion = $pIdCalificacion;
	}

	function getNivel() {
		return $this -> nivel;
	}

	function setNivel($pNivel) {
		$this -> nivel = $pNivel;
	}

	function getDetalle() {
		return $this -> detalle;
	}

	function setDetalle($pDetalle) {
		$this -> detalle = $pDetalle;
	}

	function getCriterio() {
		return $this -> criterio;
	}

	function setCriterio($pCriterio) {
		$this -> criterio = $pCriterio;
	}

	function __construct($pIdCalificacion = "", $pNivel = "", $pDetalle = "", $pCriterio = ""){
		$this -> idCalificacion = $pIdCalificacion;
		$this -> nivel = $pNivel;
		$this -> detalle = $pDetalle;
		$this -> criterio = $pCriterio;
		$this -> calificacionDAO = new CalificacionDAO($this -> idCalificacion, $this -> nivel, $this -> detalle, $this -> criterio);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCalificacion = $result[0];
		$this -> nivel = $result[1];
		$this -> detalle = $result[2];
		$criterio = new Criterio($result[3]);
		$criterio -> select();
		$this -> criterio = $criterio;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> selectAll());
		$calificacions = array();
		while ($result = $this -> connection -> fetchRow()){
			$criterio = new Criterio($result[3]);
			$criterio -> select();
			array_push($calificacions, new Calificacion($result[0], $result[1], $result[2], $criterio));
		}
		$this -> connection -> close();
		return $calificacions;
	}

	function selectAllByCriterio(){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> selectAllByCriterio());
		$calificacions = array();
		while ($result = $this -> connection -> fetchRow()){
			$criterio = new Criterio($result[3]);
			$criterio -> select();
			array_push($calificacions, new Calificacion($result[0], $result[1], $result[2], $criterio));
		}
		$this -> connection -> close();
		return $calificacions;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> selectAllOrder($order, $dir));
		$calificacions = array();
		while ($result = $this -> connection -> fetchRow()){
			$criterio = new Criterio($result[3]);
			$criterio -> select();
			array_push($calificacions, new Calificacion($result[0], $result[1], $result[2], $criterio));
		}
		$this -> connection -> close();
		return $calificacions;
	}

	function selectAllByCriterioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> selectAllByCriterioOrder($order, $dir));
		$calificacions = array();
		while ($result = $this -> connection -> fetchRow()){
			$criterio = new Criterio($result[3]);
			$criterio -> select();
			array_push($calificacions, new Calificacion($result[0], $result[1], $result[2], $criterio));
		}
		$this -> connection -> close();
		return $calificacions;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> search($search));
		$calificacions = array();
		while ($result = $this -> connection -> fetchRow()){
			$criterio = new Criterio($result[3]);
			$criterio -> select();
			array_push($calificacions, new Calificacion($result[0], $result[1], $result[2], $criterio));
		}
		$this -> connection -> close();
		return $calificacions;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> calificacionDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
