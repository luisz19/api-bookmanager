<?php

class Books {
    protected $id;
    protected $titulo;
    protected $autor;
    protected $genero;


    public function __construct($titulo, $autor, $genero) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->genero = $genero;
    

    }

    //GETTERS
    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getAutor(){
        return $this->autor;
    }


    public function getGenero(){
        return $this->genero;
    }


    //SETTERS
    public function setId($id){
        $this->id = $id;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function setAutor($autor){
        $this->autor = $autor;
    }


    public function setGenero($genero){
        $this->genero = $genero;
    }



}
