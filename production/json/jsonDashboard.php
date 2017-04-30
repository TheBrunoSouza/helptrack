<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    #===================================================================================================================
    #TOTALIZADOR

    //Veiculos
    $sqlTotalVeiculos = "
        SELECT 
          count(*) AS total_veiculos
        FROM 
          HELP_TRACK_VEICULO
    ";

    $respostaTotalVeiculos = oci_parse($conexao, $sqlTotalVeiculos);

    if(oci_execute($respostaTotalVeiculos)){
        $totalVeiculos = oci_fetch_assoc($respostaTotalVeiculos);
    }

    //Atrasados
    $sqlTotalAtrasados = "
        SELECT 
          count(*) AS total_atrasados
        FROM 
          HELP_TRACK_VIAGEM
        WHERE
          situacao = 1
    ";

    $respostaTotalAtrasados = oci_parse($conexao, $sqlTotalAtrasados);

    if(oci_execute($respostaTotalAtrasados)){
        $totalAtrasados = oci_fetch_assoc($respostaTotalAtrasados);
    }

    //No prazo
    $sqlTotalNoPrazo = "
            SELECT 
              count(*) AS total_no_prazo
            FROM 
              HELP_TRACK_VIAGEM
            WHERE
              situacao = 2
        ";

    $respostaTotalNoPrazo = oci_parse($conexao, $sqlTotalNoPrazo);

    if(oci_execute($respostaTotalNoPrazo)){
        $totalNoPrazo = oci_fetch_assoc($respostaTotalNoPrazo);
    }

    //Condutores
    $sqlTotalCondutores = "
        SELECT
          count(*) AS total_condutores
        FROM
          HELP_TRACK_CONDUTOR
    ";

    $respostaTotalCondutores = oci_parse($conexao, $sqlTotalCondutores);

    if(oci_execute($respostaTotalCondutores)){
        $totalCondutores = oci_fetch_assoc($respostaTotalCondutores);
    }

    //Viagens
    $sqlTotalViagens = "
        SELECT
          count(*) AS total_viagens
        FROM
          HELP_TRACK_VIAGEM
    ";

    $respostaTotalViagens = oci_parse($conexao, $sqlTotalViagens);

    if(oci_execute($respostaTotalViagens)){
        $totalViagens = oci_fetch_assoc($respostaTotalViagens);
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