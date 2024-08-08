<?php
$order = "lastName";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "asc";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
?>
<div class="container">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Administrador</h4>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if($order=="name" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=name&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="name" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=name&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if($order=="lastName" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=lastName&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="lastName" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=lastName&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if($order=="email" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=email&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="email" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=email&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Teléfono 
						<?php if($order=="phone" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=phone&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="phone" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=phone&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Celular 
						<?php if($order=="mobile" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=mobile&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="mobile" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=mobile&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Estado 
						<?php if($order=="state" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=state&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' data-placement='right' data-original-title='Orden ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="state" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=state&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' data-placement='right' data-original-title='Orden descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$administrator = new Administrator();
					if($order != "" && $dir != "") {
						$administrators = $administrator -> selectAllOrder($order, $dir);
					} else {
						$administrators = $administrator -> selectAll();
					}
					$counter = 1;
					foreach ($administrators as $currentAdministrator) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentAdministrator -> getName() . "</td>";
						echo "<td>" . $currentAdministrator -> getLastName() . "</td>";
						echo "<td>" . $currentAdministrator -> getEmail() . "</td>";
						echo "<td>" . $currentAdministrator -> getPhone() . "</td>";
						echo "<td>" . $currentAdministrator -> getMobile() . "</td>";
						echo "<td>" . ($currentAdministrator -> getState()==1?"Enabled":"Disabled") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalAdministrator.php?idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "'  data-toggle='modal' data-target='#modalAdministrator' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' data-original-title='Ver más información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/administrator/updateAdministrator.php") . "&idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Editar Administrador' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/administrator/updatePictureAdministrator.php") . "&idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "&attribute=picture'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' data-original-title='Editar foto'></span></a> ";
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
<div class="modal fade" id="modalAdministrator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
