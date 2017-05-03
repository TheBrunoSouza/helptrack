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
          to_date('".$ini."', 'DD/MM/YYYY HH24:MI'),
          null,
          to_date('".$fim."', 'DD/MM/YYYY HH24:MI'),
          null,
          2,
          2
        )
    ";
    #echo 'SQL INSERT: '.$sqlInsertViagem; exit();

    $respostaInsertViagem = oci_parse($conexao, $sqlInsertViagem);

    if(!oci_execute($respostaInsertViagem)) {
        echo 'Erro ao inserir a viagem. SQL: ' . $sqlInsertViagem;
    }

    $sqlUpdateVeiculo = "
        UPDATE help_track_veiculo
        SET viagem = SEQ_HELP_TRACK_VIAGEM.currval
        WHERE codigo_veiculo = '".$codVeiculo."'
    ";
    #echo 'SQL UPDATE VEICULO: '.$sqlUpdateVeiculo; exit();

    $respostaUpdateVeiculo = oci_parse($conexao, $sqlUpdateVeiculo);

    if(!oci_execute($respostaUpdateVeiculo)) {
        echo 'Erro no update de VEICULO. SQL: ' . $sqlUpdateVeiculo;
    }

    oci_free_statement($respostaInsertViagem);
    oci_free_statement($respostaUpdateVeiculo);
    oci_close($conexao);
