<?php 
//Conseguir el año de cada seccion 
function conseguirAno($conexion, $ero = null, $do = null, $tro= null, $to = null, $qnto = null, $sexto = null){
    if(isset($ero) && $ero != null){
    $sql = "SELECT a.*, s.seccion FROM ano a  inner join seccion s on a.id_seccion=s.id  ORDER by a.id asc  limit 3 ";
    $ano = mysqli_query($conexion, $sql);
    $resultado= array();
    
    }elseif(isset($do) && $do != null){
        $sql = "SELECT a.*, s.seccion FROM ano a  inner join seccion s on a.id_seccion=s.id where a.id > 3 ORDER by a.id asc  limit 3 ";
        $ano = mysqli_query($conexion, $sql);
        $resultado= array();
        }elseif (isset($tro) && $tro != null) {
            $sql = "SELECT a.*, s.seccion FROM ano a  inner join seccion s on a.id_seccion=s.id where a.id > 6 ORDER by a.id asc  limit 3 ";
            $ano = mysqli_query($conexion, $sql);
            $resultado= array();
            }elseif (isset($to) && $to != null) {
                $sql = "SELECT a.*, s.seccion FROM ano a  left join seccion s on a.id_seccion=s.id where a.id > 9 ORDER by a.id asc  limit 3 ";
                $ano = mysqli_query($conexion, $sql);
                $resultado= array();
                }elseif (isset($qnto) && $qnto != null) {
                    $sql = "SELECT a.*, s.seccion FROM ano a  left join seccion s on a.id_seccion=s.id where a.id > 12 ORDER by a.id asc  limit 3 ";
                    $ano = mysqli_query($conexion, $sql);
                    $resultado= array();
                    }elseif (isset($sexto) && $sexto != null) {
                        $sql = "SELECT a.*, s.seccion FROM ano a  left join seccion s on a.id_seccion=s.id where a.id > 15 ORDER by a.id asc  limit 3 ";
                        $ano = mysqli_query($conexion, $sql);
                        $resultado= array();
                    }  

    if ($ano && mysqli_num_rows($ano)>=1) {
        $resultado = $ano;
    
    }else{
        echo 'error';
    }
    
    return $resultado;
    }
