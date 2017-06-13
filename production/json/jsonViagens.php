<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();
    $param      = $_REQUEST[0]['param'];

    switch ($param){
        case 'todas':
            $sqlAux = "";
            break;
        case 'atrasadas':
            $sqlAux = " 
                AND status_viagem.codigo_status_viagem = 1 
                ";
            break;
        case 'prazo':
            $sqlAux = " 
                AND status_viagem.codigo_status_viagem = 2 
                ";
            break;
        case 'aguardando':
            $sqlAux = " 
                AND situacao_viagem.codigo_situacao_viagem = 2 
                ";
            break;
        case 'todasHoje':
            $sqlAux = " 
                AND trunc(data_hora_chegada) = to_char(SYSDATE, 'DD/MM/YYYY') 
                ";
            break;
        case 'atrasosHoje':
            $sqlAux = " 
                AND trunc(data_hora_chegada) = to_char(SYSDATE, 'DD/MM/YYYY') 
                AND status_viagem.codigo_status_viagem = 1 
                ";
            break;
        case 'prazoHoje':
            $sqlAux = " 
                AND trunc(data_hora_chegada) = to_char(SYSDATE, 'DD/MM/YYYY') 
                AND status_viagem.codigo_status_viagem = 2 
                ";
            break;
        case 'viagensAgora':
            $sqlAux = "
                AND situacao_viagem.codigo_situacao_viagem = 3 
                ";
            break;
        case 'atrasadasAgora':
            $sqlAux = "
                AND situacao_viagem.codigo_situacao_viagem = 3
                AND status_viagem.codigo_status_viagem = 1 
                ";
            break;
        case 'prazoAgora':
            $sqlAux = "
                AND situacao_viagem.codigo_situacao_viagem = 3
                AND status_viagem.codigo_status_viagem = 2
                ";
            break;
        case 'podeAtrasarAgora':
            $sqlAux = "
                AND situacao_viagem.codigo_situacao_viagem = 3
                AND status_viagem.codigo_status_viagem = 3
                ";
            break;
        default:
            $sqlAux = "";
            break;
    }

    $sqlViagens = "
        SELECT 
            viagem.codigo_viagem,
            viagem.descricao,
            (SELECT CODIGO_REFERENCIA FROM HELP_TRACK_REFERENCIA WHERE codigo_referencia = local_ini) as cod_local_ini,
            (SELECT CODIGO_REFERENCIA FROM HELP_TRACK_REFERENCIA WHERE codigo_referencia = local_fim) as cod_local_fim,
            (SELECT HELP_TRACK_REFERENCIA.DESCRICAO FROM HELP_TRACK_REFERENCIA WHERE codigo_referencia = local_ini) as local_ini,
            (SELECT HELP_TRACK_REFERENCIA.DESCRICAO FROM HELP_TRACK_REFERENCIA WHERE codigo_referencia = local_fim) as local_fim,
            to_char(viagem.data_hora_prev_partida, 'DD/MM/YYYY HH24:MI') as prev_partida,
            to_char(viagem.data_hora_partida, 'DD/MM/YYYY HH24:MI') partida,
            to_char(viagem.data_hora_prev_chegada, 'DD/MM/YYYY HH24:MI') prev_chegada,
            to_char(viagem.data_hora_chegada, 'DD/MM/YYYY HH24:MI') chegada,
            status_viagem.descricao as status,
            status_viagem.codigo_status_viagem,
            situacao_viagem.descricao as situacao,
            situacao_viagem.codigo_situacao_viagem,
            veiculo.placa,
            veiculo.codigo_veiculo,
            (SELECT nome FROM HELP_TRACK_CONDUTOR c, HELP_TRACK_VEICULO v WHERE c.CODIGO_CONDUTOR = v.condutor and v.CODIGO_VEICULO = veiculo.codigo_veiculo) as nome_condutor,
            (SELECT codigo_condutor FROM HELP_TRACK_CONDUTOR c, HELP_TRACK_VEICULO v WHERE c.CODIGO_CONDUTOR = v.condutor and v.CODIGO_VEICULO = veiculo.codigo_veiculo) as codigo_condutor
        FROM 
            help_track_viagem viagem, 
            help_track_veiculo veiculo,   
            HELP_TRACK_SITUACAO_VIAGEM situacao_viagem, 
            HELP_TRACK_STATUS_VIAGEM status_viagem
        WHERE 
            viagem.veiculo = veiculo.codigo_veiculo
            AND viagem.status = status_viagem.CODIGO_STATUS_VIAGEM
            AND viagem.situacao = situacao_viagem.CODIGO_SITUACAO_VIAGEM
            $sqlAux
        ORDER BY viagem.codigo_viagem    
    ";

    $respostaViagens = oci_parse($conexao, $sqlViagens);

    if(!oci_execute($respostaViagens)){
        echo ' Erro no select de VIAGENS.';
        echo $sqlViagens;
        exit();
    }else{
        #echo $sqlViagens;
        while (($row = oci_fetch_assoc($respostaViagens)) != false) {
            $arrayViagens[] = array(
                "codViagem"             => $row['CODIGO_VIAGEM'],
                "codReferenciaIni"      => $row['COD_LOCAL_INI'],
                "codReferenciaFim"      => $row['COD_LOCAL_FIM'],
                "referenciaIni"         => $row['LOCAL_INI'],
                "referenciaFim"         => $row['LOCAL_FIM'],
                "prevPartida"           => $row['PREV_PARTIDA'],
                "partida"               => $row['PARTIDA'],
                "prevChegada"           => $row['PREV_CHEGADA'],
                "chegada"               => $row['CHEGADA'],
                "statusViagem"          => $row['STATUS'],
                "codStatusViagem"       => $row['CODIGO_STATUS_VIAGEM'],
                "situacaoViagem"        => $row['SITUACAO'],
                "codSituacaoViagem"     => $row['CODIGO_SITUACAO_VIAGEM'],
                "descricaoViagem"       => $row['DESCRICAO'],
                "placa"                 => $row['PLACA'],
                "codVeiculo"            => $row['CODIGO_VEICULO'],
                "nomeCondutor"          => $row['NOME_CONDUTOR'],
                "codCondutor"           => $row['CODIGO_CONDUTOR']
            );
        }
    }

$array['viagens'] = $arrayViagens;

oci_free_statement($respostaViagens);
oci_close($conexao);

$json = $array;

header('Content-Type: application/x-json');
echo json_encode($json);