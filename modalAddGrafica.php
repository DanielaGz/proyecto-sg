<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/LogUsuario.php");
require("business/Usuario.php");
require("business/UsuarioDashboard.php");
require("business/Dashboard.php");
require("business/Grafica.php");
require("business/CategoriaRa.php");
require("business/Bloom.php");
require("business/ResultadoAprendizaje.php");
require("business/Estrategia.php");
require("business/EstrategiaCriterio.php");
require("business/Criterio.php");
require("business/Calificacion.php");
require_once("persistence/Connection.php");
$id = $_GET['id'];

$grafica = new Grafica( "", "","", "", "", "", "", $id);
$graficas = $grafica -> selectAllByDashboardOrder('posicion','asc');

$array_added = [];

foreach ($graficas as $currentGrafica) {
    array_push($array_added, $currentGrafica -> getConfig());
}

?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Agregar gráfica</h4>
	<button type="button" id="close" class="close m-1" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
    Gráficas disponibles:
    <div id="no" class="text-center d-none">
        <h3>
            No tienes graficas disponibles
        </h3>
    </div>
    <div class=" overflow-auto" style="height: 700px;" id="grapichs">
    </div>
</div>
<script>
added = <?php echo json_encode($array_added); ?>;

for (let [key, value] of Object.entries(typeCharts)) {
    if(!added.includes(key)){
        /* $("#grapichs").append('<div class="card round m-1"><div id="'+value.config+'"></div><div class="d-flex justify-content-end m-1"><button type="button" class="btn btn-info round mr-1" data-toggle="tooltip" data-placement="bottom" title="Agregar" onclick="Agregar('+"'"+value.config+"'"+')">Seleccionar <span class="fas fa-plus"></span></button></div></div>'); */
        $("#grapichs").append('<div class="card round m-1"><div id="'+value.config+'"></div><div class="d-flex justify-content-end m-1"><button type="button" class="btn btn-info round mr-1" data-toggle="tooltip" data-placement="bottom" title="Agregar" onclick="Agregar('+"'"+value.config+"'"+')">Seleccionar <span class="fas fa-plus"></span></button></div></div>');
    }
}

if(Object.entries(typeCharts).length === added.length){
    $("#no").removeClass('d-none');
}

function Agregar(cat){
    $.ajax({
        url: 'updateGraficaService.php?id=<?php echo $id; ?>',
        type: 'POST',
        data: {
            ...typeCharts[cat],
            create: true
        },
        success: function(response) {
            $("#close").click();
            console.log(response)
            change = true;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
}

</script>
<script type="text/javascript" src="core/config/customCreate.js"></script>