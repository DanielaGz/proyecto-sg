<?php
require_once ("persistence/CategoriaRaDAO.php");
require_once ("persistence/Connection.php");

class CategoriaRa {
	private $idCategoriaRa;
	private $nombre;
	private $categoriaRaDAO;
	private $connection;

	function getIdCategoriaRa() {
		return $this -> idCategoriaRa;
	}

	function setIdCategoriaRa($pIdCategoriaRa) {
		$this -> idCategoriaRa = $pIdCategoriaRa;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function __construct($pIdCategoriaRa = "", $pNombre = ""){
		$this -> idCategoriaRa = $pIdCategoriaRa;
		$this -> nombre = $pNombre;
		$this -> categoriaRaDAO = new CategoriaRaDAO($this -> idCategoriaRa, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCategoriaRa = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> selectAll());
		$categoriaRas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($categoriaRas, new CategoriaRa($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $categoriaRas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> selectAllOrder($order, $dir));
		$categoriaRas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($categoriaRas, new CategoriaRa($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $categoriaRas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> search($search));
		$categoriaRas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($categoriaRas, new CategoriaRa($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $categoriaRas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoriaRaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
