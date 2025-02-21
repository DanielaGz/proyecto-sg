<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$estrategia = new Estrategia($_GET['idEstrategia']); 
$estrategia -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteEstrategiaCriterio = new EstrategiaCriterio($_GET['idEstrategiaCriterio']);
	$deleteEstrategiaCriterio -> select();
	if($deleteEstrategiaCriterio -> delete()){
		$nameEstrategia = $deleteEstrategiaCriterio -> getEstrategia() -> getNombre();
		$nameCriterio = $deleteEstrategiaCriterio -> getCriterio() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Eliminar Estrategia Criterio", "Estrategia: " . $nameEstrategia . ";; Criterio: " . $nameCriterio, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Eliminar Estrategia Criterio", "Estrategia: " . $nameEstrategia . ";; Criterio: " . $nameCriterio, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar criterios por estrategia: <em><?php echo $estrategia -> getNombre() ?></em></h4>
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
				<div class="alert alert-danger" >Error.
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
						<th>Estrategia</th>
						<th>Criterio</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$estrategiaCriterio = new EstrategiaCriterio("", $_GET['idEstrategia'], "");
					if($order!="" && $dir!="") {
						$estrategiaCriterios = $estrategiaCriterio -> selectAllByEstrategiaOrder($order, $dir);
					} else {
						$estrategiaCriterios = $estrategiaCriterio -> selectAllByEstrategia();
					}
					$counter = 1;
					foreach ($estrategiaCriterios as $currentEstrategiaCriterio) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td><a href='modalEstrategia.php?idEstrategia=" . $currentEstrategiaCriterio -> getEstrategia() -> getIdEstrategia() . "' data-toggle='modal' data-target='#modalEstrategiaCriterio' >" . $currentEstrategiaCriterio -> getEstrategia() -> getNombre() . "</a></td>";
						echo "<td><a href='modalCriterio.php?idCriterio=" . $currentEstrategiaCriterio -> getCriterio() -> getIdCriterio() . "' data-toggle='modal' data-target='#modalEstrategiaCriterio' >" . $currentEstrategiaCriterio -> getCriterio() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/updateEstrategiaCriterio.php") . "&idEstrategiaCriterio=" . $currentEstrategiaCriterio -> getIdEstrategiaCriterio() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Estrategia Criterio' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategiaCriterio/selectAllEstrategiaCriterioByEstrategia.php") . "&idEstrategia=" . $_GET['idEstrategia'] . "&idEstrategiaCriterio=" . $currentEstrategiaCriterio -> getIdEstrategiaCriterio() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro? \")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Estrategia Criterio' ></span></a> ";
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
<div class="modal fade" id="modalEstrategiaCriterio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
