<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlCondutores = "
        SELECT 
          *
        FROM 
          HELP_TRACK_CONDUTOR
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
                "idBancoCondutor"   => $row['PLACA']
            );
        }
    }


    $array['totalVeiculos']     = $totalVeiculos;
    $array['totalCondutores']   = $totalCondutores;
    $array['totalViagens']      = $totalViagens;
    $array['totalAtrasados']    = $totalAtrasados;
    $array['totalNoPrazo']      = $totalNoPrazo;

    oci_free_statement($respostaTotalVeiculos);
    oci_free_statement($respostaTotalCondutores);
    oci_free_statement($respostaTotalViagens);
    oci_free_statement($respostaTotalAtrasados);
    oci_free_statement($respostaTotalNoPrazo);
    oci_close($conexao);

    $json = $array;

    //start output
    header('Content-Type: application/x-json');
    echo json_encode($json);
?>