<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlCondutores = "
        SELECT 
          *
        FROM 
          HELP_TRACK_REGISTROS
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
                "codRegistro"   => $row['CODIGO_REGISTRO'],
                "nome"          => $row['DESCRICAO'],
                "veiculo"       => $row['VEICULO'],
                "dataHora"      => $row['DATA_HORA'],
                "usuario"       => $row['USUARIO'],
                "viagem"        => $row['VIAGEM']
            );
        }
    }

    oci_free_statement($respostaCondutor);
    oci_close($conexao);

    $array['registros'] = $arrayCondutor;
    $json = $array;

    header('Content-Type: application/x-json');
    echo json_encode($json);
