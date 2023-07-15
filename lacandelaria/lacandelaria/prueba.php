     <?php 
       var_dump($_POST);


       
       for($i = 1; $i <= $cantidad; $i++){

        $idnota_total = $_POST['idnota'.$i];
        $nota_total = $_POST['nota'.$i];
        var_dump($idnota_total, $nota_total);

       
        }
      
