<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Acción</th>
			<th nowrap>Fecha</th>
			<th nowrap>Hora</th>
			<th nowrap>Ip</th>
			<th nowrap>Os</th>
			<th nowrap>Navegador</th>
			<th>Usuario</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$logUsuario = new LogUsuario();
		$logUsuarios = $logUsuario -> search($_GET['search']);
		$counter = 1;
		foreach ($logUsuarios as $currentLogUsuario) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogUsuario -> getAction()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogUsuario -> getDate()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogUsuario -> getTime()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogUsuario -> getIp()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogUsuario -> getOs()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogUsuario -> getBrowser()) . "</td>";
			echo "<td>" . $currentLogUsuario -> getUsuario() -> getName() . " " . $currentLogUsuario -> getUsuario() -> getLastName() . "</td>";
			echo "<td class='text-right' nowrap>
				<a href='modalLogUsuario.php?idLogUsuario=" . $currentLogUsuario -> getIdLogUsuario() . "'  data-toggle='modal' data-target='#modalLogUsuario' >
					<span class='fas fa-eye' data-toggle='tooltip' data-placement='left' data-original-title='Ver más información' ></span>
				</a>
				</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalLogUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
