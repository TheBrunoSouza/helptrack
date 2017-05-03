<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlViagens = "
        SELECT 
            *
        FROM help_track_viagem
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
                "dataHoraPrevPartida"   => $row['DATA_HORA_PREV_PARTIDA'],
                "dataHoraPartida"       => $row['DATA_HORA_PARTIDA'],
                "dataHoraChegada"       => $row['DATA_HORA_PREV_CHEGADA'],
                "dataHoraChegada"       => $row['DATA_HORA_CHEGADA'],
                "statusViagem"          => $row['STATUS'],
                "situacaoViagem"        => $row['SITUACAO']
            );
        }
    }

$array['viagens'] = $arrayViagens;

oci_free_statement($respostaViagens);
oci_close($conexao);

$json = $array;

header('Content-Type: application/x-json');
echo json_encode($json);