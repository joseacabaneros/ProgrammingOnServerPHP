<?php

    include 'alumno.php';

    $personas = array();
    $num_personas;

    //CRUZAR LOS DATOS DE LOS ESTUDIANTES CON SUS NOTAS
    //Fichero de personas.json
    $file = file_get_contents('resources\personas.json');
    $personas_json = json_decode($file, true);

    foreach($personas_json as $key => $value){
        if(!is_array($value)){
            $num_personas = $value;
        }else
            foreach($value as $key => $val){
                $personas[] = new Persona($val["id"], $val["nombre"], $val["apellidos"], $val["genero"], $val["fechaNacimiento"]);
                //echo $per->__toString() . "<br/>";
            }
    }

    //Ficheros con las notas de los alumnos en cada asignatura, curso y convocatoria
    $files = glob('tmp/*');
    foreach($files as $fil)
        if(is_file($fil)){
            $file = file_get_contents($fil);
            $notas = json_decode($file, true);

            $id_asignatura = $notas["id"];
            $curso = $notas["curso"];
            $convocatoria = $notas["convocatoria"];

            foreach($notas as $key => $value)
                if(is_array($value))
                    foreach($value as $key => $val){
                        $nota = new Nota($id_asignatura, $curso, $convocatoria, $val["valor"]);
                        foreach($personas as $per)
                            if(strcmp($per->id, $val["id"]) === 0){
                                //Anadir nota al estudiante correspondiente
                                $per->addNota($nota);
                                break;
                            }
                    }
        }

    function numEstudiantes(){
        global $personas;
        $num_estudiantes = 0;
        foreach($personas as $per)
            foreach($per->notas as $not){
                $num_estudiantes++;
                break;
            }
        return $num_estudiantes;
    }

    function listadoEstudiantes(){
        global $num_personas;
        global $personas;
        $cabecera = true;
        
        //Imprimir listado de estudiante con sus correspondientes notas
        echo "<h1>Número total de estudiantes: " . numEstudiantes() . " (de las " . $num_personas .  " personas)</h1>";
        foreach($personas as $per){
            $primera = true;
            foreach($per->notas as $not){
                if($cabecera){
                    echo "<table><tr class=\"cab\"><th>ID</th><th>NOMBRE</th><th>APELLIDOS</th><th>GENERO</th><th>F.NACIMIENTO</th></tr>";
                    $cabecera = false;
                }
                if($primera){
                    echo $per->__toString();
                    echo "<tr class=\"cabnotas\"><th>-----</th><th>ASIGNATURA</th><th>CURSO</th><th>CONVOCATORIA</th><th>NOTA</th></tr>";
                    $primera = false;
                }
                echo $not->__toString();
            }
            if($primera === false)
                echo "<tr><th>.....</th><th>.....</th><th>.....</th><th>.....</th><th>.....</th></tr>";
        }
        echo "</table>";
    }

    function filtrarId($id_estudiante){
        global $personas;
        $alguno = false;
        
        foreach($personas as $per)
            if(strcmp($per->id, $id_estudiante) === 0){
                $primera = true;
                foreach($per->notas as $not){
                    if($primera){
                        echo "<h1>Estudiante con ID: " . $id_estudiante . "</h1>";
                        echo "<table><tr class=\"cab\"><th>ID</th><th>NOMBRE</th><th>APELLIDOS</th><th>GENERO</th><th>F.NACIMIENTO</th></tr>";
                        echo $per->__toString();
                        echo "<tr class=\"cabnotas\"><th>-----</th><th>ASIGNATURA</th><th>CURSO</th><th>CONVOCATORIA</th><th>NOTA</th></tr>";
                        $primera = false;
                    }
                    echo $not->__toString();
                    $alguno = true;
                }
                echo "</table>";
                break;
            }
                
        if($alguno === false)
            echo "<h1>No existe ningún ESTUDIANTE con el ID: " . $id_estudiante . "</h1>";  
    }

    function filtrarCurso($curso){
        global $personas;
        $alguno = false;
        $cabecera = true;
        
        foreach($personas as $per){
            $primera = true;
            foreach($per->notas as $not)
                if(strcmp($not->curso, $curso) === 0){
                    if($cabecera){
                        echo "<h1>Notas de los estudiantes del curso: " . $curso . "</h1>";
                        echo "<table><tr class=\"cab\"><th>ID</th><th>NOMBRE</th><th>APELLIDOS</th><th>GENERO</th><th>F.NACIMIENTO</th></tr>";
                        $cabecera = false;
                    }
                    if($primera){
                        echo $per->__toString();
                        echo "<tr class=\"cabnotas\"><th>-----</th><th>ASIGNATURA</th><th>CURSO</th><th>CONVOCATORIA</th><th>NOTA</th></tr>";
                        $primera = false;
                    }
                    echo $not->__toString();
                    $alguno = true;
                } 
            if($primera === false)
                echo "<tr><th>.....</th><th>.....</th><th>.....</th><th>.....</th><th>.....</th></tr>";
        }
        echo "</table>";
        
        if($alguno === false)
            echo "<h1>No existe ninguna nota del curso: " . $curso . "</h1>";
        
    }
    
    function filtrarAsignatura($id_asignatura){
        global $personas;
        $alguno = false;
        $cabecera = true;
        
        foreach($personas as $per){
            $primera = true;
            foreach($per->notas as $not)
                if(strcmp($not->id, $id_asignatura) === 0){
                    if($cabecera){
                        echo "<h1>Notas de los estudiantes de la asignatura: " . $id_asignatura . "</h1>";
                        echo "<table><tr class=\"cab\"><th>ID</th><th>NOMBRE</th><th>APELLIDOS</th><th>GENERO</th><th>F.NACIMIENTO</th></tr>";
                        $cabecera = false;
                    }
                    if($primera){
                        echo $per->__toString();
                        echo "<tr class=\"cabnotas\"><th></th><th>ASIGNATURA</th><th>CURSO</th><th>CONVOCATORIA</th><th>NOTA</th></tr>";
                        $primera = false;
                    }
                    echo $not->__toString();
                    $alguno = true;
                }
            if($primera === false)
                echo "<tr><th>.....</th><th>.....</th><th>.....</th><th>.....</th><th>.....</th></tr>";
        }
        echo "</table>";
        
        if($alguno === false)
            echo "<h1>No existe ninguna nota de la asignatura: " . $id_asignatura . "</h1>";
        
    }
   
?>