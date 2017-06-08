<?php

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();
    $acao       = $_REQUEST['acao'];

    switch ($acao){
        case 'finalizarViagem':
            $codViagem = $_REQUEST['codViagem'];

            $sqlFinalizarViagem = "
                UPDATE help_track_viagem
                SET situacao = 1, data_hora_chegada = SYSDATE
                WHERE codigo_viagem = '".$codViagem."'
            ";

            $resFinalizarViagem = oci_parse($conexao, $sqlFinalizarViagem);

            if(!oci_execute($resFinalizarViagem)) {
                $aux = oci_error($resFinalizarViagem);
                echo $aux['message'];
                exit();
            }

            oci_free_statement($resFinalizarViagem);

            #Chamando a procedure para atualizar o status
            $sqlProcedureViagem = "
                 BEGIN
                    PKG_HELP_TRACK.ATUALIZASTATUSVIAGEM;
                    COMMIT;
                 END;
            ";
            $resProcedureViagem = oci_parse($conexao, $sqlProcedureViagem);
            if(!oci_execute($resProcedureViagem)) {
                $aux = oci_error($resProcedureViagem);
                echo $aux['message'];
                exit();
            }
            oci_free_statement($resProcedureViagem);

            break;

        case 'iniciarViagem':
            $codViagem = $_REQUEST['codViagem'];

            $sqlIniciarViagem = "
                UPDATE help_track_viagem
                SET situacao = 3, data_hora_partida = SYSDATE
                WHERE codigo_viagem = '".$codViagem."'
            ";
            #echo 'SQL INSERT: '.$sqlInsertViagem; exit();

            $resIniciarViagem = oci_parse($conexao, $sqlIniciarViagem);

            if(!oci_execute($resIniciarViagem)) {
                $aux = oci_error($resIniciarViagem);
                echo $aux['message'];
                exit();
            }

            oci_free_statement($resIniciarViagem);

            break;
        case 'excluirViagem':
            $codViagem = $_REQUEST['codViagem'];

            $sqlExcluirViagem = "
                DELETE FROM HELP_TRACK_VIAGEM WHERE CODIGO_VIAGEM = '".$codViagem."'
            ";
            #echo 'SQL INSERT: '.$sqlInsertViagem; exit();

            $resExcluirViagem = oci_parse($conexao, $sqlExcluirViagem);

            if(!oci_execute($resExcluirViagem)) {
                $aux = oci_error($resExcluirViagem);
                echo $aux['message'];
                exit();
            }

            oci_free_statement($resExcluirViagem);

            break;
        case 'novaViagem':
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
                  situacao,
                  descricao,
                  veiculo
                ) VALUES (
                  SEQ_HELP_TRACK_VIAGEM.nextval,
                  '".$codReferenciaIni."',
                  '".$codReferenciaFim."',
                  to_date('".$ini."', 'DD/MM/YYYY HH24:MI'),
                  null,
                  to_date('".$fim."', 'DD/MM/YYYY HH24:MI'),
                  null,
                  2,
                  2,
                  '".$descricaoViagem."',
                  '".$codVeiculo."'
                )
            ";
            #echo 'SQL INSERT: '.$sqlInsertViagem; exit();

            $resInsertViagem = oci_parse($conexao, $sqlInsertViagem);

            if(!oci_execute($resInsertViagem)) {
                $aux = oci_error($resInsertViagem);
                echo $aux['message'];
                exit();
            }

            oci_free_statement($resInsertViagem);

            echo json_encode($status);
            break;
        default:
            echo 'default';
            break;
    }
    oci_close($conexao);