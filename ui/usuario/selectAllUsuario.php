<?php
$order = "lastName";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "asc";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete"){
	$deleteUsuario = new Usuario($_GET['idUsuario']);
	$deleteUsuario -> select();
	if($deleteUsuario -> delete()){
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
			$logAdministrator = new LogAdministrator("","Eliminar Usuario", "Name: " . $deleteUsuario -> getName() . ";; Last Name: " . $deleteUsuario -> getLastName() . ";; Email: " . $deleteUsuario -> getEmail() . ";; Password: " . $deleteUsuario -> getPassword() . ";; Phone: " . $deleteUsuario -> getPhone() . ";; Mobile: " . $deleteUsuario -> getMobile() . ";; State: " . $deleteUsuario -> getState(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Eliminar Usuario", "Name: " . $deleteUsuario -> getName() . ";; Last Name: " . $deleteUsuario -> getLastName() . ";; Email: " . $deleteUsuario -> getEmail() . ";; Password: " . $deleteUsuario -> getPassword() . ";; Phone: " . $deleteUsuario -> getPhone() . ";; Mobile: " . $deleteUsuario -> getMobile() . ";; State: " . $deleteUsuario -> getState(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar Usuario</h4>
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
						<th nowrap>Nombre 
						<?php if($order=="name" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=name&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="name" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=name&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if($order=="lastName" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=lastName&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="lastName" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=lastName&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if($order=="email" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=email&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="email" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=email&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Teléfono 
						<?php if($order=="phone" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=phone&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="phone" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=phone&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Celular 
						<?php if($order=="mobile" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=mobile&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="mobile" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=mobile&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Estado 
						<?php if($order=="state" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=state&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="state" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>&order=state&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$usuario = new Usuario();
					if($order != "" && $dir != "") {
						$usuarios = $usuario -> selectAllOrder($order, $dir);
					} else {
						$usuarios = $usuario -> selectAll();
					}
					$counter = 1;
					foreach ($usuarios as $currentUsuario) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentUsuario -> getName() . "</td>";
						echo "<td>" . $currentUsuario -> getLastName() . "</td>";
						echo "<td>" . $currentUsuario -> getEmail() . "</td>";
						echo "<td>" . $currentUsuario -> getPhone() . "</td>";
						echo "<td>" . $currentUsuario -> getMobile() . "</td>";
						echo "<td>" . ($currentUsuario -> getState()==1?"Enabled":"Disabled") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalUsuario.php?idUsuario=" . $currentUsuario -> getIdUsuario() . "'  data-toggle='modal' data-target='#modalUsuario' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' data-original-title='Ver más información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuario/updateUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Usuario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/usuario/updatePictureUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "&attribute=picture'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' data-original-title='Editar foto'></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/usuario/selectAllUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "&action=delete' onclick='return confirm(\"Confirm to delete Usuario: " . $currentUsuario -> getName() . " " . $currentUsuario -> getLastName() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' data-original-title='Eliminar Usuario' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/usuarioDashboard/selectAllUsuarioDashboardByUsuario.php") . "&idUsuario=" . $currentUsuario -> getIdUsuario() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' data-original-title='Consultar tableros del usuario' ></span></a> ";
						
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
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
