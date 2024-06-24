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
$idResultadoAprendizaje = $_GET ['idResultadoAprendizaje'];
$resultadoAprendizaje = new ResultadoAprendizaje($idResultadoAprendizaje);
$resultadoAprendizaje -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Resultado Aprendizaje</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $resultadoAprendizaje -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Detalle</th>
			<td><?php echo $resultadoAprendizaje -> getDetalle() ?></td>
		</tr>
		<tr>
			<th>Bloom</th>
			<td><?php echo $resultadoAprendizaje -> getBloom() -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Categoria Ra</th>
			<td><?php echo $resultadoAprendizaje -> getCategoriaRa() -> getNombre() ?></td>
		</tr>
	</table>
</div>
