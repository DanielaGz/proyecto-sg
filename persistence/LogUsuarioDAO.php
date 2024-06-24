<?php
class LogUsuarioDAO{
	private $idLogUsuario;
	private $action;
	private $information;
	private $date;
	private $time;
	private $ip;
	private $os;
	private $browser;
	private $usuario;

	function __construct($pIdLogUsuario = "", $pAction = "", $pInformation = "", $pDate = "", $pTime = "", $pIp = "", $pOs = "", $pBrowser = "", $pUsuario = ""){
		$this -> idLogUsuario = $pIdLogUsuario;
		$this -> action = $pAction;
		$this -> information = $pInformation;
		$this -> date = $pDate;
		$this -> time = $pTime;
		$this -> ip = $pIp;
		$this -> os = $pOs;
		$this -> browser = $pBrowser;
		$this -> usuario = $pUsuario;
	}

	function insert(){
		return "insert into LogUsuario(action, information, date, time, ip, os, browser, usuario_idUsuario)
				values('" . $this -> action . "', '" . $this -> information . "', '" . $this -> date . "', '" . $this -> time . "', '" . $this -> ip . "', '" . $this -> os . "', '" . $this -> browser . "', '" . $this -> usuario . "')";
	}

	function update(){
		return "update LogUsuario set 
				action = '" . $this -> action . "',
				information = '" . $this -> information . "',
				date = '" . $this -> date . "',
				time = '" . $this -> time . "',
				ip = '" . $this -> ip . "',
				os = '" . $this -> os . "',
				browser = '" . $this -> browser . "',
				usuario_idUsuario = '" . $this -> usuario . "'	
				where idLogUsuario = '" . $this -> idLogUsuario . "'";
	}

	function select() {
		return "select idLogUsuario, action, information, date, time, ip, os, browser, usuario_idUsuario
				from LogUsuario
				where idLogUsuario = '" . $this -> idLogUsuario . "'";
	}

	function selectAll() {
		return "select idLogUsuario, action, information, date, time, ip, os, browser, usuario_idUsuario
				from LogUsuario";
	}

	function selectAllByUsuario() {
		return "select idLogUsuario, action, information, date, time, ip, os, browser, usuario_idUsuario
				from LogUsuario
				where usuario_idUsuario = '" . $this -> usuario . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogUsuario, action, information, date, time, ip, os, browser, usuario_idUsuario
				from LogUsuario
				order by " . $orden . " " . $dir;
	}

	function selectAllByUsuarioOrder($orden, $dir) {
		return "select idLogUsuario, action, information, date, time, ip, os, browser, usuario_idUsuario
				from LogUsuario
				where usuario_idUsuario = '" . $this -> usuario . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogUsuario, action, information, date, time, ip, os, browser, usuario_idUsuario
				from LogUsuario
				where action like '%" . $search . "%' or date like '%" . $search . "%' or time like '%" . $search . "%' or ip like '%" . $search . "%' or os like '%" . $search . "%' or browser like '%" . $search . "%'
				order by date desc, time desc";
	}
}
?>
