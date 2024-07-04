<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/LogUsuario.php");
require("business/Usuario.php");
require("business/UsuarioDashboard.php");
require("business/Dashboard.php");
require("business/Grafica.php");
require("business/CategoriaRa.php");
require("business/Bloom.php");
require("business/ResultadoAprendizaje.php");
require("business/Estrategia.php");
require("business/EstrategiaCriterio.php");
require("business/Criterio.php");
require("business/Calificacion.php");
require_once("persistence/Connection.php");
$id = $_GET['id'];
$grafica = new Grafica($id);
$grafica -> select('posicion','asc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $graficaUpdate = new Grafica(
        $id, 
        $_POST['nombre'], 
        $_POST['detalle'], 
        $_POST['typeG'],
        $_POST['section'],
        $grafica -> getPosicion(),
        $_POST['filas'],
        $grafica -> getDashboard() -> getIdDashboard()
        );
    $graficaUpdate -> update();
}
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Editar gráfica</h4>
	<button type="button" id="close" class="close m-1" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
        <div>
            <div class="form-group">
                    <label>Nombre*</label>
                    <input type="text" class="form-control round" id="name" value="<?php echo $grafica -> getNombre(); ?>"/>
                </div>			
            </div>
        <div>
            <div class="form-group">
                <label>Detalle*</label>
                <input type="text" class="form-control round" id="detalle"  value="<?php echo $grafica -> getDetalle(); ?>" />
            </div>
        </div>
        <div>
            <p>Filas*</p>
            <select class="form-control round" id="filas">
               <option value="4" <?php echo ($grafica -> getTam() == '3' ? 'selected': '');?>>1</option>
               <option value="6" <?php echo ($grafica -> getTam() == '6' ? 'selected': '');?>>2</option>
               <option value="12" <?php echo ($grafica -> getTam() == '12' ? 'selected': '');?>>3</option>
            </select>
        </div>
		<div class="mt-3">
            <p>Información*</p>
            <div class="custom-control custom-radio custom-control-inline">
                <input 
                <?php echo ($grafica -> getFila() == 'general' ? 'checked': '');?>
                type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" onclick="selectGrapich('general')">
                <label class="custom-control-label" for="customRadioInline1">General</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input 
                <?php echo ($grafica -> getFila() == 'categoria' ? 'checked': '');?>
                type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" onclick="selectGrapich('categoria')">
                <label class="custom-control-label" for="customRadioInline2">Categoría</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input 
                <?php echo ($grafica -> getFila() == 'ra' ? 'checked': '');?>
                type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input" onclick="selectGrapich('general')">
                <label class="custom-control-label" for="customRadioInline3">Resultado de aprendizaje</label>
            </div>
        </div>
        <div class="mt-3">
            <p>Tipo de gráfica*</p>
            <div>
                <div id="type_grapich" class="d-flex overflow-auto">
                </div>
            </div>
        </div>
        <button type="button" id="save" class="btn btn-info round" name="insert">Guardar</button>
	</table>
</div>
<script>

section = '<?php echo ($grafica -> getFila());?>';
typeG = '<?php echo ($grafica -> getConfig());?>';

function selectGrapich(type){
    $("#type_grapich").empty();
    let gr = graficas[type];
    for (let i = 0; i < gr.length; i++) {
        checked = "";
        if(typeG === gr[i]){
            checked = 'checked';
        }
        $("#type_grapich").append('<div class="w-25 border round p-1 m-1"><div class="d-flex justify-content-between align-items-start m-2"><p>'+gr[i]+'</p><input class="" '+checked+' type="checkbox" onclick="selectType('+"'"+gr[i]+"'"+')"></div><img src="core/assets/'+gr[i]+'.png" alt="..." class="img-fluid"></div>');
    }
}

function selectType(type){
    typeG = type;
}


if(section !== ''){
    selectGrapich(section);
}

$('#save').click(function() {
    $.ajax({
        url: 'modalUpdateGrafica.php?id=<?php echo $id ?>',
        type: 'POST',
        data: { 
            nombre: $("#name").val(), 
            detalle: $("#detalle").val(),
            filas: $("#filas").val(),
            section: section,
            typeG: typeG
        },
        success: function(response) {
            $("#close").click();
            change = true;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
});

</script>