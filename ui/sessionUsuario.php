<?php
$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
$pie = "[";
$categories = []; 
$nivelBar = "[";
foreach ($categoriaRas as $currentCategoriaRa) {
	$resultadoAp = new resultadoAprendizaje("","","","",$currentCategoriaRa -> getIdCategoriaRa());
	$resultadoAps = $resultadoAp -> selectAllByCategoriaRa();
	array_push($categories,$currentCategoriaRa -> getNombre());
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
    $nivelPie .='{name: "'.$currentBlom -> getNombre().'",y: '.count($resultadoAps).',color: Highcharts.getOptions().colors['.$iB.'],dataLabels: { enabled: true,distance: -50, format: "{point.total}",style: {fontSize: "15px"}} },';
    $iB++;
}
$nivel .= "]";
$nivelPie .= "]";
?>
<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>General</h3>
		</div>
		<div class="card-body">
			<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 p-0">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0">
				<div class="card-body text-center">
                <div id="pie"></div>
				</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 p-0">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0">
				<div class="card-body text-center">
                    <div id="bar"></div>
				</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 p-0">
				<div class="card drag-item cursor-move mb-lg-0 mb-4 border-0">
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
    let nivel = <?php echo ($nivel); ?>;
    let nivelPie = <?php echo ($nivelPie); ?>;
    let nivelBar = <?php echo ($nivelBar); ?>;
	console.log(nivelBar)

Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
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
        name: 'Brands',
        colorByPoint: true,
        data: pie
    }]
});

// Data retrieved from https://www.ssb.no/energi-og-industri/olje-og-gass/statistikk/sal-av-petroleumsprodukt/artikler/auka-sal-av-petroleumsprodukt-til-vegtrafikk
Highcharts.chart('column-line', {
    title: {
        text: 'Resultados de aprendizaje por bloom',
        align: 'left'
    },
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
});

Highcharts.chart('bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cantidad de RA por categoría'
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
    }]
});




// Data retrieved from https://worldpopulationreview.com/country-rankings/countries-by-density


</script>