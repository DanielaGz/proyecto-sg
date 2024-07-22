<?php 

$categoriaRa = new CategoriaRa();
$categoriaRas = $categoriaRa -> selectAll();
$pie = "[";
$categories = []; 
$nivelBar = "[";
$countRa = 0 ; 
$network = [];
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
foreach ($categoriaRas as $currentCategoriaRa) {
    $resultadoAp = new resultadoAprendizaje("","","","",$currentCategoriaRa -> getIdCategoriaRa());
    $resultadoAps = $resultadoAp -> selectAllByCategoriaRa();
    $buble .='{"name": "'.$currentCategoriaRa -> getNombre().'","data": [';
    foreach ($resultadoAps as $currentResultadoAp) {
        $buble .= '{"name": "R'.$count.'","value": 200},';
        $count++;
    }
    $countC++;
    $buble .= ']},';
}
$buble .= ']';

$resultadoA = new ResultadoAprendizaje("","","","",$category);
$resultadoAs = $resultadoA -> selectAllByCategoriaRa();
$categorybar .= "[";
$categorypie .= "[";
foreach ($resultadoAs as $currentResultadoAs) {
    $estrategia = new Estrategia("","","", $currentResultadoAs -> getIdResultadoAprendizaje());
    $estrategias = $estrategia -> selectAllByResultadoAprendizaje();
    $categorypie .= '{"name": "'.$currentResultadoAs -> getNombre().'", "y": '.count($estrategias).' },';    
    $categorybar .='["'.$currentResultadoAs -> getNombre().'", '.count($estrategias).'],';
}
$categorypie .= "]";
$categorybar .= "]";

?>

<script>
grapich['generalbar'] = <?php echo ($nivelBar); ?>;
grapich['categorypie'] = <?php echo ($categorypie); ?>;
grapich['categorybar'] = <?php echo ($categorybar); ?>;
grapich['generalpie'] = <?php echo ($pie); ?>;
grapich['generalnetworkgraph'] = <?php echo json_encode($network); ?>;
grapich['generalpackedbubble'] = <?php echo ($buble); ?>;
grapich['generalcolumn-line'] = <?php echo ($nivelPie); ?>;
grapich['categories'] = <?php echo ($categories); ?>;
grapich['nivel'] = <?php echo ($nivel); ?>;
console.log(grapich)

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



});

document.getElementById('pdf').addEventListener('click', function() {
    generatePDF('pdf-document');
});

</script>
