<?php 
$category = $_GET['category'];
$resultadoA = new ResultadoAprendizaje("","","","",$category);
$resultadoAs = $resultadoA -> selectAllByCategoriaRa();
$countEstrategias = 0;
$buble = "[";
$count = 1;
foreach ($resultadoAs as $currentResultadoAs) {
    $estrategia = new Estrategia("","","", $currentResultadoAs -> getIdResultadoAprendizaje());
    $estrategias = $estrategia -> selectAllByResultadoAprendizaje();
    $buble .= "{name: '".$currentResultadoAs -> getNombre()."', data: [";
    foreach ($estrategias as $currentEstrategia) {
        $buble .= "{ name: 'E".$count."', value: 200 },";
        $count++;
    }
    $buble .= "]},";
    $countEstrategias += count($estrategias);    
}
$buble .= "]";
$categoria = new CategoriaRa($category);
$categoria -> select();
$pie = "[";
$nivelBar = "[";
$solidgauge = "[";
$solidgaugeBack .= "[";

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

<div>
<div class="card-body" id="pdf">
    <h2><?php echo ($categoria -> getNombre()); ?></h2>
	<div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
            <div class="card-body text-center">
            <p>Resultados de aprendizaje</p>
            <h3><?php echo count($resultadoAs); ?></h3>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
            <div class="card-body text-center">
            <p>Cantidad de estrategias</p>
            <h3><?php echo $countEstrategias; ?></h3>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
            <div class="card-body text-center">
                <p>Niveles involucrados</p>
                <h3 id="niveles">0</h3>
            </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-6 col-sm-12 p-3" style="min-height: 400px;">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full p-4">
            <h6 class="font-weight-bold">Resultados de aprendizaje</h6>
            <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                    <th scope="col" style="width: 500px;">Nombre</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Cantidad estrategias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($resultadoAs as $currentResultadoAs) {
                        $estrategia = new Estrategia("","","", $currentResultadoAs -> getIdResultadoAprendizaje());
                        $estrategias = $estrategia -> selectAllByResultadoAprendizaje();

                        echo "<tr>";
                        echo "<td>".$currentResultadoAs -> getNombre()."</td>";
                        echo "<td>".$currentResultadoAs -> getBloom() -> getNombre()."</td>";
                        echo "<td>".count($estrategias)."</td>";
                        echo "</tr>";
                        $pie .= '{"name": "'.$currentResultadoAs -> getNombre().'", "y": '.count($estrategias).' },';    
                        $nivelBar .='["'.$currentResultadoAs -> getNombre().'", '.count($estrategias).'],';
                    }
                    $pie .= "]";
                    $nivelBar .= "]";
                    ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="pie"></div>    
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="bar"></div>    
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full p-4">
            <h6 class="font-weight-bold">Niveles por RA</h6>
            <div class="table-responsive">
            <table class="table text-center">
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
            </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="solidgauge"></div>    
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 p-3">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="packedbubble"></div>    
                    <table class="table text-center">
                        <thead>
                            <tr>
                            <th scope="col">Identificador</th>
                            <th scope="col">Estrategia</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $count = 1;
                            $countC = 0;
                            foreach ($resultadoAs as $currentResultadoAs) {
                                $estrategia = new Estrategia("","","", $currentResultadoAs -> getIdResultadoAprendizaje());
                                $estrategias = $estrategia -> selectAllByResultadoAprendizaje();
                                foreach ($estrategias as $currentEstrategia) {
                                    echo "<tr>";
                                    echo "<td style='display: flex; justify-content: center; align-items: center;'>E".$count." <div class='m-1' style='background-color: ".$colors[$countC]."; width: 15px; height: 15px;'>   </div></td>";
                                    echo "<td>".$currentEstrategia -> getNombre()."</td>";
                                    echo "</tr>";
                                    $count++;
                                }
                                $countC++;
                                
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script type="text/javascript">

    $(document).ready(function(){
        let pie = <?php echo ($pie); ?>;
        let nivelBar = <?php echo ($nivelBar); ?>;
        let solidgauge = <?php echo ($solidgauge); ?>;
        let solidgaugeBack = <?php echo ($solidgaugeBack); ?>;
        let buble = <?php echo ($buble); ?>;

        $("#niveles").text(<?php echo $niveles;?>)
        
        Highcharts.chart('pie',
        createChart(
            "Porcentaje de estrategias por RA", 
            "pie", 
            pie)
        )

        Highcharts.chart('bar',
            createChart(
                "Cantidad de estrategias por RA", 
                "column", 
                nivelBar, 
                "Cantidad estrategias", 
                "Cantidad estrategias")
        )

        Highcharts.chart('solidgauge',
            createChart(
                "Porcentaje de niveles por RA", 
                "solidgauge", 
                solidgauge,
                solidgaugeBack)
        )

        Highcharts.chart('packedbubble', 
            createChart(
                "Estretegias por RA", 
                "packedbubble",
                buble)
        );

    });
</script>