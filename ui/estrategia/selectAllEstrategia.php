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
	$deleteEstrategia = new Estrategia($_GET['idEstrategia']);
	$deleteEstrategia -> select();
	if($deleteEstrategia -> delete()){
		$nameResultadoAprendizaje = $deleteEstrategia -> getResultadoAprendizaje() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Eliminar Estrategia", "Nombre: " . $deleteEstrategia -> getNombre() . ";; Detalle: " . $deleteEstrategia -> getDetalle() . ";; Resultado Aprendizaje: " . $nameResultadoAprendizaje, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Eliminar Estrategia", "Nombre: " . $deleteEstrategia -> getNombre() . ";; Detalle: " . $deleteEstrategia -> getDetalle() . ";; Resultado Aprendizaje: " . $nameResultadoAprendizaje, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
		<h3 class="card-title">Estrategias</h3>
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >Registro eliminado
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
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/estrategia/selectAllEstrategia.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/estrategia/selectAllEstrategia.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Detalle 
						<?php if($order=="detalle" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/estrategia/selectAllEstrategia.php") ?>&order=detalle&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="detalle" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/estrategia/selectAllEstrategia.php") ?>&order=detalle&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th>Resultado Aprendizaje</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$estrategia = new Estrategia();
					if($order != "" && $dir != "") {
						$estrategias = $estrategia -> selectAllOrder($order, $dir);
					} else {
						$estrategias = $estrategia -> selectAll();
					}
					$counter = 1;
					foreach ($estrategias as $currentEstrategia) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentEstrategia -> getNombre() . "</td>";
						echo "<td>" . $currentEstrategia -> getDetalle() . "</td>";
						echo "<td><a href='modalResultadoAprendizaje.php?idResultadoAprendizaje=" . $currentEstrategia -> getResultadoAprendizaje() -> getIdResultadoAprendizaje() . "' data-toggle='modal' data-target='#modalEstrategia' >" . $currentEstrategia -> getResultadoAprendizaje() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategia/updateEstrategia.php") . "&idEstrategia=" . $currentEstrategia -> getIdEstrategia() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Estrategia' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/estrategia/selectAllEstrategia.php") . "&idEstrategia=" . $currentEstrategia -> getIdEstrategia() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro: " . $currentEstrategia -> getNombre() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Estrategia' ></span></a> ";
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
<div class="modal fade" id="modalEstrategia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
