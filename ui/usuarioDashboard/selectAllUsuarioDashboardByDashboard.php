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
	$deleteUsuarioDashboard = new UsuarioDashboard($_GET['idUsuarioDashboard']);
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
			$logAdministrator = new LogAdministrator("","Delete Usuario Dashboard", "Usuario: " . $nameUsuario . ";; Dashboard: " . $nameDashboard, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Delete Usuario Dashboard", "Usuario: " . $nameUsuario . ";; Dashboard: " . $nameDashboard, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get All Usuario Dashboard of Dashboard: <em><?php echo $dashboard -> getNombre() ?></em></h4>
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
					$usuarioDashboard = new UsuarioDashboard("", "", $_GET['idDashboard']);
					if($order!="" && $dir!="") {
						$usuarioDashboards = $usuarioDashboard -> selectAllByDashboardOrder($order, $dir);
					} else {
						$usuarioDashboards = $usuarioDashboard -> selectAllByDashboard();
					}
					$counter = 1;
					foreach ($usuarioDashboards as $currentUsuarioDashboard) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td><a href='modalUsuario.php?idUsuario=" . $currentUsuarioDashboard -> getUsuario() -> getIdUsuario() . "' data-toggle='modal' data-target='#modalUsuarioDashboard' >" . $currentUsuarioDashboard -> getUsuario() -> getName() . " " . $currentUsuarioDashboard -> getUsuario() -> getLastName() . "</a></td>";
						echo "<td><a href='modalDashboard.php?idDashboard=" . $currentUsuarioDashboard -> getDashboard() -> getIdDashboard() . "' data-toggle='modal' data-target='#modalUsuarioDashboard' >" . $currentUsuarioDashboard -> getDashboard() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuarioDashboard/updateUsuarioDashboard.php") . "&idUsuarioDashboard=" . $currentUsuarioDashboard -> getIdUsuarioDashboard() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Usuario Dashboard' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuarioDashboard/selectAllUsuarioDashboardByDashboard.php") . "&idDashboard=" . $_GET['idDashboard'] . "&idUsuarioDashboard=" . $currentUsuarioDashboard -> getIdUsuarioDashboard() . "&action=delete' onclick='return confirm(\"Confirma eliminación de Usuario Dashboard\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Delete Usuario Dashboard' ></span></a> ";
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
