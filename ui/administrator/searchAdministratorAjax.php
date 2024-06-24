<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Name</th>
			<th nowrap>Last Name</th>
			<th nowrap>Email</th>
			<th nowrap>Phone</th>
			<th nowrap>Mobile</th>
			<th nowrap>State</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$administrator = new Administrator();
		$administrators = $administrator -> search($_GET['search']);
		$counter = 1;
		foreach ($administrators as $currentAdministrator) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrator -> getName()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrator -> getLastName()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrator -> getEmail()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrator -> getPhone()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrator -> getMobile()) . "</td>";
						echo "<td>" . ($currentAdministrator -> getState()==1?"Enabled":"Disabled") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalAdministrator.php?idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "'  data-toggle='modal' data-target='#modalAdministrator' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' data-original-title='View more information' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/administrator/updateAdministrator.php") . "&idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' data-original-title='Edit Administrator' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/administrator/updatePictureAdministrator.php") . "&idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "&attribute=picture'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' data-original-title='Edit picture'></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
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
