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
			<th nowrap>Config</th>
			<th nowrap>Fila</th>
			<th nowrap>Posicion</th>
			<th nowrap>Tam</th>
			<th>Dashboard</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$grafica = new Grafica();
		$graficas = $grafica -> search($_GET['search']);
		$counter = 1;
		foreach ($graficas as $currentGrafica) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentGrafica -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentGrafica -> getDetalle()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentGrafica -> getConfig()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentGrafica -> getFila()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentGrafica -> getPosicion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentGrafica -> getTam()) . "</td>";
			echo "<td>" . $currentGrafica -> getDashboard() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/grafica/updateGrafica.php") . "&idGrafica=" . $currentGrafica -> getIdGrafica() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Grafica' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/grafica/selectAllGrafica.php") . "&idGrafica=" . $currentGrafica -> getIdGrafica() . "&action=delete' onclick='return confirm(\"Confirm to delete Grafica: " . $currentGrafica -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Grafica' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
