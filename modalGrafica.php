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
$idGrafica = $_GET ['idGrafica'];
$grafica = new Grafica($idGrafica);
$grafica -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Grafica</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $grafica -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Detalle</th>
			<td><?php echo $grafica -> getDetalle() ?></td>
		</tr>
		<tr>
			<th>Config</th>
			<td><?php echo $grafica -> getConfig() ?></td>
		</tr>
		<tr>
			<th>Fila</th>
			<td><?php echo $grafica -> getFila() ?></td>
		</tr>
		<tr>
			<th>Posicion</th>
			<td><?php echo $grafica -> getPosicion() ?></td>
		</tr>
		<tr>
			<th>Tam</th>
			<td><?php echo $grafica -> getTam() ?></td>
		</tr>
		<tr>
			<th>Dashboard</th>
			<td><?php echo $grafica -> getDashboard() -> getNombre() ?></td>
		</tr>
	</table>
</div>
