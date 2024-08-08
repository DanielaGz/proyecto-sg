<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$dashboard = new Dashboard($_GET['idDashboard']); 
$dashboard -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteGrafica = new Grafica($_GET['idGrafica']);
	$deleteGrafica -> select();
	if($deleteGrafica -> delete()){
		$nameDashboard = $deleteGrafica -> getDashboard() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Eliminar gráfica", "Nombre: " . $deleteGrafica -> getNombre() . ";; Detalle: " . $deleteGrafica -> getDetalle() . ";; Config: " . $deleteGrafica -> getConfig() . ";; Fila: " . $deleteGrafica -> getFila() . ";; Posicion: " . $deleteGrafica -> getPosicion() . ";; Tam: " . $deleteGrafica -> getTam() . ";; Dashboard: " . $nameDashboard, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Eliminar gráfica", "Nombre: " . $deleteGrafica -> getNombre() . ";; Detalle: " . $deleteGrafica -> getDetalle() . ";; Config: " . $deleteGrafica -> getConfig() . ";; Fila: " . $deleteGrafica -> getFila() . ";; Posicion: " . $deleteGrafica -> getPosicion() . ";; Tamaño: " . $deleteGrafica -> getTam() . ";; Dashboard: " . $nameDashboard, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar gráficas del tablero: <em><?php echo $dashboard -> getNombre() ?></em></h4>
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
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Detalle 
						<?php if($order=="detalle" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=detalle&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="detalle" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=detalle&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Config 
						<?php if($order=="config" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=config&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="config" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=config&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Fila 
						<?php if($order=="fila" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=fila&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fila" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=fila&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Posicion 
						<?php if($order=="posicion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=posicion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="posicion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=posicion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Tamaño 
						<?php if($order=="tam" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=tam&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="tam" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' data-placement='right' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGraficaByDashboard.php") ?>&idDashboard=<?php echo $_GET['idDashboard'] ?>&order=tam&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Dashboard</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$grafica = new Grafica("", "", "", "", "", "", "", $_GET['idDashboard']);
					if($order!="" && $dir!="") {
						$graficas = $grafica -> selectAllByDashboardOrder($order, $dir);
					} else {
						$graficas = $grafica -> selectAllByDashboard();
					}
					$counter = 1;
					foreach ($graficas as $currentGrafica) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentGrafica -> getNombre() . "</td>";
						echo "<td>" . $currentGrafica -> getDetalle() . "</td>";
						echo "<td>" . $currentGrafica -> getConfig() . "</td>";
						echo "<td>" . $currentGrafica -> getFila() . "</td>";
						echo "<td>" . $currentGrafica -> getPosicion() . "</td>";
						echo "<td>" . $currentGrafica -> getTam() . "</td>";
						echo "<td><a href='modalDashboard.php?idDashboard=" . $currentGrafica -> getDashboard() -> getIdDashboard() . "' data-toggle='modal' data-target='#modalGrafica' >" . $currentGrafica -> getDashboard() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/grafica/updateGrafica.php") . "&idGrafica=" . $currentGrafica -> getIdGrafica() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar gráfica' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/grafica/selectAllGraficaByDashboard.php") . "&idDashboard=" . $_GET['idDashboard'] . "&idGrafica=" . $currentGrafica -> getIdGrafica() . "&action=delete' onclick='return confirm(\"Está seguro de eliminar el registro? " . $currentGrafica -> getNombre() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar gráfica' ></span></a> ";
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
<div class="modal fade" id="modalGrafica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
