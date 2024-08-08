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
		$criterio = new Criterio();
		$criterios = $criterio -> search($_GET['search']);
		$counter = 1;
		foreach ($criterios as $currentCriterio) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCriterio -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCriterio -> getDetalle()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/criterio/updateCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Criterio' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/criterio/selectAllCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "&action=delete' onclick='return confirm(\"Confirm to delete Criterio: " . $currentCriterio -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Criterio' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Obtener Calificaciones' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/insertCalificacion.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Crear Calificación' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/selectAllEstrategiaCriterioByCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Obtener Estrategia Criterio' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/insertEstrategiaCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Crear Estrategia Criterio' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
