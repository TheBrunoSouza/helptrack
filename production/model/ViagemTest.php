<?php

/**
 * Created by PhpStorm.
 * User: Bruno Souza
 * Date: 10/05/2017
 * Time: 22:11
 */

include 'Viagem.php';
include 'ViagemDAO.php';

class ViagemTest extends PHPUnit\Framework\TestCase{

    protected $viagem;
    protected $viagemDAO;
    protected $retorno;

    /**
     * @test
     */
    public function novaViagem(){
        $this->viagem = new Viagem();

        $this->viagem->codigo_viagem = 1;
        $this->viagem->status = 1;
        $this->viagem->data_hora_prev_partida = 1;
        $this->viagem->data_hora_prev_chegada = 1;
        $this->viagem->local_ini = 1;
        $this->viagem->local_fim = 1;
        $this->viagem->descricao = 1;
        $this->viagem->veiculo = 1;

        $this->viagemDAO = new ViagemDAO();
        $this->retorno = $this->viagemDAO->insertViagem($this->viagem);

        $this->assertTrue($this->retorno);
    }
}

