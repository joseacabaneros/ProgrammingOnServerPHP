<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="img/favicon.png">
        <title>Notas PHP</title>
    </head>
    <body>
        <header>
            <h2>Sistema de información de notas de cursos - CONSULTAR NOTAS</h2>
            <h3>PHP</h3>
        </header>
        <a href="index.html">Atrás</a>
        <div>
            <?php
                //Con el propio include ya se cruzan los datos de los estuantes con las notas automaticamente
                include 'utilConsulta.php'; ?>
            <!--Formulario-->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <label>
                    ID estudiante: 
                    <input type="text" name="estudiante" placeholder="ID0050">
                </label>
                <label>
                    Curso: 
                    <input type="text" name="curso" placeholder="2014-15">
                </label>
                <label>
                    Asignatura: 
                    <input type="text" name="asignatura" placeholder="C1">
                </label>
                <input type="submit" value="Buscar" name="buscar">
            </form>
            <?php 
                if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST["buscar"]))):
                    $id_estudiante = $_POST['estudiante'];
                    $curso = $_POST['curso'];
                    $id_estudiantes = $_POST['asignatura'];
                  
                    if($id_estudiante != null):
                        filtrarId($id_estudiante);
                    elseif($curso != null):
                        filtrarCurso($curso);
                    elseif($id_estudiantes != null):
                        filtrarAsignatura($id_estudiantes);
                    else:
                        listadoEstudiantes();
                    endif;
                elseif($_SERVER['REQUEST_METHOD'] == 'GET'): 
                    listadoEstudiantes();
                else:
                    die("Sólo se admiten peticiones GET y POST");
                endif; ?>
        </div>
        <footer>
            <address>
                Programación Orientada a Objetos - Master en Ingeniería Web.<br>
                <a href="https://ingenieriainformatica.uniovi.es/">Escuela de Ingeniería Informática</a> - 
                <a href="http://www.uniovi.es/">Universidad de Oviedo</a>.<br>
                <a href="mailto:uo234549@uniovi.es">Jose Antonio Cabañeros Blanco</a>
            </address>
            <div>
                <p>
                    <a href="https://validator.w3.org/check/referer">
                        <img style="border:0;width:88px;height:31px"
                            src="img/w3chtml5.png"
                            alt="¡HTML Válido!" />
                    </a>
                </p>
                <p>
                    <a href="http://jigsaw.w3.org/css-validator/check/referer">
                        <img style="border:0;width:88px;height:31px"
                            src="http://jigsaw.w3.org/css-validator/images/vcss"
                            alt="¡CSS Válido!" />
                    </a>
                </p>
            </div>
        </footer>
    </body>
</html>