<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$criterio = new Criterio($_GET['idCriterio']); 
$criterio -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteCalificacion = new Calificacion($_GET['idCalificacion']);
	$deleteCalificacion -> select();
	if($deleteCalificacion -> delete()){
		$nameCriterio = $deleteCalificacion -> getCriterio() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Eliminar Calificacion", "Nivel: " . $deleteCalificacion -> getNivel() . ";; Detalle: " . $deleteCalificacion -> getDetalle() . ";; Criterio: " . $nameCriterio, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Eliminar Calificacion", "Nivel: " . $deleteCalificacion -> getNivel() . ";; Detalle: " . $deleteCalificacion -> getDetalle() . ";; Criterio: " . $nameCriterio, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logUsuario -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container">
	<div class="card round">
		<div class="card-body">
		<h3 class="card-title">Calificación por criterio: <em><?php echo $criterio -> getNombre() ?></em></h3>
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >Registro eliminado.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >Error.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nivel 
						<?php if($order=="nivel" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' href='index.php?pid=<?php echo base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") ?>&idCriterio=<?php echo $_GET['idCriterio'] ?>&order=nivel&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nivel" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' href='index.php?pid=<?php echo base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") ?>&idCriterio=<?php echo $_GET['idCriterio'] ?>&order=nivel&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Detalle 
						<?php if($order=="detalle" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' href='index.php?pid=<?php echo base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") ?>&idCriterio=<?php echo $_GET['idCriterio'] ?>&order=detalle&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="detalle" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' href='index.php?pid=<?php echo base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") ?>&idCriterio=<?php echo $_GET['idCriterio'] ?>&order=detalle&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Criterio</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$calificacion = new Calificacion("", "", "", $_GET['idCriterio']);
					if($order!="" && $dir!="") {
						$calificacions = $calificacion -> selectAllByCriterioOrder($order, $dir);
					} else {
						$calificacions = $calificacion -> selectAllByCriterio();
					}
					$counter = 1;
					foreach ($calificacions as $currentCalificacion) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCalificacion -> getNivel() . "</td>";
						echo "<td>" . $currentCalificacion -> getDetalle() . "</td>";
						echo "<td><a href='modalCriterio.php?idCriterio=" . $currentCalificacion -> getCriterio() -> getIdCriterio() . "' data-toggle='modal' data-target='#modalCalificacion' >" . $currentCalificacion -> getCriterio() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/updateCalificacion.php") . "&idCalificacion=" . $currentCalificacion -> getIdCalificacion() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Calificación' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/calificacion/selectAllCalificacionByCriterio.php") . "&idCriterio=" . $_GET['idCriterio'] . "&idCalificacion=" . $currentCalificacion -> getIdCalificacion() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro: " . $currentCalificacion -> getNivel() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Calificación' ></span></a> ";
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
<div class="modal fade" id="modalCalificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content round" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
