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
            <h2>Sistema de información de notas de cursos - ADMINISTRAR</h2>
            <h3>PHP</h3>
        </header>
        <div>
            <!--Formulario de subida de ficheros-->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <label>
                    Seleccianar el archivo JSON con las notas:
                    <input type="file" name="fichero">
                </label>
                <input type="submit" value="Subir JSON" name="subir">
            </form>
            <!--Formulario reset de ficheros-->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <lable>
                    Eliminar todos los archivos JSON con las notas:
                    <input type="submit" value="RESET" name="reset">
                </lable>
            </form>
            <?php 
                if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST["subir"]))): 
                    include 'upload.php'; 
                elseif(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST["reset"]))): 
                    $files = glob('tmp/*'); 
                    foreach($files as $file){
                        if(is_file($file)){
                            unlink($file); //Borrar archivo
                        }
                    }
                    echo "Se han eliminado todos los archivos JSON";
                elseif(!($_SERVER['REQUEST_METHOD'] == 'GET')):
                    die("Sólo se admiten peticiones GET y POST.");
                endif; ?>
        </div>
        <a href="index.html">Atrás</a>
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