//Conseguir los años de los estudiantes
    function conseguirAnos($conexion){
        $sql = "select a.ano, a.id, s.seccion from ano a left join seccion s on s.id = a.id_seccion";
        $anos = mysqli_query($conexion, $sql);
        //lo hacemos array vacio para ver si me viene con algo o no
        $resultado= array();
        
        if ($anos == true && mysqli_num_rows($anos)>=1) {
            $resultado = $anos;
        
        }else{
            echo 'error';
        }
        
        return $resultado;
        }

        

        //borrar las alertas
        function borrarErrores(){
            if (isset($_SESSION['alerta'])) {
                $_SESSION['alerta'] = null;
                unset($_SESSION['alerta']);
            }
            if (isset($_SESSION['alertas'])) {
                $_SESSION['alertas'] = null;
                unset($_SESSION['alertas']);
            }
            if (isset($_SESSION['Usuario'])) {
                $_SESSION['Usuario'] = null;
                unset($_SESSION['Usuario']);
            }
            if (isset($_SESSION['eliminado'])) {
                $_SESSION['eliminado'] = null;
                unset($_SESSION['eliminado']);
            }
            if (isset($_SESSION['guardado'])) {
                $_SESSION['guardado'] = null;
                unset($_SESSION['guardado']);
            }
            if (isset($_SESSION['busqueda'])) {
                $_SESSION['busqueda'] = null;
                unset($_SESSION['busqueda']);
            }
        }
        //mostrar las alertas
        function mostrarErrores($session, $campo){
           $alerta = '';
            if (isset($session[$campo]) && !empty($campo)) {
                $alerta = "<div class= 'alerta alerta-error'>".$session[$campo].'</div>';
            }
            return $alerta;
        }

        
        function noconseguirEstudiantes($conexion){
            $sql = "select * from alumno where id not in (select id_alumno from cursando);";
            $guardar = mysqli_query($conexion, $sql);

            $resultado = array();

            if ($guardar && mysqli_num_rows($guardar) >=1) {
                $resultado = $guardar;
            }else{
                
            }

            return $resultado;
        }
            //listado de todos los estudiantes
        function ConseguirTodosEstudiantes($conexion, $codigo = null){
            //vincular 3 tablas: primero vincular las primeras dos con el inner join y luego la 2 y la 3 vincularla con otro inner join
            $resultado = array();
          
            $sql = "SELECT c.id_cu, an.ano, s.seccion, a.nombre,a.cedula, a.apellido, c.periodo, c.id_alumno from cursando c left join ano an on c.id_ano = an.id left join seccion s on an.id_seccion = s.id inner join alumno a on c.id_alumno = a.id ";
            if (!empty($codigo)) {
                $sql .=" where an.id = $codigo order by an.id";
            }else {
                $sql .=" order by an.id";
            }
            
            
            
            $guardar = mysqli_query($conexion, $sql);
            
            
            if (mysqli_num_rows($guardar) >= 1) {
                $resultado = $guardar;
            }
            return $resultado;
        }
       
        //conseguir a los alumnos
        function conseguirAlumno($conexion){
            $sql = "SELECT a.id, a.nombre, a.apellido, a.cedula, n.nota from alumno a left join notas n on a.id = n.id_alumno where n.nota = is null ";
            $guardar = mysqli_query($conexion, $sql);
            $resultado = array();
            if ($guardar && mysqli_num_rows($guardar) >= 1) {
                $resultado = $guardar;
            }
            
            return $resultado;

        }
        //buscador de estudiante
        function buscador($conexion, $buscar = null){
            $resultado = array();

                if (preg_match('/^[a-zA-Z]+$/', $buscar)) {
                    $sql = "SELECT c.id_cu, an.ano, s.seccion, a.nombre,a.cedula, a.apellido, c.periodo, c.id_alumno  from cursando c left join ano an on c.id_ano = an.id left join seccion s on an.id_seccion = s.id inner join alumno a on c.id_alumno = a.id  WHERE a.nombre LIKE '$buscar%' or a.apellido LIKE '%$buscar%';";
                    $guardar = mysqli_query($conexion, $sql);
    
                        if ($guardar == true && mysqli_num_rows($guardar) >= 1) {
                            $resultado = $guardar;
                        }else{
                            $_SESSION['busqueda']['error'] = 'No se ha encontrado ningun estudiante con esas caracteristicas ';
                        }
                }elseif (preg_match('/^[0-9]+$/',$buscar)) {
                    $sql = "SELECT c.id_cu, an.ano, s.seccion, a.nombre,a.cedula, a.apellido, c.periodo, c.id_alumno  from cursando c left join ano an on c.id_ano = an.id left join seccion s on an.id_seccion = s.id inner join alumno a on c.id_alumno = a.id  WHERE a.cedula  like '%$buscar%'";
                    $guardar = mysqli_query($conexion, $sql);
                        if ($guardar == true && mysqli_num_rows($guardar) >= 1) {
                            $resultado = $guardar;
                        }else{
                            $_SESSION['busqueda']['error'] = 'No se ha encontrado ningun estudiante con esas caracteristicas';
                        }
    
                }else{
                    $_SESSION['busqueda']['error'] = 'La Busqueda debe estar identificada por Nombre O Apellido O Cedula';
                }
                return $resultado;

        }

       

        function existeNota($db, $id_alumno, $id_pensum){
            $sql = "select * from notas where id_pensum = '$id_pensum' and id_alumno = '$id_alumno'";
            $guardar = mysqli_query($db, $sql);
            $resultado = array();
            //si devuelve una fila significa que la nota ya es
            if ($guardar == true && mysqli_num_rows($guardar) > 0) {
                $resultado = $guardar;
            }
            return $resultado;
        }
        
       
        
?>




