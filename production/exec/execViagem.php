<?php

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo           = new OracleCielo ();
    $conexao            = $oraCielo->getCon();
    $descricaoViagem    = $_REQUEST['descricaoViagem'];
    $codVeiculo         = $_REQUEST['codVeiculo'];
    $codReferenciaIni   = $_REQUEST['codReferenciaIni'];
    $codReferenciaFim   = $_REQUEST['codReferenciaFim'];
    $previsao           = $_REQUEST['previsao'];

    list($ini, $fim) = explode(' - ', $previsao);

    //Tratamento do periodo inicial
    list($diaIni, $horaIni, $AMPMIni) = explode(' ', $ini);
    if($AMPMIni == 'PM'){
        list($horaAux, $minAux) = explode(':', $horaIni);
        if($horaAux == '01'){
            $horaAux = '13';
        }
        if($horaAux == '02'){
            $horaAux = '14';
        }
        if($horaAux == '03'){
            $horaAux = '15';
        }
        if($horaAux == '04'){
            $horaAux = '16';
        }
        if($horaAux == '05'){
            $horaAux = '17';
        }
        if($horaAux == '06'){
            $horaAux = '18';
        }
        if($horaAux == '07'){
            $horaAux = '19';
        }
        if($horaAux == '08'){
            $horaAux = '20';
        }
        if($horaAux == '09'){
            $horaAux = '21';
        }
        if($horaAux == '10'){
            $horaAux = '22';
        }
        if($horaAux == '11'){
            $horaAux = '23';
        }
        $prevIni = $horaAux.':'.$minAux;
    }else{
        $prevIni = $horaIni;
    }

    $horaAux    = '';
    $minAux     = '';

    //Tratamento do periodo final
    list($diaFim, $horaFim, $AMPMFim) = explode(' ', $fim);
    if($AMPMFim == 'PM'){

        list($horaAux, $minAux) = explode(':', $horaFim);

        if($horaAux == '01'){
            $horaAux = '13';
        }
        if($horaAux == '02'){
            $horaAux = '14';
        }
        if($horaAux == '03'){
            $horaAux = '15';
        }
        if($horaAux == '04'){
            $horaAux = '16';
        }
        if($horaAux == '05'){
            $horaAux = '17';
        }
        if($horaAux == '06'){
            $horaAux = '18';
        }
        if($horaAux == '07'){
            $horaAux = '19';
        }
        if($horaAux == '08'){
            $horaAux = '20';
        }
        if($horaAux == '09'){
            $horaAux = '21';
        }
        if($horaAux == '10'){
            $horaAux = '22';
        }
        if($horaAux == '11'){
            $horaAux = '23';
        }
        $prevFim = $horaAux.':'.$minAux;
    }else{
        $prevFim = $horaFim;
    }

    //Insert viagem
    $sqlInsertViagem = "
        INSERT INTO help_track_viagem(
          codigo_viagem,
          local_ini,
          local_fim,
          data_hora_prev_partida,
          data_hora_partida,
          data_hora_prev_chegada,
          data_hora_chegada,
          status,
          situacao
        ) VALUES (
          SEQ_HELP_TRACK_VIAGEM.nextval,
          '".$codReferenciaIni."',
          '".$codReferenciaFim."',
          to_date('".$diaIni." ".$prevIni."', 'DD/MM/YYYY HH24:MI'),
          null,
          to_date('".$diaFim." ".$prevFim."', 'DD/MM/YYYY HH24:MI'),
          null,
          2,
          2
        )
    ";
    echo 'SQL INSERT: '.$sqlInsertViagem; exit();

    $respostaInsertViagem = oci_parse($conexao, $sqlInsertViagem);

    if(!oci_execute($respostaInsertViagem)) {
        echo 'Erro ao inserir a viagem. SQL: ' . $sqlInsertViagem;
    }

    oci_free_statement($respostaInsertViagem);
    oci_close($conexao);

?>
