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
        $guardar = mysqli_query($conexion, $sql);
        //lo hacemos array vacio para ver si me viene con algo o no
        $resultado= array();
        
        if ($guardar == true) {
            $resultado = $guardar;
        
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
            $sql = "select id, nombre, apellido, FORMAT(cedula, 0, 'es_ES') as cedula, edad from alumno where id not in (select id_alumno from cursando);";
            $guardar = mysqli_query($conexion, $sql);

            $resultado = array();

            if ($guardar && mysqli_num_rows($guardar) >=1) {
                $resultado = $guardar;
            }else{
                
            }

            return $resultado;
        }
            //listado de todos los estudiantes
        function ConseguirTodosEstudiantes($conexion, $codigo = null, $periodo){
            //vincular 3 tablas: primero vincular las primeras dos con el inner join y luego la 2 y la 3 vincularla con otro inner join
            $resultado = array();
          
            $sql = "SELECT c.id_ano,c.id_cu, an.ano, s.seccion, a.nombre, FORMAT(a.cedula, 0, 'es_ES') as cedula, a.apellido, p.periodo, c.id_alumno from cursando c left join ano an on c.id_ano = an.id left join seccion s on an.id_seccion = s.id inner join alumno a on c.id_alumno = a.id inner join periodo p on c.id_periodo = p.id where c.id_periodo = '$periodo'";
            if (!empty($codigo)) {
                $sql .=" and an.id = $codigo order by an.id";
            }else {
                $sql .=" order by an.id";
            }
            
            
            
            $guardar = mysqli_query($conexion, $sql);
            
            
            if (mysqli_num_rows($guardar) >= 1) {
                $resultado = $guardar;
            }
            return $resultado;
        }
       
       
        //buscador de estudiante
        function buscador($conexion, $buscar = null, $periodo){
            $resultado = array();

                if (preg_match('/^[a-zA-Z]+$/', $buscar)) {
                    $sql = "SELECT c.id_ano, c.id_cu, an.ano, s.seccion, a.nombre,a.cedula, a.apellido, p.periodo, c.id_alumno  from cursando c left join ano an on c.id_ano = an.id left join seccion s on an.id_seccion = s.id inner join alumno a on c.id_alumno = a.id inner join periodo p on c.id_periodo = p.id  WHERE c.id_periodo = '$periodo' and a.nombre LIKE '%$buscar%' or a.apellido LIKE '%$buscar';";
                    $guardar = mysqli_query($conexion, $sql);
    
                        if ($guardar == true && mysqli_num_rows($guardar) >= 1) {
                            $resultado = $guardar;
                        }else{
                            $_SESSION['busqueda']['error'] = 'No se ha encontrado ningun estudiante con esas caracteristicas ';
                        }
                }elseif (preg_match('/^[0-9]+$/',$buscar)) {
                    $sql = "SELECT c.id_ano, c.id_cu, an.ano, s.seccion, a.nombre,a.cedula, a.apellido, p.periodo, c.id_alumno  from cursando c left join ano an on c.id_ano = an.id left join seccion s on an.id_seccion = s.id inner join alumno a on c.id_alumno = a.id  inner join periodo p on c.id_periodo = p.id WHERE c.id_periodo = '$periodo' and a.cedula  like '%$buscar%'";
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

       

        function existeNota($db, $id_alumno, $id_pensum, $lapso){
            $sql = "select * from notas where id_pensum = '$id_pensum' and id_alumno = '$id_alumno' and lapso = $lapso";
            $guardar = mysqli_query($db, $sql);
            $resultado = array();
            //si devuelve una fila significa que la nota ya es
            if ($guardar == true && mysqli_num_rows($guardar) > 0) {
                $resultado = $guardar;
            }
            return $resultado;
        }

        function ConseguirNotas($conexion, $id_alumno, $pensum){
            $sql = "select n.nota, avg(n.nota) as promedio, n.lapso from notas n inner join pensum p on p.id = n.id_pensum inner join materia m on p.id_materia = m.id where n.id_alumno = $id_alumno and n.id_pensum = $pensum group by n.lapso, n.id_pensum";
            $guardar = mysqli_query($conexion, $sql);
            $resultado = array();
            


            if ($guardar == true && mysqli_num_rows($guardar) > 0) {
                $resultado = $guardar;
                
            }else{
                echo "no hay notas de este estudiante";
            }

            return $resultado;
        }
        function traermaterias($conexion, $ano){
            $sql = "select p.id, p.id_materia, m.materia from pensum p inner join materia m on m.id = p.id_materia where id_ano = $ano";
            $guardar = mysqli_query($conexion, $sql);
            $resultado = array();
            if ($guardar == true) {
                $resultado = $guardar;
            }
            return $resultado;
        }

        function traerUsuarios($conexion, $usuario_id = null){
            $sql = "select u.*, c.id_rol, c.rol from usuarios u inner join cargo c on u.id_rol = c.id_rol";
            $resultado = array();

            if ($usuario_id != null) {
                $sql .= " where u.id = $usuario_id";
            }
            $guardar = mysqli_query($conexion, $sql);

            if ($guardar == true) {
                $resultado = $guardar;
            }
            return $resultado;
        }
        
        function TraerPromedios($conexion, $id_alumno = null){
            if ($id_alumno != null) {
            $sql = "SELECT n.id_pensum, n.lapso, m.materia, AVG(n.nota) AS nota_final FROM notas n INNER JOIN pensum p ON n.id_pensum = p.id INNER JOIN materia m on m.id = p.id_materia  WHERE n.id_alumno = $id_alumno  GROUP BY n.id_pensum, n.lapso ORDER BY n.lapso, m.id ASC;"; 
            $guardar = mysqli_query($conexion, $sql);
            $resultado = array();
            }else{
                $sql = "select n.id_pensum, n.lapso, avg(promedio) from(select avg(notas) as promedio from notas);";
            }
            


            $guardar = mysqli_query($conexion, $sql);
            if ($guardar == true) {
                $resultado = $guardar;
            }
            return $resultado;
        }
       
       
        
?>




