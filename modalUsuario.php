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
$idUsuario = $_GET ['idUsuario'];
$usuario = new Usuario($idUsuario);
$usuario -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Usuario</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Name</th>
			<td><?php echo $usuario -> getName() ?></td>
		</tr>
		<tr>
			<th>Last Name</th>
			<td><?php echo $usuario -> getLastName() ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $usuario -> getEmail() ?></td>
		</tr>
		<tr>
			<th>Picture</th>
				<td><img class="rounded" src="<?php echo $usuario -> getPicture() ?>" height="300px" /></td>
		</tr>
		<tr>
			<th>Phone</th>
			<td><?php echo $usuario -> getPhone() ?></td>
		</tr>
		<tr>
			<th>Mobile</th>
			<td><?php echo $usuario -> getMobile() ?></td>
		</tr>
		<tr>
			<th>State</th>
			<td><?php echo ($usuario -> getState()==1?"Enabled":"Disabled") ?> </td>
		</tr>
	</table>
</div>
