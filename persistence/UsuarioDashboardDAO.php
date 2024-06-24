<?php
class UsuarioDashboardDAO{
	private $idUsuarioDashboard;
	private $usuario;
	private $dashboard;

	function __construct($pIdUsuarioDashboard = "", $pUsuario = "", $pDashboard = ""){
		$this -> idUsuarioDashboard = $pIdUsuarioDashboard;
		$this -> usuario = $pUsuario;
		$this -> dashboard = $pDashboard;
	}

	function insert(){
		return "insert into UsuarioDashboard(usuario_idUsuario, dashboard_idDashboard)
				values('" . $this -> usuario . "', '" . $this -> dashboard . "')";
	}

	function update(){
		return "update UsuarioDashboard set 
				usuario_idUsuario = '" . $this -> usuario . "',
				dashboard_idDashboard = '" . $this -> dashboard . "'	
				where idUsuarioDashboard = '" . $this -> idUsuarioDashboard . "'";
	}

	function select() {
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard
				where idUsuarioDashboard = '" . $this -> idUsuarioDashboard . "'";
	}

	function selectAll() {
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard";
	}

	function selectAllByUsuario() {
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard
				where usuario_idUsuario = '" . $this -> usuario . "'";
	}

	function selectAllByDashboard() {
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard
				where dashboard_idDashboard = '" . $this -> dashboard . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard
				order by " . $orden . " " . $dir;
	}

	function selectAllByUsuarioOrder($orden, $dir) {
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard
				where usuario_idUsuario = '" . $this -> usuario . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByDashboardOrder($orden, $dir) {
		return "select idUsuarioDashboard, usuario_idUsuario, dashboard_idDashboard
				from UsuarioDashboard
				where dashboard_idDashboard = '" . $this -> dashboard . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from UsuarioDashboard
				where idUsuarioDashboard = '" . $this -> idUsuarioDashboard . "'";
	}
}
?>
