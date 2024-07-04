<?php 
$id = $_GET['id'];
$dashboard = new Dashboard($id);
$dashboard -> select();
$grafica = new Grafica( "", "","", "", "", "", "", $id);
$graficas = $grafica -> selectAllByDashboardOrder('posicion','asc');

$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
$nivelBar = "[";
$pie = "[";
foreach ($categoriaRas as $currentCategoriaRa) {
    $resultadoAp = new resultadoAprendizaje("","","","",$currentCategoriaRa -> getIdCategoriaRa());
	$resultadoAps = $resultadoAp -> selectAllByCategoriaRa();
    $countRa += count($resultadoAps);
    $pie .= '{"name": "'.$currentCategoriaRa -> getNombre().'","y": '.count($resultadoAps)."},";
    $nivelBar .='["'.$currentCategoriaRa -> getNombre().'", '.count($resultadoAps).'],';
}
$pie .= "]";
$nivelBar .= "]";
?>
<div class="container">
<div class="card round mt-3">
    <div class="d-flex justify-content-end bd-highlight">
        <a class="btn btn-info round m-2 round " href='modalAddGrafica.php?id=<?php echo $id;?>' data-toggle='modal' data-target='#modalAddGra' role="button">
            Agregar gráfico
            <span class='fas fa-plus'></span>
        </a>
        <button type="button" id="move" class="btn btn-info m-2 round">
            <span id="save-button">Editar</span>
            <span class="fas fa-pen" aria-hidden="true"></span>
        </button>
        <button type="button" id="pdf" class="btn btn-info m-2 round">
            Descargar
            <span class="fas fa-file-pdf" aria-hidden="true"></span>
        </button>
    </div>
</div>
</div>


<div class="container mt-3" id="pdf-document" style="background-color: #e9ecef;">
<h3>
    <?php echo $dashboard -> getNombre() ?>
</h3>
<p>
    <?php echo $dashboard -> getDetalle() ?>
</p>
<div class="row grid" id="demoGrid">
    <?php 
    foreach($graficas as $currentGrafica){
        ?>
        <div class="col-lg-<?php echo $currentGrafica -> getTam();?> col-md-12 col-sm-12 p-3 not-draggable" id="<?php echo $currentGrafica -> getIdGrafica();?>">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
            <div class="card-body text-center">
                <div class="justify-content-end tools d-none">
                    <button type="button" onclick="updateGraph(<?php echo $currentGrafica -> getIdGrafica();?>, '-');" class="btn btn-info round mr-1" data-toggle="tooltip" data-placement="bottom" title="Disminuir tamaño">
                        <span class='fas fa-minus'></span>
                    </button>
                    <button type="button" onclick="updateGraph(<?php echo $currentGrafica -> getIdGrafica();?>, '+');" class="btn btn-info round mr-1" data-toggle="tooltip" data-placement="bottom" title="Aumentar tamaño">
                        <span class='fas fa-plus'></span>
                    </button>
                    <button type="button" onclick="del(<?php echo $currentGrafica -> getIdGrafica();?>);" class="btn btn-danger round" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                        <span class='fas fa-trash'></span>
                    </button>
                </div>
                <div id ="<?php echo $currentGrafica -> getConfig()?>"></div>
            </div>
        </div>
        </div>
        <?php
    }
    ?>
</div>
</div>


<div class="modal fade" id="modalAddGra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content round" id="modalContent">
		</div>
	</div>
</div>

<script>
nivelBar = <?php echo ($nivelBar); ?>;
pie = <?php echo ($pie); ?>;

$(document).ready(function(){

let data = {};

$('body').on('show.bs.modal', '.modal', function (e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});

var sortable = Sortable.create(demoGrid, {
    animation: 150,
    group: 'grid-items',
    draggable: '.grid-item',
    handle: '.grid-item',
    sort: true,
    chosenClass: 'active'
});

$('#move').on('click', function() {
    var $gridItems = $('#demoGrid').find('.col-lg-3, .col-lg-6, .col-lg-9, .col-lg-12');
    if($gridItems.length === 0){
        $("#save-button").text('Editar');
        $("#pdf").removeAttr('disabled');
        return;
    }
    if ($gridItems.hasClass('grid-item')) {
        $("#save-button").text('Editar');
        $("#pdf").removeAttr('disabled');
        $('.tools').removeClass('d-flex');
        $('.tools').addClass('d-none');
        $gridItems.removeClass('tilt');
        $gridItems.removeClass('grid-item').addClass('not-draggable');
        let count = 1;
        $gridItems.each(function() {
            var id = $(this).attr('id');
            savePositions(id, count);
            count++;
        });
    } else {
        $("#save-button").text('Guardar');
        $("#pdf").attr('disabled', 'disabled');
        $('.tools').removeClass('d-none');
        $('.tools').addClass('d-flex');
        $gridItems.addClass('tilt');
        $gridItems.removeClass('not-draggable').addClass('grid-item');
    }
    sortable.option("draggable", ".grid-item");
});

function savePositions(id, posicion){
    $.ajax({
        url: 'updateGraficaService.php?id='+id+'&update=true',
        type: 'POST',
        data: {
            'posicion': posicion,
            'update': true
        },
        success: function(response) {
            console.log('ci')
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown, jqXHR);
        }
    });
}

if ($("#generalbar").length) {
    Highcharts.chart('generalbar',
        createChart(
            "Cantidad de RA por categoría", 
            "column", 
            nivelBar, 
            "Cantidad RA", 
            "Cantidad RA")
    );
}

if ($("#generalpie").length) {
    Highcharts.chart('generalpie',
        createChart(
            "Porcentaje RA por categoría", 
            "pie", 
            pie)
    );
}


});

document.getElementById('pdf').addEventListener('click', function() {
    generatePDF('pdf-document');
});

</script>