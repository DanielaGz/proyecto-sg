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
			<th nowrap>Detalle</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$dashboard = new Dashboard();
		$dashboards = $dashboard -> search($_GET['search']);
		$counter = 1;
		foreach ($dashboards as $currentDashboard) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDashboard -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDashboard -> getDetalle()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/dashboard/updateDashboard.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Tablero' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/dashboard/selectAllDashboard.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro: " . $currentDashboard -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Dashboard' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/grafica/selectAllGraficaByDashboard.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Consultar Gráficas' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/grafica/insertGrafica.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Crear Gráfica' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
