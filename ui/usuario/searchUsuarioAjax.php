<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nombre</th>
			<th nowrap>Apellido</th>
			<th nowrap>Correo</th>
			<th nowrap>Teléfono</th>
			<th nowrap>Celular</th>
			<th nowrap>Estado</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$usuario = new Usuario();
		$usuarios = $usuario -> search($_GET['search']);
		$counter = 1;
		foreach ($usuarios as $currentUsuario) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentUsuario -> getName()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentUsuario -> getLastName()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentUsuario -> getEmail()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentUsuario -> getPhone()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentUsuario -> getMobile()) . "</td>";
						echo "<td>" . ($currentUsuario -> getState()==1?"Enabled":"Disabled") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalUsuario.php?idUsuario=" . $currentUsuario -> getIdUsuario() . "'  data-toggle='modal' data-target='#modalUsuario' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' data-original-title='Ver más información' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuario/updateUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Usuario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/usuario/updatePictureUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "&attribute=picture'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' data-original-title='Editar foto'></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuario/selectAllUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro: " . $currentUsuario -> getName() . " " . $currentUsuario -> getLastName() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Usuario' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
