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
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$categoriaRa = new CategoriaRa();
		$categoriaRas = $categoriaRa -> search($_GET['search']);
		$counter = 1;
		foreach ($categoriaRas as $currentCategoriaRa) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCategoriaRa -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/categoriaRa/updateCategoriaRa.php") . "&idCategoriaRa=" . $currentCategoriaRa -> getIdCategoriaRa() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Categoria Ra' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/categoriaRa/selectAllCategoriaRa.php") . "&idCategoriaRa=" . $currentCategoriaRa -> getIdCategoriaRa() . "&action=delete' onclick='return confirm(\"Confirm to delete Categoria Ra: " . $currentCategoriaRa -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Categoria Ra' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/resultadoAprendizaje/selectAllResultadoAprendizajeByCategoriaRa.php") . "&idCategoriaRa=" . $currentCategoriaRa -> getIdCategoriaRa() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Get All Resultado Aprendizaje' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/resultadoAprendizaje/insertResultadoAprendizaje.php") . "&idCategoriaRa=" . $currentCategoriaRa -> getIdCategoriaRa() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Create Resultado Aprendizaje' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
