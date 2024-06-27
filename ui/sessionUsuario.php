<?php
$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
$pie = "[";
$categories = []; 
$nivelBar = "[";
$countRa = 0 ; 
$network = [];
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
<div class="">
	<div class="">
        <div class="d-flex flex-row-reverse bd-highlight">
            <button type="button" id="export-pdf" class="btn btn-info m-2 round">
                Descargar PDF
                <span class="fas fa-file-pdf" aria-hidden="true"></span>
            </button>
            <button type="button" id="export-png" class="btn btn-info m-2 round">
                Descargar PNG
                <span class="fas fa-file-image" aria-hidden="true"></span>
            </button>
        </div>
		<div class="card-body">
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
            <div class="col-lg-12 col-md-12 col-sm-12 p-3">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
				<div class="card-body text-center">
                    <div id="bar"></div>
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
                    <div id="networkgraph"></div>
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
    console.log(network)
    const graphics = [];

    /* graphics.push(Highcharts.chart('bar', {
        chart: {
            type: 'column'
        },
        colors: colors,
        credits: {
        enabled: false
    },
        title: {
            text: 'Cantidad de RA por categoría',
            align: 'left'
        },
        xAxis: {
            type: 'category',
            labels: {
                autoRotation: [-45, -90],
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad RA'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'RA {point.y:.1f}'
        },
        series: [{
            name: 'Population',
            colorByPoint: true,
            groupPadding: 0,
            data: [...nivelBar],
            dataLabels: {
                enabled: false,
                rotation: -90,
                color: '#FFFFFF',
                inside: true,
                verticalAlign: 'top',
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }],
    })); */

    graphics.push(Highcharts.chart('bar',
        createChart(
            "Cantidad de RA por categoría", 
            "column", 
            nivelBar, 
            "Cantidad RA", 
            "Cantidad RA")
    ));

    graphics.push(Highcharts.chart('pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        colors: colors,
        title: {
            text: 'Porcentaje RA por categoría',
            align: 'left'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            },
            series: {
                borderRadius: 5,
                dataLabels: [{
                    enabled: false,
                    distance: 15,
                    format: '{point.name}'
                }, {
                    enabled: false,
                    distance: '-30%',
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 5
                    },
                    style: {
                        fontSize: '0.9em',
                        textOutline: 'none'
                    }
                }]
            }
        },
        series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: pie
        }]
    }));

    graphics.push(Highcharts.chart('networkgraph', {
        chart: {
            type: 'networkgraph'
        },
        colors: colors,
        title: {
            text: 'Resultados de aprendizaje',
            align: 'left'
        },
        exporting: {
        allowHTML: true
    },plotOptions: {
            networkgraph: {
                keys: ['from', 'to'],
                layoutAlgorithm: {
                    enableSimulation: true,
                    friction: -0.9
                },
                dataLabels: {
                    enabled: true,
                linkFormat: '',
                style: {
                    fontSize: '12px'
                },
                formatter: function() {
                    // Inicialmente retorna una cadena vacía para ocultar los labels
                    return '';
                }
                },
            },
            series: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            accessibility: {
                enabled: false
            },
            dataLabels: {
                enabled: true,
                linkFormat: '',
                style: {
                    fontSize: '0.9em',
                    fontWeight: 'normal'
                }
            },
            id: 'lang-tree',
            data: [
                ...network
            ]
        }]
    }));

    graphics.push(Highcharts.chart('column-line', {
        title: {
            text: 'Resultados de aprendizaje por bloom',
            align: 'left'
        },
        colors: colors,
        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: 'Cantidad RA'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            series: {
                borderRadius: '25%'
            }
        },
        series: [...nivel,{
            type: 'pie',
            name: 'Total',
            data: [...nivelPie],
            center: [20, 20],
            size: 100,
            innerSize: '70%',
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    }));

    document.getElementById('export-png').addEventListener('click', () => {
        Highcharts.exportCharts(graphics);
    });

    document.getElementById('export-pdf').addEventListener('click', () => {
        Highcharts.exportCharts(graphics, {
            type: 'application/pdf'
        });
    });

</script>