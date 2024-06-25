<?php
class BloomDAO{
	private $idBloom;
	private $nombre;
	private $detalle;

	function __construct($pIdBloom = "", $pNombre = "", $pDetalle = ""){
		$this -> idBloom = $pIdBloom;
		$this -> nombre = $pNombre;
		$this -> detalle = $pDetalle;
	}

	function insert(){
		return "insert into Bloom(nombre, detalle)
				values('" . $this -> nombre . "', '" . $this -> detalle . "')";
	}

	function update(){
		return "update Bloom set 
				nombre = '" . $this -> nombre . "',
				detalle = '" . $this -> detalle . "',
				where idBloom = '" . $this -> idBloom . "'";
	}

	function select() {
		return "select idBloom, nombre, detalle
				from Bloom
				where idBloom = '" . $this -> idBloom . "'";
	}

	function selectAll() {
		return "select idBloom, nombre, detalle
				from Bloom";
	}

	function selectAllOrder($orden, $dir){
		return "select idBloom, nombre, detalle 
				from Bloom 
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idBloom, nombre, detalle
				from Bloom
				where nombre like '%" . $search . "%' or detalle like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Bloom
				where idBloom = '" . $this -> idBloom . "'";
	}
}
?>
