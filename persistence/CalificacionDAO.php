<?php
class CalificacionDAO{
	private $idCalificacion;
	private $nivel;
	private $detalle;
	private $criterio;

	function __construct($pIdCalificacion = "", $pNivel = "", $pDetalle = "", $pCriterio = ""){
		$this -> idCalificacion = $pIdCalificacion;
		$this -> nivel = $pNivel;
		$this -> detalle = $pDetalle;
		$this -> criterio = $pCriterio;
	}

	function insert(){
		return "insert into Calificacion(nivel, detalle, criterio_idCriterio)
				values('" . $this -> nivel . "', '" . $this -> detalle . "', '" . $this -> criterio . "')";
	}

	function update(){
		return "update Calificacion set 
				nivel = '" . $this -> nivel . "',
				detalle = '" . $this -> detalle . "',
				criterio_idCriterio = '" . $this -> criterio . "'	
				where idCalificacion = '" . $this -> idCalificacion . "'";
	}

	function select() {
		return "select idCalificacion, nivel, detalle, criterio_idCriterio
				from Calificacion
				where idCalificacion = '" . $this -> idCalificacion . "'";
	}

	function selectAll() {
		return "select idCalificacion, nivel, detalle, criterio_idCriterio
				from Calificacion";
	}

	function selectAllByCriterio() {
		return "select idCalificacion, nivel, detalle, criterio_idCriterio
				from Calificacion
				where criterio_idCriterio = '" . $this -> criterio . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idCalificacion, nivel, detalle, criterio_idCriterio
				from Calificacion
				order by " . $orden . " " . $dir;
	}

	function selectAllByCriterioOrder($orden, $dir) {
		return "select idCalificacion, nivel, detalle, criterio_idCriterio
				from Calificacion
				where criterio_idCriterio = '" . $this -> criterio . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCalificacion, nivel, detalle, criterio_idCriterio
				from Calificacion
				where nivel like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Calificacion
				where idCalificacion = '" . $this -> idCalificacion . "'";
	}
}
?>
