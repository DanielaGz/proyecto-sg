<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$usuario = new Usuario($_GET['idUsuario']); 
$usuario -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteUsuarioDashboard = new Dashboard($_GET['idUsuarioDashboard']);
	$deleteUsuarioDashboard -> select();
	if($deleteUsuarioDashboard -> delete()){
		$nameUsuario = $deleteUsuarioDashboard -> getUsuario() -> getName() . " " . $deleteUsuarioDashboard -> getUsuario() -> getLastName();
		$nameDashboard = $deleteUsuarioDashboard -> getDashboard() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Eimina tablero", "Usuario: " . $nameUsuario . ";; Dashboard: " . $nameDashboard, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Eimina tablero", "Usuario: " . $nameUsuario . ";; Dashboard: " . $nameDashboard, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar tableros del usuario: <em><?php echo $usuario -> getName() . " " . $usuario -> getLastName() ?></em></h4>
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
						<th>Usuario</th>
						<th>Dashboard</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$usuarioDashboard = new Dashboard("","","", $_GET['idUsuario'], "");
					$usuarioDashboards = $usuarioDashboard -> selectAllByUsuario();
					$counter = 1;
					foreach ($usuarioDashboards as $currentUsuarioDashboard) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td><a href='modalUsuario.php?idUsuario=" . $currentUsuarioDashboard -> getUsuario() -> getIdUsuario() . "' data-toggle='modal' data-target='#modalUsuarioDashboard' >" . $currentUsuarioDashboard -> getUsuario() -> getName() . " " . $currentUsuarioDashboard -> getUsuario() -> getLastName() . "</a></td>";
						echo "<td><a href='modalDashboard.php?idDashboard=" . $currentUsuarioDashboard -> getIdDashboard() . "' data-toggle='modal' data-target='#modalUsuarioDashboard' >" . $currentUsuarioDashboard -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuarioDashboard/updateUsuarioDashboard.php") . "&idUsuarioDashboard=" . $currentUsuarioDashboard -> getUsuario() -> getIdUsuario() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar tablero' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuarioDashboard/selectAllUsuarioDashboardByUsuario.php") . "&idUsuario=" . $_GET['idUsuario'] . "&idUsuarioDashboard=" . $currentUsuarioDashboard -> getIdDashboard() . "&action=delete' onclick='return confirm(\"Desea eliminar el tablero?\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar tablero' ></span></a> ";
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
<div class="modal fade" id="modalUsuarioDashboard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
