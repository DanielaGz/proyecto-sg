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
			<th>Bloom</th>
			<th>Categoria Ra</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$resultadoAprendizaje = new ResultadoAprendizaje();
		$resultadoAprendizajes = $resultadoAprendizaje -> search($_GET['search']);
		$counter = 1;
		foreach ($resultadoAprendizajes as $currentResultadoAprendizaje) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentResultadoAprendizaje -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentResultadoAprendizaje -> getDetalle()) . "</td>";
			echo "<td>" . $currentResultadoAprendizaje -> getBloom() -> getNombre() . "</td>";
			echo "<td>" . $currentResultadoAprendizaje -> getCategoriaRa() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/resultadoAprendizaje/updateResultadoAprendizaje.php") . "&idResultadoAprendizaje=" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Resultado Aprendizaje' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/resultadoAprendizaje/selectAllResultadoAprendizaje.php") . "&idResultadoAprendizaje=" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "&action=delete' onclick='return confirm(\"Confirm to delete Resultado Aprendizaje: " . $currentResultadoAprendizaje -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Resultado Aprendizaje' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/estrategia/selectAllEstrategiaByResultadoAprendizaje.php") . "&idResultadoAprendizaje=" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Get All Estrategia' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategia/insertEstrategia.php") . "&idResultadoAprendizaje=" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Create Estrategia' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
