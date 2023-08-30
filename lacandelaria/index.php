<?php 
require_once 'templeat/header.php'; 
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
?>
    <main>  
        <div class="container">
            <div class="squares square1">
                <div id="content">
                    <i class="fa-solid fa-1"></i>
                </div>
                <div id="background">
                    <div id="text">
                        <?php 
                        $anos = conseguirAno($db, true);

                        if (!empty($anos)):
                            $_SESSION['anos'] = $anos;
                            while ($_SESSION['grado'] = mysqli_fetch_assoc($_SESSION['anos'])):
                        ?>
                        <h2>1° año</h2>
                                <a href="estudiantes.php?id=<?=$_SESSION['grado']['id']?>"><?=$_SESSION['grado']['ano']. '|' .$_SESSION['grado']['seccion']?></a>
                        <?php endwhile;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            
                <div class="squares square2">
                    <div id="content">
                        <i class="fa-solid fa-2"></i>
                    </div>
                    <div id="background">
                        <div id="text">
                            <?php 
                            $anos = conseguirAno($db, null, true);

                            if (!empty($anos)):
                                while ($ano = mysqli_fetch_assoc($anos)):
                            ?>
                        <h2>2° año</h2>
                                <a href="estudiantes.php?id=<?=$ano['id']?>"><?=$ano['ano']. '|' .$ano['seccion']?></a>
                            <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            

            
          
                <div class="squares square3">
                    <div id="content">
                        <i class="fa-solid fa-3"></i>
                    </div>
                    <div id="background">
                        <div id="text">
                            <?php 
                            $anos = conseguirAno($db, null, null, true);

                            if (!empty($anos)):
                                while ($ano = mysqli_fetch_assoc($anos)):
                            ?>
                        <h2>3° año</h2>
                                <a href="estudiantes.php?id=<?=$ano['id']?>"><?=$ano['ano']. '|' .$ano['seccion']?></a>
                            <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

                <div class="squares square4">
                    <div id="content">
                        <i class="fa-solid fa-4"></i>
                    </div>
                    <div id="background">
                        <div id="text">
                            <?php 
                            $anos = conseguirAno($db, null, null, null, true);

                            if (!empty($anos)):
                                while ($ano = mysqli_fetch_assoc($anos)):
                            ?>
                        <h2>4° año</h2>
                                <a href="estudiantes.php?id=<?=$ano['id']?>"><?=$ano['ano']. '|' .$ano['seccion']?></a>
                            <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

                <div class="squares square5">
                    <div id="content">
                        <i class="fa-solid fa-5"></i>
                    </div>
                    <div id="background">
                        <div id="text">
                            <?php 
                            $anos = conseguirAno($db, null, null, null, null,true);

                            if (!empty($anos)):
                                while ($ano = mysqli_fetch_assoc($anos)):
                            ?>
                        <h2>5° año</h2>
                                <a href="estudiantes.php?id=<?=$ano['id']?>"><?=$ano['ano']. '|' .$ano['seccion']?></a>
                            <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

                <div class="squares square6">
                    <div id="content">
                        <i class="fa-solid fa-6"></i>
                    </div>
                    <div id="background">
                        <div id="text">
                            <?php 
                            $anos = conseguirAno($db, null, null, null, null, null, true);

                            if (!empty($anos)):
                                while ($ano = mysqli_fetch_assoc($anos)):
                            ?>
                        <h2>6° año</h2>
                                <a href="estudiantes.php?id=<?=$ano['id']?>"><?=$ano['ano']. '|' .$ano['seccion']?></a>
                            <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                
     
            
                  
            </div>
            
           
            
    </main>
    <!--iconos de los años -->
    <script src="https://kit.fontawesome.com/5818af7131.js" crossorigin="anonymous"></script>
     <!--footer -->                               
    <script src="https://kit.fontawesome.com/5818af7131.js" crossorigin="anonymous"></script>
    <?php
    
  include_once 'templeat/footer.php';
  ?>

