<?php
class ResultadoAprendizajeDAO{
	private $idResultadoAprendizaje;
	private $nombre;
	private $detalle;
	private $bloom;
	private $categoriaRa;

	function __construct($pIdResultadoAprendizaje = "", $pNombre = "", $pDetalle = "", $pBloom = "", $pCategoriaRa = ""){
		$this -> idResultadoAprendizaje = $pIdResultadoAprendizaje;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
		$this -> bloom = $pBloom;
		$this -> categoriaRa = $pCategoriaRa;
	}

	function insert(){
		return "insert into ResultadoAprendizaje(nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa)
				values('" . $this -> nombre . "', '" . $this -> detalle . "', '" . $this -> bloom . "', '" . $this -> categoriaRa . "')";
	}

	function update(){
		return "update ResultadoAprendizaje set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "',
				bloom_idBloom = '" . $this -> bloom . "',
				categoriaRa_idCategoriaRa = '" . $this -> categoriaRa . "'	
				where idResultadoAprendizaje = '" . $this -> idResultadoAprendizaje . "'";
	}

	function select() {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				where idResultadoAprendizaje = '" . $this -> idResultadoAprendizaje . "'";
	}

	function selectAll() {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje";
	}

	function selectAllByBloom() {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				where bloom_idBloom = '" . $this -> bloom . "'";
	}

	function selectAllByCategoriaRa() {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				where categoriaRa_idCategoriaRa = '" . $this -> categoriaRa . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				order by " . $orden . " " . $dir;
	}

	function selectAllByBloomOrder($orden, $dir) {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				where bloom_idBloom = '" . $this -> bloom . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByCategoriaRaOrder($orden, $dir) {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				where categoriaRa_idCategoriaRa = '" . $this -> categoriaRa . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idResultadoAprendizaje, nombre, detalle, bloom_idBloom, categoriaRa_idCategoriaRa
				from ResultadoAprendizaje
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from ResultadoAprendizaje
				where idResultadoAprendizaje = '" . $this -> idResultadoAprendizaje . "'";
	}
}
?>
