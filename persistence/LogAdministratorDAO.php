<?php
class LogAdministratorDAO{
	private $idLogAdministrator;
	private $action;
	private $information;
	private $date;
	private $time;
	private $ip;
	private $os;
	private $browser;
	private $administrator;

	function __construct($pIdLogAdministrator = "", $pAction = "", $pInformation = "", $pDate = "", $pTime = "", $pIp = "", $pOs = "", $pBrowser = "", $pAdministrator = ""){
		$this -> idLogAdministrator = $pIdLogAdministrator;
		$this -> action = $pAction;
		$this -> information = $pInformation;
		$this -> date = $pDate;
		$this -> time = $pTime;
		$this -> ip = $pIp;
		$this -> os = $pOs;
		$this -> browser = $pBrowser;
		$this -> administrator = $pAdministrator;
	}

	function insert(){
		return "insert into LogAdministrator(action, information, date, time, ip, os, browser, administrator_idAdministrator)
				values('" . $this -> action . "', '" . $this -> information . "', '" . $this -> date . "', '" . $this -> time . "', '" . $this -> ip . "', '" . $this -> os . "', '" . $this -> browser . "', '" . $this -> administrator . "')";
	}

	function update(){
		return "update LogAdministrator set 
				action = '" . $this -> action . "',
				information = '" . $this -> information . "',
				date = '" . $this -> date . "',
				time = '" . $this -> time . "',
				ip = '" . $this -> ip . "',
				os = '" . $this -> os . "',
				browser = '" . $this -> browser . "',
				administrator_idAdministrator = '" . $this -> administrator . "'	
				where idLogAdministrator = '" . $this -> idLogAdministrator . "'";
	}

	function select() {
		return "select idLogAdministrator, action, information, date, time, ip, os, browser, administrator_idAdministrator
				from LogAdministrator
				where idLogAdministrator = '" . $this -> idLogAdministrator . "'";
	}

	function selectAll() {
		return "select idLogAdministrator, action, information, date, time, ip, os, browser, administrator_idAdministrator
				from LogAdministrator";
	}

	function selectAllByAdministrator() {
		return "select idLogAdministrator, action, information, date, time, ip, os, browser, administrator_idAdministrator
				from LogAdministrator
				where administrator_idAdministrator = '" . $this -> administrator . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogAdministrator, action, information, date, time, ip, os, browser, administrator_idAdministrator
				from LogAdministrator
				order by " . $orden . " " . $dir;
	}

	function selectAllByAdministratorOrder($orden, $dir) {
		return "select idLogAdministrator, action, information, date, time, ip, os, browser, administrator_idAdministrator
				from LogAdministrator
				where administrator_idAdministrator = '" . $this -> administrator . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogAdministrator, action, information, date, time, ip, os, browser, administrator_idAdministrator
				from LogAdministrator
				where action like '%" . $search . "%' or date like '%" . $search . "%' or time like '%" . $search . "%' or ip like '%" . $search . "%' or os like '%" . $search . "%' or browser like '%" . $search . "%'
				order by date desc, time desc";
	}
}
?>
