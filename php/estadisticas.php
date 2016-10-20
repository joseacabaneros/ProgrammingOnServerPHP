<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="img/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script>
        <script type="text/javascript" src="js/proteic.min.js"></script>
        <title>Notas PHP</title>
    </head>
    <body>
        <header>
            <h2>Sistema de información de notas de cursos - ESTADISTICAS</h2>
            <h3>PHP</h3>
        </header>
        <div>
            <?php 
                include 'utilEstadisticas.php';
            
                $genero = estudiantesPorGenero();
                $media_genero = mediaNotasPorGenero();
                $por_convocatoria_1 = porConvocatoria(1);
                $por_convocatoria_2 = porConvocatoria(2);
                $por_convocatoria_3 = porConvocatoria(3);
                $asignaturas = asignaturas();  
                $fechas_nota = porFechaNacimiento();
            ?>
            
            <div id='gauge-nota-media'></div>
            <div id='barchar-por-genero'></div>
            <div id='barchar-genero-nota-media'></div>
            <div id='barchar-por-convocatoria-apro-susp'></div>
            <div id='linearchar-por-convocatoria-porc'></div>
            <div id='linearchar-anyo-notamedia'></div>
            
            <script type="text/javascript">
                
                //GAUGE DE LA NOTA MEDIA DE TODOS LOS ESTUDIANTES
                var data = [{x: <?php echo mediaNotas();?>}];
                gauge = new proteic.Gauge(data, {
                    label: "Nota media",
                    selector: '#gauge-nota-media',
                    minLevel: 0,
                    maxLevel: 10,
                    ticks: 10
                });
                gauge.draw();
                            
                    
                //BARCHAR CON EL NUMERO DE ESTUDIANTES POR GENERO
                data = [
                    {x: 'Género', key: 'Hombres', y: <?php echo $genero[0];?>},
                    {x: 'Género', key: 'Mujeres', y: <?php echo $genero[1];?>}
                ];
                var barchart = new proteic.Barchart(data, {
                    selector: '#barchar-por-genero',
                    yAxisLabel: 'Estudiantes'
                });
                barchart.draw();
                
                
                //BARCHAR CON LA MEDIA DE NOTAS POR GENERO
                data = [
                    {x: 'Género', key: 'Hombres', y: <?php echo $media_genero[0];?>},
                    {x: 'Género', key: 'Mujeres', y: <?php echo $media_genero[1];?>}
                ];
                var barchartGrouped = new proteic.Barchart(data, {
                    selector: '#barchar-genero-nota-media',
                    stacked: false,
                    yAxisLabel: 'Nota Media'
                });
                barchartGrouped.draw();
                
                
                //BARCHAR DE APROBADOS Y SUSPENSOS POR CONVOCATORIA 
                data = [
                    {x: '1ª', key: 'Aprobados', y: <?php echo $por_convocatoria_1[1];?>},
                    {x: '1ª', key: 'Suspensos', y: <?php echo $por_convocatoria_1[0];?>},
                    {x: '2ª', key: 'Aprobados', y: <?php echo $por_convocatoria_2[1];?>},
                    {x: '2ª', key: 'Suspensos', y: <?php echo $por_convocatoria_2[0];?>},
                    {x: '3ª', key: 'Aprobados', y: <?php echo $por_convocatoria_3[1];?>},
                    {x: '3ª', key: 'Suspensos', y: <?php echo $por_convocatoria_3[0];?>}
                ];
                var barchartGrouped = new proteic.Barchart(data, {
                    selector: '#barchar-por-convocatoria-apro-susp',
                    stacked: false,
                    yAxisLabel: 'Estudiantes',
                    xAxisLabel: 'Convocatoria'
                });
                barchartGrouped.draw();
                
                
                //LINEARCHAR PORCENTAJE DE APROBADOS RESPECTO POR CONVOCATORIA Y POR ASIGNATURA
                var dataArea = [];
                <?php 
                    foreach($asignaturas as $a){
                        echo "dataArea.push({key:\"" . $a . "\", x:1, y:" . porcentajeAprobadosporConvocatoriaAsignatura(1, $a) . "});";
                        echo "dataArea.push({key:\"" . $a . "\", x:2, y:" . porcentajeAprobadosporConvocatoriaAsignatura(2, $a) . "});";
                        echo "dataArea.push({key:\"" . $a . "\", x:3, y:" . porcentajeAprobadosporConvocatoriaAsignatura(3, $a) . "});";
                    }
                ?>
                areaLinechart = new proteic.Linechart(dataArea, {
                    selector: '#linearchar-por-convocatoria-porc',
                    yAxisLabel: 'Aprobados (%)',
                    xAxisLabel: 'Convocatoria',
                    area: true,
                    width: '90%',
                    height: 400,
                    onHover: (d) => console.log('hovering', d),
                    onLeave: (d) => console.log('leaving', d),
                });
                areaLinechart.draw();
                
                
                //LINEARCHAR NOTA MEDIA POR AÑO DE NACIMIENTO DE LOS ESTUDIANTES
                var temporalData = []
                <?php 
                    foreach($fechas_nota as $f){
                        echo "temporalData.push({key: \"Año nacimiento/Nota media\" , x:" . $f[0] .", y:" . $f[1] . "});";
                    }
                ?>
                temporalLinechart = new proteic.Linechart(temporalData, {
                    xAxisType: 'time',
                    xAxisFormat: '%y',
                    selector: '#linearchar-anyo-notamedia',
                    width: '90%',
                    areaOpacity: 0, // No area
                    xAxisLabel: 'Año de Nacimiento',
                    yAxisLabel: 'Nota Media',
                    onHover: (d) => console.log('hovering', d),
                    onLeave: (d) => console.log('leaving', d),
                });
                temporalLinechart.draw();
            </script>
            
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