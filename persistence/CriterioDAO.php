<?php
class CriterioDAO{
	private $idCriterio;
	private $nombre;
	private $detalle;
	private $resultadoAprendizaje;

	function __construct($pIdCriterio = "", $pNombre = "", $pDetalle = "", $pResultadoAprendizaje = ""){
		$this -> idCriterio = $pIdCriterio;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> resultadoAprendizaje = $pResultadoAprendizaje;
	}

	function insert(){
		return "insert into Criterio(nombre, detalle, id_resultado)
				values('" . $this -> nombre . "', '" . $this -> detalle . "', '" . $this -> resultadoAprendizaje . "')";
	}

	function update(){
		return "update Criterio set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "',
				id_resultado = '" . $this -> resultadoAprendizaje . "'		
				where idCriterio = '" . $this -> idCriterio . "'";
	}

	function select() {
		return "select idCriterio, nombre, detalle, id_resultado
				from Criterio
				where idCriterio = '" . $this -> idCriterio . "'";
	}

	function selectAll() {
		return "select idCriterio, nombre, detalle
				from Criterio";
	}

	function selectAllByResultadoAprendizaje() {
		return "select idCriterio, nombre, detalle, id_resultado
				from Criterio
				where id_resultado = '" . $this -> resultadoAprendizaje . "'";
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
