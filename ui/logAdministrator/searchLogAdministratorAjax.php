<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Action</th>
			<th nowrap>Date</th>
			<th nowrap>Time</th>
			<th nowrap>Ip</th>
			<th nowrap>Os</th>
			<th nowrap>Browser</th>
			<th>Administrator</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$logAdministrator = new LogAdministrator();
		$logAdministrators = $logAdministrator -> search($_GET['search']);
		$counter = 1;
		foreach ($logAdministrators as $currentLogAdministrator) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getAction()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getDate()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getTime()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getIp()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getOs()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getBrowser()) . "</td>";
			echo "<td>" . $currentLogAdministrator -> getAdministrator() -> getName() . " " . $currentLogAdministrator -> getAdministrator() -> getLastName() . "</td>";
			echo "<td class='text-right' nowrap>
				<a href='modalLogAdministrator.php?idLogAdministrator=" . $currentLogAdministrator -> getIdLogAdministrator() . "'  data-toggle='modal' data-target='#modalLogAdministrator' >
					<span class='fas fa-eye' data-toggle='tooltip' data-placement='left' data-original-title='Ver más información' ></span>
				</a>
				</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalLogAdministrator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
