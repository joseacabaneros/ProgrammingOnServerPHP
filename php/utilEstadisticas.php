<?php
    include 'utilConsulta.php';

    function mediaNotas(){
        $media_nota = 0;
        $num_elementos = 0;
        global $personas;
        
        foreach($personas as $per)
            foreach($per->notas as $not)
                if(is_numeric($not->valor)){
                    $media_nota += $not->valor;
                    $num_elementos++;
                }
        if($num_elementos == 0)
            return 0;
        return round($media_nota/$num_elementos, 3);
    }

    function estudiantesPorGenero(){
        //Primera posicion HOMBRES
        $genero[] = 0;
        //Segunda posicion MUJERES
        $genero[] = 0;
        global $personas;
        
        foreach($personas as $per){
            if($per->genero === "Hombre")
                $genero[0]++;
            else
                $genero[1]++;
        }
        
        return $genero;
    }

    function mediaNotasPorGenero(){
        $media_nota_hombres = 0;
        $hombres = 0;
        $media_nota_mujeres = 0;
        $mujeres = 0;
        global $personas;
        
        foreach($personas as $per)
            foreach($per->notas as $not)
                if(is_numeric($not->valor)){
                    if($per->genero === "Hombre"){
                        $media_nota_hombres += $not->valor;
                        $hombres++;
                    }else{
                        $media_nota_mujeres += $not->valor;
                        $mujeres++;
                    }
                }
        //Primera posicion media HOMBRES
        if($hombres == 0)
            $genero[] = 0;
        else
            $genero[] = round($media_nota_hombres/$hombres, 3);
        //Segunda posicion media MUJERES
        if($mujeres == 0)
            $genero[] = 0;
        else
            $genero[] = round($media_nota_mujeres/$mujeres, 3);
        return $genero;
    }

    function porConvocatoria($conv){
        //Primera posicion SUSPENSOS
        $convocatoria[] = 0;
        //Segunda posicion APROBADOS
        $convocatoria[] = 0;
        global $personas;
        
        foreach($personas as $per)
            foreach($per->notas as $not)
                if(($not->convocatoria === $conv) && (is_numeric($not->valor))){
                    $convocatoria[0]++;
                    if($not->valor > 5)
                        $convocatoria[1]++;
                }
        
        $convocatoria[0] = $convocatoria[0] - $convocatoria[1];
        return $convocatoria;
    }

    function asignaturas(){
        $asignaturas = array();
        $controlador = true;
        global $personas;
        
        foreach($personas as $per)
            foreach($per->notas as $not){
                $controlador = true;
                foreach($asignaturas as $s)
                    if($not->id === $s)
                        $controlador = false;
                if($controlador)
                    $asignaturas[] = $not->id;
            }
        
        return $asignaturas;
    }

    function porcentajeAprobadosporConvocatoriaAsignatura($conv, $id_asig){
        $aprobados = 0;
        $suspensos = 0;
        global $personas;
        
        foreach($personas as $per)
            foreach($per->notas as $not)
                if(($not->convocatoria === $conv) && ($not->id === $id_asig) && (is_numeric($not->valor))){
                    if($not->valor > 5)
                        $aprobados++;
                    else
                        $suspensos++;
                }
        if($aprobados+$suspensos === 0)
            return 0;
        return round(($aprobados/($aprobados+$suspensos))*100);
    }

    function porFechaNacimiento(){
        $fechas = array();
        $controlador = true;
        $total = array();
        $ret = array();
        global $personas;
        
        //Anyos de nacimientos ordenados
        foreach($personas as $per){
            $controlador = true;
            $y = date('y',strtotime($per->nacimiento));
            foreach($fechas as $f)
                if($y === $f)
                    $controlador = false;
            if($controlador)
                $fechas[] = $y;
        }
        asort($fechas);
        
        foreach($fechas as $fech)
            $ret[] = notaMediaAnyo($fech);
        
        return $ret;
    }
                
    function notaMediaAnyo($anyo){
        $anyo_nota[] = $anyo;
        $elementos = 0;
        $notas = 0;
        global $personas;
        
        foreach($personas as $per){
            $y = date('y',strtotime($per->nacimiento));
            if($anyo === $y)
                foreach($per->notas as $not)
                    if(is_numeric($not->valor)){
                        $elementos++;
                        $notas += $not->valor;
                    }
        }
        
        if($elementos === 0)
            $anyo_nota[] = 0;
        else
            $anyo_nota[] = round(($notas/$elementos), 2);
        
        return $anyo_nota;
    }
?>