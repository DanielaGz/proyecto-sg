<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nivel</th>
			<th nowrap>Detalle</th>
			<th>Criterio</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$calificacion = new Calificacion();
		$calificacions = $calificacion -> search($_GET['search']);
		$counter = 1;
		foreach ($calificacions as $currentCalificacion) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCalificacion -> getNivel()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCalificacion -> getDetalle()) . "</td>";
			echo "<td>" . $currentCalificacion -> getCriterio() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/updateCalificacion.php") . "&idCalificacion=" . $currentCalificacion -> getIdCalificacion() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Calificación' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/selectAllCalificacion.php") . "&idCalificacion=" . $currentCalificacion -> getIdCalificacion() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro: " . $currentCalificacion -> getNivel() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Calificación' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
