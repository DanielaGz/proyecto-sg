<?php
class EstrategiaDAO{
	private $idEstrategia;
	private $nombre;
	private $detalle;
	private $resultadoAprendizaje;

	function __construct($pIdEstrategia = "", $pNombre = "", $pDetalle = "", $pResultadoAprendizaje = ""){
		$this -> idEstrategia = $pIdEstrategia;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> resultadoAprendizaje = $pResultadoAprendizaje;
	}

	function insert(){
		return "insert into Estrategia(nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje)
				values('" . $this -> nombre . "', '" . $this -> detalle . "', '" . $this -> resultadoAprendizaje . "')";
	}

	function update(){
		return "update Estrategia set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "',
				resultadoAprendizaje_idResultadoAprendizaje = '" . $this -> resultadoAprendizaje . "'	
				where idEstrategia = '" . $this -> idEstrategia . "'";
	}

	function select() {
		return "select idEstrategia, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Estrategia
				where idEstrategia = '" . $this -> idEstrategia . "'";
	}

	function selectAll() {
		return "select idEstrategia, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Estrategia";
	}

	function selectAllByResultadoAprendizaje() {
		return "select idEstrategia, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Estrategia
				where resultadoAprendizaje_idResultadoAprendizaje = '" . $this -> resultadoAprendizaje . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idEstrategia, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Estrategia
				order by " . $orden . " " . $dir;
	}

	function selectAllByResultadoAprendizajeOrder($orden, $dir) {
		return "select idEstrategia, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Estrategia
				where resultadoAprendizaje_idResultadoAprendizaje = '" . $this -> resultadoAprendizaje . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idEstrategia, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Estrategia
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Estrategia
				where idEstrategia = '" . $this -> idEstrategia . "'";
	}
}
?>
