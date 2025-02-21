<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$resultadoAprendizaje = new ResultadoAprendizaje($_GET['idResultadoAprendizaje']); 
$resultadoAprendizaje -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteBloom = new Bloom($_GET['idBloom']);
	$deleteBloom -> select();
	if($deleteBloom -> delete()){
		$nameResultadoAprendizaje = $deleteBloom -> getResultadoAprendizaje() -> getNombre();
		$user_ip = getenv('REMOTE_ADDR');
		$agent = $_SERVER["HTTP_USER_AGENT"];
		$browser = "-";
		if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
			$browser = "Internet Explorer";
		} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Chrome";
		} else if (preg_match('/Edge\/\d+/', $agent) ) {
			$browser = "Edge";
		} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Firefox";
		} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Opera";
		} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Safari";
		}
		if($_SESSION['entity'] == 'Administrator'){
			$logAdministrator = new LogAdministrator("","Delete Bloom", "Nombre: " . $deleteBloom -> getNombre() . ";; Detalle: " . $deleteBloom -> getDetalle() . ";; Resultado Aprendizaje: " . $nameResultadoAprendizaje, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Delete Bloom", "Nombre: " . $deleteBloom -> getNombre() . ";; Detalle: " . $deleteBloom -> getDetalle() . ";; Resultado Aprendizaje: " . $nameResultadoAprendizaje, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logUsuario -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Bloom of Resultado Aprendizaje: <em><?php echo $resultadoAprendizaje -> getNombre() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/bloom/selectAllBloomByResultadoAprendizaje.php") ?>&idResultadoAprendizaje=<?php echo $_GET['idResultadoAprendizaje'] ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/bloom/selectAllBloomByResultadoAprendizaje.php") ?>&idResultadoAprendizaje=<?php echo $_GET['idResultadoAprendizaje'] ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Detalle 
						<?php if($order=="detalle" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/bloom/selectAllBloomByResultadoAprendizaje.php") ?>&idResultadoAprendizaje=<?php echo $_GET['idResultadoAprendizaje'] ?>&order=detalle&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="detalle" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/bloom/selectAllBloomByResultadoAprendizaje.php") ?>&idResultadoAprendizaje=<?php echo $_GET['idResultadoAprendizaje'] ?>&order=detalle&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Resultado Aprendizaje</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$bloom = new Bloom("", "", "", $_GET['idResultadoAprendizaje']);
					if($order!="" && $dir!="") {
						$blooms = $bloom -> selectAllByResultadoAprendizajeOrder($order, $dir);
					} else {
						$blooms = $bloom -> selectAllByResultadoAprendizaje();
					}
					$counter = 1;
					foreach ($blooms as $currentBloom) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentBloom -> getNombre() . "</td>";
						echo "<td>" . $currentBloom -> getDetalle() . "</td>";
						echo "<td><a href='modalResultadoAprendizaje.php?idResultadoAprendizaje=" . $currentBloom -> getResultadoAprendizaje() -> getIdResultadoAprendizaje() . "' data-toggle='modal' data-target='#modalBloom' >" . $currentBloom -> getResultadoAprendizaje() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/bloom/updateBloom.php") . "&idBloom=" . $currentBloom -> getIdBloom() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Bloom' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/bloom/selectAllBloomByResultadoAprendizaje.php") . "&idResultadoAprendizaje=" . $_GET['idResultadoAprendizaje'] . "&idBloom=" . $currentBloom -> getIdBloom() . "&action=delete' onclick='return confirm(\"Confirma eliminación de Bloom: " . $currentBloom -> getNombre() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Bloom' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalBloom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
