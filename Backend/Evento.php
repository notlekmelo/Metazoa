<?php
class Evento {
    private $nome, $desc, $data, $hora, $canil, $local;

    function __construct($nome, $desc, $data, $hora, $canil, $local){
        $this->nome = $nome;
        $this->desc = $desc;
        $this->data = $data;
        $this->hora = $hora;
        $this->local = $local;
        $this->canil = $canil;

    }

    function getNome(){
        return $this->nome;
    }
    function getDesc(){
        return $this->desc;
    }
    function getData(){
        return $this->data;
    }
    function getHora(){
        return $this->hora;
    }
    function getCanil(){
        return $this->canil;
    }
    function getLocal(){
        return $this->local;
    }
}
?>