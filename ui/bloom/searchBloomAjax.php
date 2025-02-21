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
		$bloom = new Bloom();
		$blooms = $bloom -> search($_GET['search']);
		$counter = 1;
		foreach ($blooms as $currentBloom) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentBloom -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentBloom -> getDetalle()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/bloom/updateBloom.php") . "&idBloom=" . $currentBloom -> getIdBloom() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Bloom' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/bloom/selectAllBloom.php") . "&idBloom=" . $currentBloom -> getIdBloom() . "&action=delete' onclick='return confirm(\"Desea eliminar bloom: " . $currentBloom -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Bloom' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
