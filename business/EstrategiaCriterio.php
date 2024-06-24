<?php
require_once ("persistence/EstrategiaCriterioDAO.php");
require_once ("persistence/Connection.php");

class EstrategiaCriterio {
	private $idEstrategiaCriterio;
	private $estrategia;
	private $criterio;
	private $estrategiaCriterioDAO;
	private $connection;

	function getIdEstrategiaCriterio() {
		return $this -> idEstrategiaCriterio;
	}

	function setIdEstrategiaCriterio($pIdEstrategiaCriterio) {
		$this -> idEstrategiaCriterio = $pIdEstrategiaCriterio;
	}

	function getEstrategia() {
		return $this -> estrategia;
	}

	function setEstrategia($pEstrategia) {
		$this -> estrategia = $pEstrategia;
	}

	function getCriterio() {
		return $this -> criterio;
	}

	function setCriterio($pCriterio) {
		$this -> criterio = $pCriterio;
	}

	function __construct($pIdEstrategiaCriterio = "", $pEstrategia = "", $pCriterio = ""){
		$this -> idEstrategiaCriterio = $pIdEstrategiaCriterio;
		$this -> estrategia = $pEstrategia;
		$this -> criterio = $pCriterio;
		$this -> estrategiaCriterioDAO = new EstrategiaCriterioDAO($this -> idEstrategiaCriterio, $this -> estrategia, $this -> criterio);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idEstrategiaCriterio = $result[0];
		$estrategia = new Estrategia($result[1]);
		$estrategia -> select();
		$this -> estrategia = $estrategia;
		$criterio = new Criterio($result[2]);
		$criterio -> select();
		$this -> criterio = $criterio;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> selectAll());
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function selectAllByEstrategia(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> selectAllByEstrategia());
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function selectAllByCriterio(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> selectAllByCriterio());
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> selectAllOrder($order, $dir));
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function selectAllByEstrategiaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> selectAllByEstrategiaOrder($order, $dir));
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function selectAllByCriterioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> selectAllByCriterioOrder($order, $dir));
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> search($search));
		$estrategiaCriterios = array();
		while ($result = $this -> connection -> fetchRow()){
			$estrategia = new Estrategia($result[1]);
			$estrategia -> select();
			$criterio = new Criterio($result[2]);
			$criterio -> select();
			array_push($estrategiaCriterios, new EstrategiaCriterio($result[0], $estrategia, $criterio));
		}
		$this -> connection -> close();
		return $estrategiaCriterios;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> estrategiaCriterioDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
