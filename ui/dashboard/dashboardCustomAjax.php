<?php 
$id = $_GET['id'];
$dashboard = new Dashboard($id);
$dashboard -> select();
$grafica = new Grafica( "", "","", "", "", "", "", $id);
$graficas = $grafica -> selectAllByDashboardOrder('posicion','asc');
$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
$category = $_GET['category'] ? $_GET['category'] : 1;
$_SESSION['category']=$category;
$colors = [
    "#E6999A", // Darkened Light Pink
    "#E6C5A3", // Darkened Peach
    "#E6E699", // Darkened Light Yellow
    "#99E6A3", // Darkened Mint Green
    "#99CCE6", // Darkened Light Blue
    "#A3A8CC", // Darkened Periwinkle
    "#CC9BA6", // Darkened Pink
    "#99CC99", // Darkened Light Green
    "#E69988", // Darkened Soft Red
    "#E6B8A3", // Darkened Light Apricot
    "#C2D1A1", // Darkened Light Lime
    "#9999E6", // Darkened Pale Lilac
    "#B38888", // Darkened Pastel Rose
    "#E6B2A1", // Darkened Light Coral
    "#8CB39A", // Darkened Aqua
    "#CC99B8", // Darkened Pink Lavender
    "#E68088", // Darkened Salmon Pink
    "#D18EB3", // Darkened Pastel Purple
    "#E6B2A3", // Darkened Pastel Orange
    "#CC8CB3", // Darkened Lavender
  ];
?>
<div class="container container-sticky">
<div class="card round mt-3">
    <div class="d-lg-flex justify-content-between">
        <div class="m-3">
            Categoría: <?php echo $dashboard -> getCategory() ;?>
        </div>
        <div class="d-flex justify-content-end bd-highlight">
            <a class="btn btn-info round m-2 round " href='modalAddGrafica.php?id=<?php echo $id;?>' data-toggle='modal' data-target='#modalAddGra' role="button">
                Agregar gráfico
                <span class='fas fa-plus'></span>
            </a>
            <button type="button" id="move" class="btn btn-info m-2 round">
                <span id="save-button">Mover</span>
                <span class="fas fa-pen" aria-hidden="true"></span>
            </button>
            <button type="button" id="pdf" class="btn btn-info m-2 round">
                Descargar
                <span class="fas fa-file-pdf" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    <?php 
?>
<div class="input-group p-2">
    <select id="selectc" class="custom-select round" id="inputGroupSelect01">
        <?php 
        foreach ($categoriaRas as $currentCategoriaRa) {
            $selected = $currentCategoriaRa -> getIdCategoriaRa() === $category? 'selected' : '';
            echo "<option ".$selected." value=".$currentCategoriaRa -> getIdCategoriaRa().">".$currentCategoriaRa -> getNombre()."</option>";
        }
        ?>
    </select>
</div>
</div>
 <?php
    ?>
    
</div>


<div class="container mt-3" id="pdf-document" style="background-color: #e9ecef;">
<h3>
    <?php echo strtoupper($dashboard -> getNombre()); ?>
</h3>
<p>
    <?php echo $dashboard -> getDetalle() ?>
