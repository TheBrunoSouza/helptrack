<?php

/**
 * Created by PhpStorm.
 * User: Bruno Souza
 * Date: 17/05/2017
 * Time: 20:51
 */

class viagemDAO{

    protected $arrayViagem = array();
    protected $retorno = true;

    public function __construct() {}

    public function insertViagem($viagem){

        $this->arrayViagem['codigo_viagem'] = (is_numeric($viagem->codigo_viagem) == true)?true:false;
        $this->arrayViagem['status'] = (is_numeric($viagem->status) == true)?true:false;
        $this->arrayViagem['data_hora_prev_partida'] = (is_string($viagem->data_hora_prev_partida) == true?true:false);
        $this->arrayViagem['data_hora_prev_chegada'] = (is_string($viagem->data_hora_prev_chegada) == true?true:false);
        $this->arrayViagem['local_ini'] = (is_string($viagem->local_ini) == true?true:false);
        $this->arrayViagem['local_fim'] = (is_string($viagem->local_fim) == true?true:false);
        $this->arrayViagem['descricao'] = (is_string($viagem->descricao) == true?true:false);
        $this->arrayViagem['veiculo'] = (is_string($viagem->veiculo) == true?true:false);

        if(is_array($this->arrayViagem) == true){
            if (in_array(false, $this->arrayViagem)) {
                $this->retorno = false;
            }
        }else{
            $this->retorno = false;
        }

        return $this->retorno;
    }
}