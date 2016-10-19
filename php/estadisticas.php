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
            <h2>Sistema de información de notas de cursos - ESTADISTICAS</h2>
            <h3>PHP</h3>
        </header>
        <div>
            <?php 
                include 'utilConsulta.php';
                $media_nota = 0;
                $num_elementos = 0;
                foreach($personas as $per)
                    foreach($per->notas as $not)
                        if(is_numeric($not->valor)){
                            $media_nota = $media_nota + $not->valor;
                            $num_elementos++;
                        }
                
                echo "<p> Media de todas las notas: " . ($media_nota/$num_elementos);

            ?>
            
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