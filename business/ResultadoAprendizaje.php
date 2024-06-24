<?php
require_once ("persistence/ResultadoAprendizajeDAO.php");
require_once ("persistence/Connection.php");

class ResultadoAprendizaje {
	private $idResultadoAprendizaje;
	private $nombre;
	private $detalle;
	private $bloom;
	private $categoriaRa;
	private $resultadoAprendizajeDAO;
	private $connection;

	function getIdResultadoAprendizaje() {
		return $this -> idResultadoAprendizaje;
	}

	function setIdResultadoAprendizaje($pIdResultadoAprendizaje) {
		$this -> idResultadoAprendizaje = $pIdResultadoAprendizaje;
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

	function getBloom() {
		return $this -> bloom;
	}

	function setBloom($pBloom) {
		$this -> bloom = $pBloom;
	}

	function getCategoriaRa() {
		return $this -> categoriaRa;
	}

	function setCategoriaRa($pCategoriaRa) {
		$this -> categoriaRa = $pCategoriaRa;
	}

	function __construct($pIdResultadoAprendizaje = "", $pNombre = "", $pDetalle = "", $pBloom = "", $pCategoriaRa = ""){
		$this -> idResultadoAprendizaje = $pIdResultadoAprendizaje;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> bloom = $pBloom;
		$this -> categoriaRa = $pCategoriaRa;
		$this -> resultadoAprendizajeDAO = new ResultadoAprendizajeDAO($this -> idResultadoAprendizaje, $this -> nombre, $this -> detalle, $this -> bloom, $this -> categoriaRa);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idResultadoAprendizaje = $result[0];
		$this -> nombre = $result[1];
		$this -> detalle = $result[2];
		$bloom = new Bloom($result[3]);
		$bloom -> select();
		$this -> bloom = $bloom;
		$categoriaRa = new CategoriaRa($result[4]);
		$categoriaRa -> select();
		$this -> categoriaRa = $categoriaRa;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> selectAll());
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function selectAllByBloom(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> selectAllByBloom());
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function selectAllByCategoriaRa(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> selectAllByCategoriaRa());
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> selectAllOrder($order, $dir));
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function selectAllByBloomOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> selectAllByBloomOrder($order, $dir));
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function selectAllByCategoriaRaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> selectAllByCategoriaRaOrder($order, $dir));
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> search($search));
		$resultadoAprendizajes = array();
		while ($result = $this -> connection -> fetchRow()){
			$bloom = new Bloom($result[3]);
			$bloom -> select();
			$categoriaRa = new CategoriaRa($result[4]);
			$categoriaRa -> select();
			array_push($resultadoAprendizajes, new ResultadoAprendizaje($result[0], $result[1], $result[2], $bloom, $categoriaRa));
		}
		$this -> connection -> close();
		return $resultadoAprendizajes;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> resultadoAprendizajeDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
