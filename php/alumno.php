<?php
    class Persona{
        public $id, $nombre, $apellidos, $genero, $nacimiento, $notas = array();
        
        function Persona($id, $nombre, $apellidos, $genero, $nacimiento){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->genero = ($genero == 1) ? "Hombre" : "Mujer";
            $this->nacimiento = $nacimiento;
        }
        
        function addNota($nota){
            $this->notas[] = $nota;
        }
        
        function __toString(){
            $ret = $this->id . " --> " .$this->nombre . " " . $this->apellidos . " (" . $this->genero . ") - " . $this->nacimiento . "<br/>";
            
            foreach($this->notas as $nota)
                $ret = $ret . " /// " . $nota->__toString();
            
            return $ret;
        }
    }

    class Nota{
        public $id, $curso, $convocatoria, $valor;
        
        function Nota($id, $curso, $convocatoria, $valor){
            $this->id = $id;
            $this->curso = $curso;
            $this->convocatoria = $convocatoria;
            $this->valor = $valor;
        }
        
        function __toString(){
            return "asignatura: " . $this->id . ", curso: " . $this->curso . ", convocatoria: " . $this->convocatoria . ", nota: " . $this->valor . "<br/>"; 
        }
    }
?>