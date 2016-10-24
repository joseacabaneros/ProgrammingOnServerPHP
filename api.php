<?php
// API REST

    include 'php/utilConsulta.php';

    function getAlumno($id){
      return filtrarId($id);
    }

    function getAlumnos(){
      return listadoEstudiantes();
    }

    $possible_url = array("alumnos", "alumno");
    $value = "Ha ocurrido un error";

    if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
    {
      switch ($_GET["action"])
        {
          //http://156.35.98.12/ProgrammingOnServerPHP/api.php?action=alumnos  
          case "alumnos":
            $value = getAlumnos();
            break;
          //http://156.35.98.12/ProgrammingOnServerPHP/api.php?action=alumno&id=ID0050
          //http://156.35.98.12/ProgrammingOnServerPHP/api.php?action=alumno&id=ID0010
          case "alumno":
            if (isset($_GET["id"]))
              $value = getAlumno($_GET["id"]);
            else
              $value = "Necesario el argumento id";
            break;
        }
    }

    return json_encode($value);

?>