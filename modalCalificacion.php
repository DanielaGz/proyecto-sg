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
$idCalificacion = $_GET ['idCalificacion'];
$calificacion = new Calificacion($idCalificacion);
$calificacion -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Calificacion</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nivel</th>
			<td><?php echo $calificacion -> getNivel() ?></td>
		</tr>
		<tr>
			<th>Detalle</th>
			<td><?php echo $calificacion -> getDetalle() ?></td>
		</tr>
		<tr>
			<th>Criterio</th>
			<td><?php echo $calificacion -> getCriterio() -> getNombre() ?></td>
		</tr>
	</table>
</div>
