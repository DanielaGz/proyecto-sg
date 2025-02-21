<?php
require_once ("persistence/EstrategiaDAO.php");
require_once ("persistence/Connection.php");

class Estrategia {
	private $idEstrategia;
	private $nombre;
	private $detalle;
	private $resultadoAprendizaje;
	private $estrategiaDAO;
	private $connection;

	function getIdEstrategia() {
		return $this -> idEstrategia;
	}

	function setIdEstrategia($pIdEstrategia) {
		$this -> idEstrategia = $pIdEstrategia;
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

	function __construct($pIdEstrategia = "", $pNombre = "", $pDetalle = "", $pResultadoAprendizaje = ""){
		$this -> idEstrategia = $pIdEstrategia;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> resultadoAprendizaje = $pResultadoAprendizaje;
		$this -> estrategiaDAO = new EstrategiaDAO($this -> idEstrategia, $this -> nombre, $this -> detalle, $this -> resultadoAprendizaje);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idEstrategia = $result[0];
		$this -> nombre = $result[1];
		$this -> detalle = $result[2];
		$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
		$resultadoAprendizaje -> select();
		$this -> resultadoAprendizaje = $resultadoAprendizaje;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> selectAll());
		$estrategias = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($estrategias, new Estrategia($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $estrategias;
	}

	function selectAllByResultadoAprendizaje(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> selectAllByResultadoAprendizaje());
		$estrategias = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($estrategias, new Estrategia($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $estrategias;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> selectAllOrder($order, $dir));
		$estrategias = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($estrategias, new Estrategia($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $estrategias;
	}

	function selectAllByResultadoAprendizajeOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> selectAllByResultadoAprendizajeOrder($order, $dir));
		$estrategias = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($estrategias, new Estrategia($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $estrategias;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> search($search));
		$estrategias = array();
		while ($result = $this -> connection -> fetchRow()){
			$resultadoAprendizaje = new ResultadoAprendizaje($result[3]);
			$resultadoAprendizaje -> select();
			array_push($estrategias, new Estrategia($result[0], $result[1], $result[2], $resultadoAprendizaje));
		}
		$this -> connection -> close();
		return $estrategias;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
