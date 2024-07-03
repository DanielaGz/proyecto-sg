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
            <span class="align-middle">Seleccione un dashboard...</span>
        </div>
    </div>
    <div id="dashboard"></div>
</div>

<script>

    function selectDashboard(id){
        console.log(id)
        $("#dashboard").fadeOut(300, function() { // Desvanecer el contenido actual
            $("#dashboard").empty();
            var path = "indexAjax.php?pid=<?php echo base64_encode("ui/dashboard/dashboardCustomAjax.php"); ?>&id="+id;
            $("#dashboard").load(path, function() {
                $("#dashboard").fadeIn(300); // Mostrar nuevo contenido con transición
            });
        });
    }
</script>