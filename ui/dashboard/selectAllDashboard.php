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
	$deleteDashboard = new Dashboard($_GET['idDashboard']);
	$deleteDashboard -> select();
	if($deleteDashboard -> delete()){
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
			$logAdministrator = new LogAdministrator("","Delete Dashboard", "Nombre: " . $deleteDashboard -> getNombre() . ";; Detalle: " . $deleteDashboard -> getDetalle(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Delete Dashboard", "Nombre: " . $deleteDashboard -> getNombre() . ";; Detalle: " . $deleteDashboard -> getDetalle(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logUsuario -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar tableros</h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >Registro eliminado.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >Error, información dependiente.
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
							<a href='index.php?pid=<?php echo base64_encode("ui/dashboard/selectAllDashboard.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/dashboard/selectAllDashboard.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Detalle 
						<?php if($order=="detalle" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/dashboard/selectAllDashboard.php") ?>&order=detalle&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="detalle" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/dashboard/selectAllDashboard.php") ?>&order=detalle&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$dashboard = new Dashboard();
					if($order != "" && $dir != "") {
						$dashboards = $dashboard -> selectAllOrder($order, $dir);
					} else {
						$dashboards = $dashboard -> selectAll();
					}
					$counter = 1;
					foreach ($dashboards as $currentDashboard) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentDashboard -> getNombre() . "</td>";
						echo "<td>" . $currentDashboard -> getDetalle() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/dashboard/updateDashboard.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar tablero' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/dashboard/selectAllDashboard.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "&action=delete' onclick='return confirm(\"Esta seguro de eliminar el registro? " . $currentDashboard -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar tablero' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/grafica/selectAllGraficaByDashboard.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Consultar gráficas' ></span></a> ";
						/* if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/grafica/insertGrafica.php") . "&idDashboard=" . $currentDashboard -> getIdDashboard() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' data-original-title='Crear gráfica' ></span></a> ";
						} */
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
<div class="modal fade" id="modalDashboard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
