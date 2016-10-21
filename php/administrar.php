<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="img/favicon.png">
        <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto">
        <title>Notas PHP</title>
    </head>
    <body>
        <header>
            <a href="index.html" class="button"><span>Atrás</span></a>
            <h2>Sistema de información de notas de cursos - ADMINISTRAR</h2>
            <h3>PHP</h3>
        </header>
        <div class="padding">
            <!--Formulario de subida de ficheros-->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <label>
                    Seleccionar el archivo JSON con las notas:
                    <input type="file" name="fichero">
                </label><br/>
                <input type="submit" value="Subir JSON" name="subir">
            </form>
            <!--Formulario reset de ficheros-->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <label>
                    Eliminar todos los archivos JSON con las notas
                </label><br/>
                <input type="submit" value="RESET" name="reset">
            </form>
            <?php 
                if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST["subir"]))): 
                    include 'php/upload.php'; 
                elseif(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST["reset"]))): 
                    $files = glob('tmp/*'); 
                    foreach($files as $file){
                        if(is_file($file)){
                            unlink($file); //Borrar archivo
                        }
                    }
                    echo "<p class=\"info\">Se han eliminado todos los archivos JSON</p>";
                elseif(!($_SERVER['REQUEST_METHOD'] == 'GET')):
                    die("<p class=\"error\">Sólo se admiten peticiones GET y POST</p>");
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