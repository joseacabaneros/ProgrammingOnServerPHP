<?php

    include 'alumno.php';

    $personas = array();
    $num_personas;

    //CRUZAR LOS DATOS DE LOS ESTUDIANTES CON SUS NOTAS
    //Fichero de personas.json
    $file = file_get_contents('..\personas.json');
    $personas_json = json_decode($file, true);

    foreach($personas_json as $key => $value){
        if(!is_array($value)){
            $num_personas = $value;
        }else{
            foreach($value as $key => $val){
                $personas[] = new Persona($val["id"], $val["nombre"], $val["apellidos"], $val["genero"], $val["fechaNacimiento"]);
                //echo $per->__toString() . "<br/>";
            }
        }
    }

    //Ficheros con las notas de los alumnos en cada asignatura, curso y convocatoria
    $files = glob('tmp/*');
    foreach($files as $fil){
        if(is_file($fil)){
            $file = file_get_contents($fil);
            $notas = json_decode($file, true);

            $id_asignatura = $notas["id"];
            $curso = $notas["curso"];
            $convocatoria = $notas["convocatoria"];

            foreach($notas as $key => $value){
                if(is_array($value)){
                    foreach($value as $key => $val){
                        $nota = new Nota($id_asignatura, $curso, $convocatoria, $val["valor"]);
                        foreach($personas as $per){
                            if(strcmp($per->id, $val["id"]) === 0){
                                //Anadir nota al estudiante correspondiente
                                $per->addNota($nota);
                                break;
                            }
                        }
                    }
                }
            }
        }
    }

    function listadoEstudiantes(){
        global $num_personas;
        global $personas;
        
        //Imprimir listado de estudiante con sus correspondientes notas
        echo "<h1>Número total de estudiantes: " . $num_personas . "</h1>";
        foreach($personas as $alumno)
            echo $alumno->__toString();
    }

    function filtrarId($id_estudiante){
        global $personas;
        $alguno = false;
        
        echo "<h2>Estudiante con ID: " . $id_estudiante . "</h2>";
        foreach($personas as $per)
            if(strcmp($per->id, $id_estudiante) === 0){
                echo $per->__toString();
                $alguno = true;
                break;
            }
        
        if($alguno === false)
            echo "NIGUN ESTUDIANTE QUE MOSTRAR";
        
    }

    function filtrarCurso($curso){
        global $personas;
        $alguno = false;
        
        echo "<h2>Notas de los estudiantes del curso: " . $curso . "</h2>";
        foreach($personas as $per){
            $primera = true;
            foreach($per->notas as $not)
                if(strcmp($not->curso, $curso) === 0){
                    if($primera){
                        echo "(" . $per->id . ") " . $per->nombre . " " . $per->apellidos . "<br/>///" . $not->__toString();
                        $primera = false;
                    }else
                        echo "///" . $not->__toString();
                    $alguno = true;
                }
        }
        
        if($alguno === false)
            echo "NIGUN ESTUDIANTE QUE MOSTRAR";
        
    }
    
    function filtrarAsignatura($id_asignatura){
        global $personas;
        $alguno = false;
        
        echo "<h2>Notas de los estudiantes de la asignatura: " . $id_asignatura . "</h2>";
        foreach($personas as $per){
            $primera = true;
            foreach($per->notas as $not)
                if(strcmp($not->id, $id_asignatura) === 0){
                    if($primera){
                        echo "(" . $per->id . ") " . $per->nombre . " " . $per->apellidos . "<br/>///" . $not->__toString();
                        $primera = false;
                    }else
                        echo "///" . $not->__toString();
                    $alguno = true;
                }
        }
        
        if($alguno === false)
            echo "NIGUN ESTUDIANTE QUE MOSTRAR";
        
    }
   
?>