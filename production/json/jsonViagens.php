<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlViagens = "
        SELECT 
              viagem.codigo_viagem,
              viagem.descricao,
              (SELECT DESCRICAO FROM HELP_TRACK_REFERENCIA WHERE codigo_referencia = local_ini) as local_ini,
              (SELECT DESCRICAO FROM HELP_TRACK_REFERENCIA WHERE codigo_referencia = local_fim) as local_fim,
              to_char(viagem.data_hora_prev_partida, 'DD/MM/YYYY HH24:MI') as prev_partida,
              to_char(viagem.data_hora_partida, 'DD/MM/YYYY HH24:MI') partida,
              to_char(viagem.data_hora_prev_chegada, 'DD/MM/YYYY HH24:MI') prev_chegada,
              to_char(viagem.data_hora_chegada, 'DD/MM/YYYY HH24:MI') chegada,
              status_viagem.descricao as status,
              status_viagem.codigo_status_viagem,
              situacao_viagem.descricao as situacao,
              situacao_viagem.codigo_situacao_viagem,
              veiculo.placa
        FROM 
            help_track_viagem viagem, 
            help_track_veiculo veiculo, 
            HELP_TRACK_SITUACAO_VIAGEM situacao_viagem, 
            HELP_TRACK_STATUS_VIAGEM status_viagem
        WHERE 
            viagem.veiculo = veiculo.codigo_veiculo
            AND viagem.status = status_viagem.CODIGO_STATUS_VIAGEM
            AND viagem.situacao = situacao_viagem.CODIGO_SITUACAO_VIAGEM
        ORDER BY viagem.codigo_viagem    
    ";

    $respostaViagens = oci_parse($conexao, $sqlViagens);

    if(!oci_execute($respostaViagens)){
        echo ' Erro no select de VIAGENS.';
        echo $sqlViagens;
        exit();
    }else{
        #echo $sqlBancoCondutor;
        while (($row = oci_fetch_assoc($respostaViagens)) != false) {
            $arrayViagens[] = array(
                "codViagem"             => $row['CODIGO_VIAGEM'],
                "codReferenciaIni"      => $row['LOCAL_INI'],
                "codReferenciaFim"      => $row['LOCAL_FIM'],
                "prevPartida"           => $row['PREV_PARTIDA'],
                "partida"               => $row['PARTIDA'],
                "prevChegada"           => $row['PREV_CHEGADA'],
                "chegada"               => $row['CHEGADA'],
                "statusViagem"          => $row['STATUS'],
                "codStatusViagem"       => $row['CODIGO_STATUS_VIAGEM'],
                "situacaoViagem"        => $row['SITUACAO'],
                "codSituacaoViagem"     => $row['CODIGO_SITUACAO_VIAGEM'],
                "descricaoViagem"       => $row['DESCRICAO'],
                "placa"                 => $row['PLACA']
            );
        }
    }

$array['viagens'] = $arrayViagens;

oci_free_statement($respostaViagens);
oci_close($conexao);

$json = $array;

header('Content-Type: application/x-json');
echo json_encode($json);