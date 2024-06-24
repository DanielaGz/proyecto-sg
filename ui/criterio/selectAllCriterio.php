<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete"){
	$deleteCriterio = new Criterio($_GET['idCriterio']);
	$deleteCriterio -> select();
	if($deleteCriterio -> delete()){
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
			$logAdministrator = new LogAdministrator("","Delete Criterio", "Nombre: " . $deleteCriterio -> getNombre() . ";; Detalle: " . $deleteCriterio -> getDetalle(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Delete Criterio", "Nombre: " . $deleteCriterio -> getNombre() . ";; Detalle: " . $deleteCriterio -> getDetalle(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get All Criterio</h4>
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
							<a href='index.php?pid=<?php echo base64_encode("ui/criterio/selectAllCriterio.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/criterio/selectAllCriterio.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Detalle 
						<?php if($order=="detalle" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/criterio/selectAllCriterio.php") ?>&order=detalle&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="detalle" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/criterio/selectAllCriterio.php") ?>&order=detalle&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$criterio = new Criterio();
					if($order != "" && $dir != "") {
						$criterios = $criterio -> selectAllOrder($order, $dir);
					} else {
						$criterios = $criterio -> selectAll();
					}
					$counter = 1;
					foreach ($criterios as $currentCriterio) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCriterio -> getNombre() . "</td>";
						echo "<td>" . $currentCriterio -> getDetalle() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/criterio/updateCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Criterio' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/criterio/selectAllCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "&action=delete' onclick='return confirm(\"Confirm to delete Criterio: " . $currentCriterio -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Criterio' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Get All Calificacion' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/insertCalificacion.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Create Calificacion' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/selectAllEstrategiaCriterioByCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Get All Estrategia Criterio' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/insertEstrategiaCriterio.php") . "&idCriterio=" . $currentCriterio -> getIdCriterio() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Create Estrategia Criterio' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalCriterio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
