<?php
class CategoriaRaDAO{
	private $idCategoriaRa;
	private $nombre;

	function __construct($pIdCategoriaRa = "", $pNombre = ""){
		$this -> idCategoriaRa = $pIdCategoriaRa;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into CategoriaRa(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update CategoriaRa set 
				nombre = '" . $this -> nombre . "'	
				where idCategoriaRa = '" . $this -> idCategoriaRa . "'";
	}

	function select() {
		return "select idCategoriaRa, nombre
				from CategoriaRa
				where idCategoriaRa = '" . $this -> idCategoriaRa . "'";
	}

	function selectAll() {
		return "select idCategoriaRa, nombre
				from CategoriaRa";
	}

	function selectAllOrder($orden, $dir){
		return "select idCategoriaRa, nombre
				from CategoriaRa
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCategoriaRa, nombre
				from CategoriaRa
				where nombre like '%" . $search . "%'";
	}

	function delete(){
		return "delete from CategoriaRa
				where idCategoriaRa = '" . $this -> idCategoriaRa . "'";
	}
}
?>
