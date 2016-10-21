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
            return "<tr></tr><tr><td>" . $this->id . "</td><td>" . $this->nombre . "</td><td>" . $this->apellidos . "</td><td>" . $this->genero . "</td><td>" . $this->nacimiento . "</td></tr>";
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
            return "<tr class=\"cabecera\"><td>-----</td><td>" . $this->id . "</td><td>" . $this->curso . "</td><td>" . $this->convocatoria . "</td><td>" . $this->valor . "</td></tr>";
        }
    }
?>