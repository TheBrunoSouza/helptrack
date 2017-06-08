<?php
    header('Content-Type: text/html; charset=UTF-8');

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo = new OracleCielo ();
    $conexao  = $oraCielo->getCon();

    //Quando a viagem for iniciada, a posição atual do veículo será mostrada, no caso deste projeto, vamos mostrar a primeira posição da viagem
    if($_REQUEST['primeiraPosicao'] == 'T'){
        $sqlAuxPrimeiraPos1 = " SELECT  * from (";
        $sqlAuxPrimeiraPos2 = ") WHERE rownum = 1";
    }else{
        $sqlAuxPrimeiraPos1 = "";
        $sqlAuxPrimeiraPos2 = "";
    }

    $sqlViagem = $sqlAuxPrimeiraPos1."
      SELECT 
          rota.codigo_rota, 
          to_char(rota.data_hora, 'DD/MM/YYYY HH24:MI') AS data_hora, 
          rota.lat, 
          rota.lon,  
          veiculo.placa as veiculo 
      FROM help_track_rota rota, help_track_veiculo veiculo 
      WHERE rota.veiculo = veiculo.codigo_veiculo
            AND veiculo.placa = '".$_REQUEST['placa']."'
      ORDER BY data_hora DESC".$sqlAuxPrimeiraPos2;

    $resViagem = oci_parse($conexao, $sqlViagem);

    if(!oci_execute($resViagem)){
        echo 'Erro ao executar o select de rota:'.$sqlViagem;
    }else{
        #echo 'select rota ok:'.$sqlViagem;
        while(ocifetchinto($resViagem, $ddRt, OCI_ASSOC)) {
            $arrayViagem[] = array(
                "codigoRota" => $ddRt['CODIGO_ROTA'],
                "veiculo"    => $ddRt['VEICULO'],
                "data_hora"  => $ddRt['DATA_HORA'],
                "lat"        => str_replace(',', '.', $ddRt['LAT']),
                "lon"        => str_replace(',', '.', $ddRt['LON'])
            );
        }
    };

    $array['viagens'] = $arrayViagem;

    echo json_encode($array);

