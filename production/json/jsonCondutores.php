<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlCondutores = "
        SELECT 
          *
        FROM 
          HELP_TRACK_CONDUTOR
        ORDER BY nome ASC
    ";

    $respostaCondutor = oci_parse($conexao, $sqlCondutores);

    if(!oci_execute($respostaCondutor)){
        echo ' Erro no select CONDUTORES.';
        echo $sqlCondutores;
        exit();
    }else{
        #echo $sqlBancoCondutor;
        while (($row = oci_fetch_assoc($respostaCondutor)) != false) {
            $arrayCondutor[] = array(
                "codCondutor"   => $row['CODIGO_CONDUTOR'],
                "nome"          => $row['NOME'],
                "matricula"     => $row['MATRICULA'],
                "totalAtrasos"  => $row['TOTAL_ATRASOS']
            );
        }
    }

    oci_free_statement($respostaCondutor);
    oci_close($conexao);

    $array['condutores'] = $arrayCondutor;
    $json = $array;

    header('Content-Type: application/x-json');
    echo json_encode($json);