</p>
<div class="row grid" id="demoGrid">
    <?php 
    foreach($graficas as $currentGrafica){
        $currentGraficaConfig = $currentGrafica->getConfig();
        $id = $currentGraficaConfig;  // Establecer el parámetro
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
                <div>
                <?php if($currentGrafica -> getConfig() === 'categorysolidgauge'){?>
                <table class="table text-center" >
                <thead>
                    <tr>
                    <th scope="col">Nivel</th>
                    <th scope="col">Cantidad de Ra</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $bloom = new Bloom();
                    $blooms = $bloom -> selectAll();
                    $radius = 0;
                    $count = 0;
                    $niveles = 0;
                    foreach ($blooms as $currentBloom) {
                        $ra = new ResultadoAprendizaje("","","", $currentBloom -> getIdBloom(), $category);
                        $ras = $ra -> selectAllByBloomCategoria();
                        echo "<tr>";
                        echo "<td style='display: flex; justify-content: center; align-items: center;'>".$currentBloom -> getNombre()." <div class='m-1' style='background-color: ".$colors[$count]."; width: 15px; height: 15px;'>   </div></td>";
                        echo "<td>".count($ras)."</td>";
                        echo "</tr>";
                        if(count($ras)> 0){
                            $niveles++;
                        }
                        $solidgauge .= "{name: '".$currentBloom -> getNombre()."', data: [{ color: colors[".$count."], radius: '".($radius+18)."%', innerRadius: '".$radius."%', y: ".((count($ras) / count($resultadoAs)) * 100)." }]},";
                        $solidgaugeBack .= "{ outerRadius: '".($radius+18)."%', innerRadius: '".($radius)."%', backgroundColor: pastelColors[".$count."], borderWidth: 0 }, ";
                        $radius += 18;
                        $count += 1;
                    } 
                    
                    $solidgauge .= "]";
                    $solidgaugeBack .= "]";
                ?>
                </tbody>
                </table>
                <?php
                }
                if($currentGrafica -> getConfig() === 'generalnetworkgraph'){
                ?>

                <table class="table text-center">
                <thead>
                    <tr>
                    <th scope="col">Categoría</th>
                    <th scope="col">Cantidad de Ra</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $count = 0;
                    foreach ($categoriaRas as $currentCategoriaRa) {
                        $resultadoAp = new resultadoAprendizaje("","","","",$currentCategoriaRa -> getIdCategoriaRa());
                        $resultadoAps = $resultadoAp -> selectAllByCategoriaRa();
                        echo "<tr>";
                        echo "<td style='display: flex; justify-content: center; align-items: center;'>".$currentCategoriaRa -> getNombre()." <div class='m-1' style='background-color: ".$colors[$count]."; width: 15px; height: 15px;'>   </div></td>";
                        echo "<td>".count($resultadoAps)."</td>";
                        echo "</tr>";
                        $count++;
                    }
                
                ?>
                </tbody>
                </table>
                <?php
                }
                if($currentGrafica -> getConfig() === 'generalpackedbubble'){
                ?>

                <table class="table text-center">
                <thead>
                    <tr>
                    <th scope="col">Identificador</th>
                    <th scope="col">Resultado Aprendizaje</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $count = 1;
                    $countC = 0;
                    foreach ($categoriaRas as $currentCategoriaRa) {
                        $resultadoAp = new resultadoAprendizaje("","","","",$currentCategoriaRa -> getIdCategoriaRa());
                        $resultadoAps = $resultadoAp -> selectAllByCategoriaRa();
                        $buble .='{"name": "'.$currentCategoriaRa -> getNombre().'","data": [';
                        foreach ($resultadoAps as $currentResultadoAp) {
                            $buble .= '{"name": "R'.$count.'","value": 200},';
                            echo "<tr>";
                            echo "<td style='display: flex; justify-content: center; align-items: center;'>R".$count." <div class='m-1' style='background-color: ".$colors[$countC]."; width: 15px; height: 15px;'>   </div></td>";
                            echo "<td>".$currentResultadoAp -> getNombre()."</td>";
                            echo "</tr>";
                            $count++;
                        }
                        $countC++;
                        $buble .= ']},';
                    }
                    $buble .= ']';
                ?>
                </tbody>
                </table>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
        </div>
        <?php
    }
    ?>
</div>
</div>

<?php 
include('ui/grafica/customGrapich.php');
?>
<div class="modal fade" id="modalAddGra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content round" id="modalContent">
		</div>
	</div>
</div>

<script>

$(document).ready(function(){

let data = {};

$('body').on('show.bs.modal', '.modal', function (e) {
    $("#modalContent").empty();
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

$("#selectc").change(function(){
    idS = $("#selectc").val();
    console.log(idS)
    $("#loader").fadeIn(0);
    $("#dashboard").fadeOut(300, function() { // Desvanecer el contenido actual
        $("#dashboard").empty();
        var path = "indexAjax.php?pid=<?php echo base64_encode("ui/dashboard/dashboardCustomAjax.php").'&id='.$_GET['id']; ?>&category="+idS;
        console.log(path);
        $("#dashboard").load(path, function() {
            $("#dashboard").fadeIn(300); // Mostrar nuevo contenido con transición
            $("#loader").fadeOut(300);
        });
    });
});

$('#move').on('click', function() {
    var $gridItems = $('#demoGrid').find('.col-lg-4, .col-lg-6, .col-lg-8, .col-lg-12');
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

});

document.getElementById('pdf').addEventListener('click', function() {
    $("#loader").fadeIn(0);
    generatePDF('pdf-document');
    $("#loader").fadeOut(300);
});

</script>

<script type="text/javascript" src="core/config/customCreate.js"></script>