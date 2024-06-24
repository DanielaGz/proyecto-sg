<?php
require_once ("persistence/BloomDAO.php");
require_once ("persistence/Connection.php");

class Bloom {
	private $idBloom;
	private $nombre;
	private $detalle;
	private $resultadoAprendizaje;
	private $bloomDAO;
	private $connection;

	function getIdBloom() {
		return $this -> idBloom;
	}

	function setIdBloom($pIdBloom) {
		$this -> idBloom = $pIdBloom;
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

	function getResultadoAprendizaje() {
		return $this -> resultadoAprendizaje;
	}

	function setResultadoAprendizaje($pResultadoAprendizaje) {
		$this -> resultadoAprendizaje = $pResultadoAprendizaje;
	}

	function __construct($pIdBloom = "", $pNombre = "", $pDetalle = "", $pResultadoAprendizaje = ""){
		$this -> idBloom = $pIdBloom;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> resultadoAprendizaje = $pResultadoAprendizaje;
		$this -> bloomDAO = new BloomDAO($this -> idBloom, $this -> nombre, $this -> detalle, $this -> resultadoAprendizaje);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idBloom = $result[0];
		$this -> nombre = $result[1];
		$this -> detalle = $result[2];
		$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
		$resultadoAprendizaje -> select();
		$this -> resultadoAprendizaje = $resultadoAprendizaje;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> selectAll());
		$blooms = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($blooms, new Bloom($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $blooms;
	}

	function selectAllByResultadoAprendizaje(){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> selectAllByResultadoAprendizaje());
		$blooms = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($blooms, new Bloom($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $blooms;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> selectAllOrder($order, $dir));
		$blooms = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($blooms, new Bloom($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $blooms;
	}

	function selectAllByResultadoAprendizajeOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> selectAllByResultadoAprendizajeOrder($order, $dir));
		$blooms = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($blooms, new Bloom($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $blooms;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> search($search));
		$blooms = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($blooms, new Bloom($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $blooms;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> bloomDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
