<?php
$ra = new ResultadoAprendizaje();
$ras = $ra -> selectAll();
?>
<div class="container">
    <div class="card round m-2">
        <div class="d-flex justify-content-between bd-highlight">
            <div class="input-group m-2">
                <select id="select" class="custom-select round" id="inputGroupSelect01">
                    <option selected>Seleccione una categoría...</option>
                    <?php 
                    foreach ($ras as $currentRa) {
                        echo "<option value=".$currentRa -> getIdResultadoAprendizaje().">".$currentRa -> getNombre()."</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="button" id="export-pdf" class="btn btn-secondary m-2 round w-25 d-none">
                Descargar PDF
                <span class="fas fa-file-pdf" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div id="content" style="background-color: #e1e1e1;">

    </div>
</div>


<script>
$(document).ready(function(){
    $("#select").change(function(){
        $("#content").fadeOut(300, function() { // Desvanecer el contenido actual
            $("#loader").fadeIn(); // Mostrar indicador de carga
            $("#content").empty();
            var path = "indexAjax.php?pid=<?php echo base64_encode('ui/resultadoAprendizaje/raDashboardAjax.php'); ?>&ra="+$("#select").val();
            $("#content").load(path, function() {
                $("#loader").fadeOut(); // Ocultar indicador de carga después de cargar el contenido
                $("#content").fadeIn(300); // Mostrar nuevo contenido con transición
                $("#export-pdf").removeClass('d-none'); 
            });
        });
    });
});

document.getElementById('export-pdf').addEventListener('click', function() {
    generatePDF('content', 'ra');
});

</script>