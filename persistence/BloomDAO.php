<?php
class BloomDAO{
	private $idBloom;
	private $nombre;
	private $detalle;
	private $resultadoAprendizaje;

	function __construct($pIdBloom = "", $pNombre = "", $pDetalle = "", $pResultadoAprendizaje = ""){
		$this -> idBloom = $pIdBloom;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> resultadoAprendizaje = $pResultadoAprendizaje;
	}

	function insert(){
		return "insert into Bloom(nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje)
				values('" . $this -> nombre . "', '" . $this -> detalle . "', '" . $this -> resultadoAprendizaje . "')";
	}

	function update(){
		return "update Bloom set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "',
				resultadoAprendizaje_idResultadoAprendizaje = '" . $this -> resultadoAprendizaje . "'	
				where idBloom = '" . $this -> idBloom . "'";
	}

	function select() {
		return "select idBloom, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Bloom
				where idBloom = '" . $this -> idBloom . "'";
	}

	function selectAll() {
		return "select idBloom, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Bloom";
	}

	function selectAllByResultadoAprendizaje() {
		return "select idBloom, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Bloom
				where resultadoAprendizaje_idResultadoAprendizaje = '" . $this -> resultadoAprendizaje . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idBloom, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Bloom
				order by " . $orden . " " . $dir;
	}

	function selectAllByResultadoAprendizajeOrder($orden, $dir) {
		return "select idBloom, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Bloom
				where resultadoAprendizaje_idResultadoAprendizaje = '" . $this -> resultadoAprendizaje . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idBloom, nombre, detalle, resultadoAprendizaje_idResultadoAprendizaje
				from Bloom
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Bloom
				where idBloom = '" . $this -> idBloom . "'";
	}
}
?>
