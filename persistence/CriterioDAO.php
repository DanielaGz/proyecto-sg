<?php
class CriterioDAO{
	private $idCriterio;
	private $nombre;
	private $detalle;

	function __construct($pIdCriterio = "", $pNombre = "", $pDetalle = ""){
		$this -> idCriterio = $pIdCriterio;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
	}

	function insert(){
		return "insert into Criterio(nombre, detalle)
				values('" . $this -> nombre . "', '" . $this -> detalle . "')";
	}

	function update(){
		return "update Criterio set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "'	
				where idCriterio = '" . $this -> idCriterio . "'";
	}

	function select() {
		return "select idCriterio, nombre, detalle
				from Criterio
				where idCriterio = '" . $this -> idCriterio . "'";
	}

	function selectAll() {
		return "select idCriterio, nombre, detalle
				from Criterio";
	}

	function selectAllOrder($orden, $dir){
		return "select idCriterio, nombre, detalle
				from Criterio
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCriterio, nombre, detalle
				from Criterio
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Criterio
				where idCriterio = '" . $this -> idCriterio . "'";
	}
}
?>
