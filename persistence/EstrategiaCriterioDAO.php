<?php
class EstrategiaCriterioDAO{
	private $idEstrategiaCriterio;
	private $estrategia;
	private $criterio;

	function __construct($pIdEstrategiaCriterio = "", $pEstrategia = "", $pCriterio = ""){
		$this -> idEstrategiaCriterio = $pIdEstrategiaCriterio;
		$this -> estrategia = $pEstrategia;
		$this -> criterio = $pCriterio;
	}

	function insert(){
		return "insert into EstrategiaCriterio(estrategia_idEstrategia, criterio_idCriterio)
				values('" . $this -> estrategia . "', '" . $this -> criterio . "')";
	}

	function update(){
		return "update EstrategiaCriterio set 
				estrategia_idEstrategia = '" . $this -> estrategia . "',
				criterio_idCriterio = '" . $this -> criterio . "'	
				where idEstrategiaCriterio = '" . $this -> idEstrategiaCriterio . "'";
	}

	function select() {
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio
				where idEstrategiaCriterio = '" . $this -> idEstrategiaCriterio . "'";
	}

	function selectAll() {
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio";
	}

	function selectAllByEstrategia() {
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio
				where estrategia_idEstrategia = '" . $this -> estrategia . "'";
	}

	function selectAllByCriterio() {
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio
				where criterio_idCriterio = '" . $this -> criterio . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio
				order by " . $orden . " " . $dir;
	}

	function selectAllByEstrategiaOrder($orden, $dir) {
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio
				where estrategia_idEstrategia = '" . $this -> estrategia . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByCriterioOrder($orden, $dir) {
		return "select idEstrategiaCriterio, estrategia_idEstrategia, criterio_idCriterio
				from EstrategiaCriterio
				where criterio_idCriterio = '" . $this -> criterio . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from EstrategiaCriterio
				where idEstrategiaCriterio = '" . $this -> idEstrategiaCriterio . "'";
	}
}
?>
