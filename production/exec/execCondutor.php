<?php

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();
    $acao       = $_REQUEST['acao'];

    switch ($acao){
        case 'novoCondutor':
            $nome       = $_REQUEST['nome'];
            $matricula  = $_REQUEST['matricula'];

            $sqlNovoCondutor = "
                INSERT INTO HELP_TRACK_CONDUTOR (CODIGO_CONDUTOR, NOME, MATRICULA) VALUES (SEQ_HELP_TRACK_CONDUTOR.nextval, '".$nome."', '".$matricula."')
            ";

            $resFinalizarViagem = oci_parse($conexao, $sqlNovoCondutor);

            if(!oci_execute($resFinalizarViagem)) {
                $aux = oci_error($resFinalizarViagem);
                echo $aux['message'];
                exit();
            }

            oci_free_statement($resFinalizarViagem);

            break;
        case 'apagarCondutor':
            $codCondutor = $_REQUEST['codCondutor'];

            $sqlApagarCondutor = "
                DELETE FROM HELP_TRACK_CONDUTOR WHERE CODIGO_CONDUTOR = '".$codCondutor."'
            ";

            $resApagarCondutor = oci_parse($conexao, $sqlApagarCondutor);

            if(!oci_execute($resApagarCondutor)) {
                $aux = oci_error($resApagarCondutor);
                echo $aux['message'];
                exit();
            }

            oci_free_statement($resApagarCondutor);

            break;
        default:
            echo 'default';
            break;
    }
    oci_close($conexao);