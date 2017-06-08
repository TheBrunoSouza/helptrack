<?php

/**
 * Created by PhpStorm.
 * User: Bruno Souza
 * Date: 04/05/2017
 * Time: 20:42
 */
class Viagem{
    public $codigo_viagem;
    public $local_ini;
    public $local_fim;
    public $data_hora_prev_partida;
    public $data_hora_prev_chegada;
    public $descricao;
    public $veiculo;

    public function __construct(){}

    public function __set($propriedade, $valor){
        $this->$propriedade =  $valor;
    }

    public function __get($propriedade){
        return $this->$propriedade;
    }
}