<?php
require_once ("persistence/LogAdministratorDAO.php");
require_once ("persistence/Connection.php");

class LogAdministrator {
	private $idLogAdministrator;
	private $action;
	private $information;
	private $date;
	private $time;
	private $ip;
	private $os;
	private $browser;
	private $administrator;
	private $logAdministratorDAO;
	private $connection;

	function getIdLogAdministrator() {
		return $this -> idLogAdministrator;
	}

	function setIdLogAdministrator($pIdLogAdministrator) {
		$this -> idLogAdministrator = $pIdLogAdministrator;
	}

	function getAction() {
		return $this -> action;
	}

	function setAction($pAction) {
		$this -> action = $pAction;
	}

	function getInformation() {
		return $this -> information;
	}

	function setInformation($pInformation) {
		$this -> information = $pInformation;
	}

	function getDate() {
		return $this -> date;
	}

	function setDate($pDate) {
		$this -> date = $pDate;
	}

	function getTime() {
		return $this -> time;
	}

	function setTime($pTime) {
		$this -> time = $pTime;
	}

	function getIp() {
		return $this -> ip;
	}

	function setIp($pIp) {
		$this -> ip = $pIp;
	}

	function getOs() {
		return $this -> os;
	}

	function setOs($pOs) {
		$this -> os = $pOs;
	}

	function getBrowser() {
		return $this -> browser;
	}

	function setBrowser($pBrowser) {
		$this -> browser = $pBrowser;
	}

	function getAdministrator() {
		return $this -> administrator;
	}

	function setAdministrator($pAdministrator) {
		$this -> administrator = $pAdministrator;
	}

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
		$this -> logAdministratorDAO = new LogAdministratorDAO($this -> idLogAdministrator, $this -> action, $this -> information, $this -> date, $this -> time, $this -> ip, $this -> os, $this -> browser, $this -> administrator);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> insert());
		$id = $this -> connection -> lastId();;
		$this -> connection -> close();
		return $id;
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogAdministrator = $result[0];
		$this -> action = $result[1];
		$this -> information = $result[2];
		$this -> date = $result[3];
		$this -> time = $result[4];
		$this -> ip = $result[5];
		$this -> os = $result[6];
		$this -> browser = $result[7];
		$administrator = new Administrator($result[8]);
		$administrator -> select();
		$this -> administrator = $administrator;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAll());
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function selectAllByAdministrator(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAllByAdministrator());
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAllOrder($order, $dir));
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function selectAllByAdministratorOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAllByAdministratorOrder($order, $dir));
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> search($search));
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}
}
?>
