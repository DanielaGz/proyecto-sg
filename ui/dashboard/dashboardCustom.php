<?php 
$dashboard = new Dashboard("","","",$_SESSION['id']);
$dashboards = $dashboard -> selectAllByUsuario();
?>

<div class="container">
    <div class="card round mt-3">
        <div class="d-flex align-items-center bd-highlight">
            <div class="btn-group m-2" role="group" aria-label="Basic outlined example">
                <?php 
                    $count = 1;
                    foreach($dashboards as $currentDashboard){
                        $customClass = $count == 1 ? 'round-left' : '';
                        $customClass .= $count == count($dashboards) ? 'round-right' : '';
                        if(count($dashboards) === 1){
                            $customClass = 'round';
                        }
                        echo ('<button type="button" class="btn btn-outline-info '.$customClass.'" onclick="selectDashboard('.$currentDashboard -> getIdDashboard().')">'.$currentDashboard -> getNombre().'</button>');
                        $count++;
                    }
                ?>
            </div>
            <button type="button" class="btn btn-info round mr-1" data-toggle="tooltip" data-placement="bottom" title="Agregar">
                <span class='fas fa-plus'></span>
            </button>
            <span class="align-middle">Seleccione un dashboard...</span>
        </div>
    </div>
</div>
<div id="menu-dashboard"></div>
<div id="dashboard"></div>

<div class="modal fade" id="modalEstrategia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content round" id="modalContent">
		</div>
	</div>
</div>


<script>
    //show modal grapichs
    let barshow = '';
    let pieshow = '';
    let added = '';

    let change = false;
    let section = '';
    let typeG = '';
    let idS = 0;
    let sortable = '';
    let $gridItems = '';


    $(document).ready(function(){
        
        $('body').on('hidden.bs.modal', function (e) {
            $("#modalContent").empty();
            if (change){
                $("#dashboard").fadeOut(300, function() { // Desvanecer el contenido actual
                    $("#dashboard").empty();
                    var path = "indexAjax.php?pid=<?php echo base64_encode("ui/dashboard/dashboardCustomAjax.php"); ?>&id="+idS;
                    $("#dashboard").load(path, function() {
                        $("#dashboard").fadeIn(300); // Mostrar nuevo contenido con transición
                    });
                });
            }
            change = false;
        });
    });


    function selectDashboard(id){
        idS = id;
        $("#dashboard").fadeOut(300, function() { // Desvanecer el contenido actual
            $("#dashboard").empty();
            var path = "indexAjax.php?pid=<?php echo base64_encode("ui/dashboard/dashboardCustomAjax.php"); ?>&id="+id;
            $("#dashboard").load(path, function() {
                $("#dashboard").fadeIn(300); // Mostrar nuevo contenido con transición
            });
            $("#menu-dashboard").empty();
            var menu_path = "indexAjax.php?pid=<?php echo base64_encode("ui/dashboard/menuDashboard.php"); ?>&id="+idS;
            $("#menu-dashboard").load(menu_path, function() {
                $("#menu-dashboard").fadeIn(300); // Mostrar nuevo contenido con transición
            });
        });
    }

    function updateGraph(id, op){
        let tams_ant = {
            '4' : '4',
            '6' : '4',
            '8' : '6',
            '12' : '9'
        }
        let tams_sig = {
            '4' : '6',
            '6' : '8',
            '8' : '12',
            '12' : '12'
        }
        let classes = $('#' + id).attr('class').split(' ');
            $.each(classes, function(index, className) {
            ant = '';
            if (className.indexOf('col-lg') !== -1) {
                    let parts = className.split('-');
                    if (parts.length > 1) {
                        ant = parts[2];
                        return false; // Salir del bucle each cuando se encuentre la clase deseada
                    }
                }
            });
        let tam = (op === '+') ? tams_sig[ant] : tams_ant[ant];
        $.ajax({
            url: 'updateGraficaService.php?id='+id,
            type: 'POST',
            data: {
                'tam': tam,
                'update': true
            },
            success: function(response) {
                console.log(response)
                $('#' + id).removeClass('col-lg-'+ant);
                $('#'+id).addClass('col-lg-'+(tam));
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown, jqXHR);
            }
        });
    }

    function del(id){
        $.ajax({
            url: 'updateGraficaService.php?id='+id,
            type: 'POST',
            data: {
                'delete': true
            },
            success: function(response) {
                console.log(response);
                $('#'+id).remove();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown, jqXHR);
            }
        });
    }

    
</script>