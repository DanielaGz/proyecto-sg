<?php 
$id = $_GET['id'];
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

<div class="modal fade" id="modalAddGra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content round" id="modalContent">
		</div>
	</div>
</div>

<script>


$('#move').on('click', function() {
    $gridItems = $('#demoGrid').find('.col-lg-4, .col-lg-6, .col-lg-8, .col-lg-12');
    console.log($gridItems)
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

</script>