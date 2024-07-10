<?php
$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
$pie = "[";
$categories = []; 
$nivelBar = "[";
$countRa = 0 ; 
$network = [];
$buble = '[';
foreach ($categoriaRas as $currentCategoriaRa) {
	$resultadoAp = new resultadoAprendizaje("","","","",$currentCategoriaRa -> getIdCategoriaRa());
	$resultadoAps = $resultadoAp -> selectAllByCategoriaRa();
    $countRa += count($resultadoAps);
	array_push($categories,$currentCategoriaRa -> getNombre());
    array_push($network,['RESULTADOS APRENDIZAJE', $currentCategoriaRa -> getNombre()]);
    foreach ($resultadoAps as $currentresultadoAp) {
        array_push($network,[$currentCategoriaRa -> getNombre(), $currentresultadoAp -> getNombre()]);
    }
	$pie .= '{"name": "'.$currentCategoriaRa -> getNombre().'","y": '.count($resultadoAps)."},";
    $nivelBar .='["'.$currentCategoriaRa -> getNombre().'", '.count($resultadoAps).'],';
}
$pie .= "]";
$nivelBar .= "]";

$blom = new Bloom();
$bloms = $blom -> selectAll();
$nivel = "[";
$nivelPie = "[";
$iB = 0;
foreach ($bloms as $currentBlom) {
	$data = [];
	$resultadoAp = new resultadoAprendizaje("","","",$currentBlom -> getIdBloom());
	$resultadoAps = $resultadoAp -> selectAllByBloom();
	$sum = array_fill(0, count($categories), 0);
	foreach ($resultadoAps as $currentResultadoAps) {
		for ($i = 0; $i < count($categories); $i++) {
			if($currentResultadoAps -> getCategoriaRa() -> getNombre() === $categories[$i]){
				$sum[$i]= $sum[$i]+1;
			}
		}
	}
    $nivel .='{type: "column",name: "'.$currentBlom -> getNombre().'",data: '.json_encode($sum).'},';
    $nivelPie .='{name: "'.$currentBlom -> getNombre().'",y: '.count($resultadoAps).',color: colors['.$iB.'],dataLabels: { enabled: true,distance: -50, format: "{point.total}",style: {fontSize: "15px"}} },';
    $iB++;
}
$nivel .= "]";
$nivelPie .= "]";
?>
<div class="container">
	<div class="">
        <div class="d-flex flex-row-reverse bd-highlight">
            <button type="button" id="export-pdf" class="btn btn-info m-2 round">
                Descargar PDF
                <span class="fas fa-file-pdf" aria-hidden="true"></span>
            </button>
            <!-- <button type="button" id="export-png" class="btn btn-info m-2 round">
                Descargar PNG
                <span class="fas fa-file-image" aria-hidden="true"></span>
            </button> -->
        </div>
		<div class="card-body" id="pdf" style="background-color: #e9ecef;">
            <h2><?php echo strtoupper("Resultados de aprendizaje"); ?></h2>
			<div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                <p>Categorias de resultados de aprendizaje</p>
                <h3><?php echo count($categoriaRas); ?></h3>
				</div>
				</div>
			</div>
            <div class="col-lg-4 col-md-4 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                <p>Resultados de aprendizaje</p>
                <h3><?php echo $countRa; ?></h3>
				</div>
				</div>
			</div>
            <div class="col-lg-4 col-md-4 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <p>Bloom</p>
                    <h3><?php echo count($bloms); ?></h3>
				</div>
				</div>
			</div>
            <div class="col-lg-7 col-md-12 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="networkgraph"></div>
				</div>
				</div>
			</div>
            <div class="col-lg-5 col-md-12 col-sm-12 p-3" >
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round p-4" >
            <h6 class="font-weight-bold">Resultados de aprendizaje</h6>
            <div class="table-responsive">
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
            </div>
            </div>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                <div id="packedbubble"></div>
				</div>
                
				</div>
			</div>
            <div class="col-lg-12 col-md-12 col-sm-12 p-3" style="min-height: 400px;">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full p-4">
            <h6 class="font-weight-bold">Resultados de aprendizaje</h6>
            <div class="table-responsive">
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
            </div>
            </div>
        </div>
			<div class="col-lg-7 col-md-6 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="bar"></div>                    
				</div>
				</div>
			</div>
            <div class="col-lg-5 col-md-6 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                <div id="pie"></div>
				</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                <div id="column-line"></div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	let pie = <?php echo ($pie); ?>;
	let categories = <?php echo json_encode($categories); ?>;
    let network = <?php echo json_encode($network); ?>;
    let nivel = <?php echo ($nivel); ?>;
    let nivelPie = <?php echo ($nivelPie); ?>;
    let nivelBar = <?php echo ($nivelBar); ?>;
    let buble = <?php echo ($buble); ?>;
    const graphics = [];

    graphics.push(Highcharts.chart('bar',
        createChart(
            "Cantidad de RA por categoría", 
            "column", 
            nivelBar, 
            "Cantidad RA", 
            "Cantidad RA")
    ));

    graphics.push(
        Highcharts.chart('pie',
        createChart(
            "Porcentaje RA por categoría", 
            "pie", 
            pie)
        )
    );networkgraph

    graphics.push(
        Highcharts.chart('networkgraph',
        createChart(
            "Resultados de aprendizaje", 
            "networkgraph", 
            network)
        )
    );

    graphics.push(
        Highcharts.chart('column-line',
        createChart(
            "'Resultados de aprendizaje por bloom", 
            "column-line", 
            nivelPie,
            'Cantidad RA',
            categories,
            nivel)
        )
    );

    graphics.push(
        Highcharts.chart('packedbubble',
        createChart(
            "Resultados de aprendizaje por categoría", 
            "packedbubble", 
            buble)
        )
    );

    /* document.getElementById('export-png').addEventListener('click', () => {
        Highcharts.exportCharts(graphics);
    }); */

   /*  document.getElementById('export-pdf').addEventListener('click', () => {
        Highcharts.exportCharts(graphics, {
            type: 'application/pdf'
        });
    }); */

    // Función para generar el PDF
    document.getElementById('export-pdf').addEventListener('click', function() {
        generatePDF('pdf');
    });

</script>