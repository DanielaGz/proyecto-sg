<?php 
$ra = new ResultadoAprendizaje($_GET['ra']);
$ra -> select();
$estrategia = new Estrategia("","","",$_GET['ra']);
$estrategias = $estrategia -> selectAllByResultadoAprendizaje();
$criterio = new Criterio("", "", "",$_GET['ra']);
$criterios = $criterio -> selectAllByResultadoAprendizaje();
?>
<div class="container">
    <div id="content" style="background-color: #e9ecef;">
        <section>
            <h2><?php echo strtoupper("Resultado de aprendizaje"); ?></h2>
            <p>
                <?php echo $ra -> getNombre(); ?>
            </p>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 p-3">
                    <div class="card mb-lg-0 mb-4 border-0 round h-full">
                    <div class="card-body text-center">
                    <p>Estrategias de enseñanza</p>
                    <h3><?php echo count($estrategias); ?></h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-3">
                    <div class="card mb-lg-0 mb-4 border-0 round h-full">
                    <div class="card-body text-center">
                    <p>Criterios</p>
                    <h3><?php echo count($criterios); ?></h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-3">
                    <div class="card mb-lg-0 mb-4 border-0 round h-full">
                    <div class="card-body text-center">
                    <p>Bloom</p>
                    <h3><?php echo ($ra -> getBloom() -> getNombre());; ?></h3>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <section>
            <h3><?php echo strtoupper("Estrategias"); ?></h3>
            <div class="row">
                <?php 
                foreach($estrategias as $currentEstrategia){
                ?>
                <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                    <div class="card h-full">
                        <div class="card-header m-0">
                            <h4 class="card-title">
                                <?php echo $currentEstrategia -> getNombre() ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php echo $currentEstrategia -> getDetalle() ?>
                        </div>
                    </div>
                </div>
                <?php
                } 
                ?>
            <div>
        </section>
        <section>
            <h3><?php echo strtoupper("Criterios"); ?></h3>
            <div class="row">
                <?php 
                foreach($criterios as $currentCriterio){
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 p-3">
                    <div class="card h-full">
                        <div class="card-header m-0">
                            <h4 class="card-title">
                                <?php echo $currentCriterio -> getNombre() ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <p>
                                <?php echo $currentCriterio -> getDetalle() ?>
                            </p>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                    <th scope="col">Calificación</th>
                                    <th scope="col">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $calificacion = new Calificacion("","","",$currentCriterio -> getIdCriterio());
                                    $calificaciones = $calificacion -> selectAllByCriterio();
                                    foreach ($calificaciones as $currentCalificacion) {
                                        echo "<tr>";
                                        echo "<td style='display: flex; justify-content: center; align-items: center;'>".$currentCalificacion -> getNivel()."</td>";
                                        echo "<td>".$currentCalificacion -> getDetalle()."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                } 
                ?>
            <div>
        </section>
    </div>
<div>