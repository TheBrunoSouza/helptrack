<?php
    header('Content-Type: text/html; charset=UTF-8');

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo = new OracleCielo ();
    $conexao  = $oraCielo->getCon();

//    //Quando a viagem for iniciada, a posição atual do veículo será mostrada, no caso deste projeto, vamos mostrar a primeira posição da viagem
//    if($_REQUEST['primeiraPosicao'] == 'T'){
//        $sqlAuxPrimeiraPos1 = " SELECT  * from (";
//        $sqlAuxPrimeiraPos2 = ") WHERE rownum = 1";
//    }else{
//        $sqlAuxPrimeiraPos1 = "";
//        $sqlAuxPrimeiraPos2 = "";
//    }

    $sqlViagem = "
      SELECT 
    rota.codigo_rota, 
    to_char(rota.data_hora, 'DD/MM/YYYY HH24:MI') AS data_hora, 
    rota.lat, 
    rota.lon,  
    veiculo.placa as veiculo,
    viagem.status
FROM help_track_rota rota 
      left join help_track_veiculo veiculo on veiculo.codigo_veiculo = rota.veiculo
      left join HELP_TRACK_VIAGEM viagem on viagem.veiculo = veiculo.codigo_veiculo
WHERE rota.veiculo = veiculo.codigo_veiculo --and viagem.veiculo = veiculo.codigo_veiculo and status is null
ORDER BY VEICULO, data_hora desc
";

    $resViagem = oci_parse($conexao, $sqlViagem);

    if(!oci_execute($resViagem)){
        echo 'Erro ao executar o select de rota:'.$sqlViagem;
    }else{
        $auxVeiculo = '';
        #echo 'select rota ok:'.$sqlViagem;
        while(ocifetchinto($resViagem, $ddRt, OCI_ASSOC)) {
            if ($ddRt['VEICULO'] <> $auxVeiculo){
                $arrayViagem[] = array(
                    "codigoRota" => $ddRt['CODIGO_ROTA'],
                    "veiculo" => $ddRt['VEICULO'],
                    "status" => $ddRt['STATUS'],
                    "data_hora" => $ddRt['DATA_HORA'],
                    "lat" => str_replace(',', '.', $ddRt['LAT']),
                    "lon" => str_replace(',', '.', $ddRt['LON'])
                );
                $auxVeiculo = $ddRt['VEICULO'];
            }
        }
    };

    $array['viagens'] = $arrayViagem;

    echo json_encode($array);

