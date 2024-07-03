<?php 
$id = $_GET['id'];
$grafica = new Grafica( "", "","", "", "", "", "", $id);
$graficas = $grafica -> selectAllByDashboardOrder('posicion','asc');
?>
<div class="card round mt-3">
    <div class="d-flex justify-content-between bd-highlight">
        <button type="button" id="toggle" class="btn btn-info m-2 round w-25">
            Editar
            <span class="fas fa-file-pdf" aria-hidden="true"></span>
        </button>
    </div>
</div>

<div class="row grid" id="demoGrid">
    <?php 
    foreach($graficas as $currentGrafica){
        ?>
        <div class="col-lg-<?php echo $currentGrafica -> getTam();?> col-md-12 col-sm-12 p-3 not-draggable">
            <div class="card drag-item cursor-move mb-lg-0 mb-4 border-0 round h-full">
            <div class="card-body text-center">
                <div class="justify-content-end tools d-flex">
                    <a class="btn btn-info round mr-1" href='modalUpdateGrafica.php?id=<?php echo $currentGrafica -> getIdGrafica();?>' data-toggle='modal' data-target='#modalEstrategia' role="button">
                        <span class='fas fa-pen'></span>
                    </a>
                    <button type="button" class="btn btn-danger round" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                        <span class='fas fa-trash'></span>
                    </button>
                </div>
                Grafica
            </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<div class="modal fade" id="modalEstrategia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content round" id="modalContent">
		</div>
	</div>
</div>

<script>

let section = '';
let typeG = '';

$(document).ready(function(){

$('body').on('show.bs.modal', '.modal', function (e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});

$('body').on('hidden.bs.modal', function (e) {
    $("#modalContent").empty();
    console.log('cerraoooo')
});

var sortable = Sortable.create(demoGrid, {
    animation: 150,
    group: 'grid-items',
    draggable: '.grid-item',
    handle: '.grid-item',
    sort: true,
    chosenClass: 'active'
});

$('#toggle').on('click', function() {
    var $gridItems = $('#demoGrid').find('.col-lg-4, .col-lg-6, .col-lg-12');
    if ($gridItems.hasClass('grid-item')) {
        $('.tools').removeClass('d-flex');
        $('.tools').addClass('d-none');
        $gridItems.removeClass('tilt');
        $gridItems.removeClass('grid-item').addClass('not-draggable');
    } else {
        $('.tools').removeClass('d-none');
        $('.tools').addClass('d-flex');
        $gridItems.addClass('tilt');
        $gridItems.removeClass('not-draggable').addClass('grid-item');
    }
    sortable.option("draggable", ".grid-item");
});
});

</script>