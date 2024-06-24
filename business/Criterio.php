<?php
require_once ("persistence/CriterioDAO.php");
require_once ("persistence/Connection.php");

class Criterio {
	private $idCriterio;
	private $nombre;
	private $detalle;
	private $criterioDAO;
	private $connection;

	function getIdCriterio() {
		return $this -> idCriterio;
	}

	function setIdCriterio($pIdCriterio) {
		$this -> idCriterio = $pIdCriterio;
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

	function __construct($pIdCriterio = "", $pNombre = "", $pDetalle = ""){
		$this -> idCriterio = $pIdCriterio;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> criterioDAO = new CriterioDAO($this -> idCriterio, $this -> nombre, $this -> detalle);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCriterio = $result[0];
		$this -> nombre = $result[1];
		$this -> detalle = $result[2];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> selectAll());
		$criterios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($criterios, new Criterio($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $criterios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> selectAllOrder($order, $dir));
		$criterios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($criterios, new Criterio($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $criterios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> search($search));
		$criterios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($criterios, new Criterio($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $criterios;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> criterioDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
