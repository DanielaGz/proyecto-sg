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
			<th>Resultado Aprendizaje</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$estrategia = new Estrategia();
		$estrategias = $estrategia -> search($_GET['search']);
		$counter = 1;
		foreach ($estrategias as $currentEstrategia) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEstrategia -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEstrategia -> getDetalle()) . "</td>";
			echo "<td>" . $currentEstrategia -> getResultadoAprendizaje() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategia/updateEstrategia.php") . "&idEstrategia=" . $currentEstrategia -> getIdEstrategia() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Estrategia' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategia/selectAllEstrategia.php") . "&idEstrategia=" . $currentEstrategia -> getIdEstrategia() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro: " . $currentEstrategia -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Estrategia' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/insertEstrategiaCriterio.php") . "&idEstrategia=" . $currentEstrategia -> getIdEstrategia() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Crear Estrategia Criterio' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
