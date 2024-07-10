<?php 
$id = $_GET['id'];
$dashboard = new Dashboard($id);
$dashboard -> select();
$grafica = new Grafica( "", "","", "", "", "", "", $id);
$graficas = $grafica -> selectAllByDashboardOrder('posicion','asc');
$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
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


<div class="container mt-3" id="pdf-document" style="background-color: #e9ecef;">
<h3>
    <?php echo strtoupper($dashboard -> getNombre()); ?>
</h3>
<p>
    <?php echo $dashboard -> getDetalle() ?>
</p>

<div id="demoGrid">
<h4>Resumen</h4>
<div class="row grid" >
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
                <?php if($currentGrafica -> getConfig() === 'generalnetworkgraph'){ ?>
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
                if($currentGrafica -> getConfig() === 'generalpackedbubble'){ ?>
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
            <?php }?>
            </div>
        </div>
        </div>
        <?php
    }
    ?>
</div>
</div>

</div>

<?php 
include('ui/grafica/customGrapich.php');
?>

<script>

$(document).ready(function(){

let data = {};

$('body').on('show.bs.modal', '.modal', function (e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});

sortable = Sortable.create(demoGrid, {
    animation: 150,
    group: 'grid-items',
    draggable: '.grid-item',
    handle: '.grid-item',
    sort: true,
    chosenClass: 'active'
});

document.getElementById('pdf').addEventListener('click', function() {
    generatePDF('pdf-document');
});
});



</script>

<script type="text/javascript" src="core/config/customCreate.js"></script>