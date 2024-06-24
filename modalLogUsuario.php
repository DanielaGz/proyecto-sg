<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/LogUsuario.php");
require("business/Usuario.php");
require("business/UsuarioDashboard.php");
require("business/Dashboard.php");
require("business/Grafica.php");
require("business/CategoriaRa.php");
require("business/Bloom.php");
require("business/ResultadoAprendizaje.php");
require("business/Estrategia.php");
require("business/EstrategiaCriterio.php");
require("business/Criterio.php");
require("business/Calificacion.php");
require_once("persistence/Connection.php");
$idLogUsuario = $_GET ['idLogUsuario'];
$logUsuario = new LogUsuario($idLogUsuario);
$logUsuario -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Log Usuario</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Action</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getAction()) ?></td>
		</tr>
		<tr>
			<th>Information</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getInformation()) ?></td>
		</tr>
		<tr>
			<th>Date</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getDate()) ?></td>
		</tr>
		<tr>
			<th>Time</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getTime()) ?></td>
		</tr>
		<tr>
			<th>Ip</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getIp()) ?></td>
		</tr>
		<tr>
			<th>Os</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getOs()) ?></td>
		</tr>
		<tr>
			<th>Browser</th>
			<td><?php echo str_replace(";; ", "<br>", $logUsuario -> getBrowser()) ?></td>
		</tr>
	</table>
</div>
