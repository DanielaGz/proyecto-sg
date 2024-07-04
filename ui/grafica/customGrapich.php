<?php 
$id = $_GET['id'];
$grafica = new Grafica( "", "","", "", "", "", "", $id);
$graficas = $grafica -> selectAllByDashboardOrder('posicion','asc');
echo 'aaaaaaaaaaaaaaaaaaa';
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
