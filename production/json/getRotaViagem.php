<?php
    // CODIFICAÇÃO
    header('Content-Type: text/html; charset=UTF-8');

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlViagem = "
      SELECT 
          rota.codigo_rota, 
          to_char(rota.data_hora, 'DD/MM/YYYY HH24:MI') AS data_hora, 
          rota.lat, 
          rota.lon,  
          veiculo.placa as veiculo 
      FROM help_track_rota rota, help_track_veiculo veiculo 
      WHERE rota.veiculo = veiculo.codigo_veiculo
            AND veiculo = '".$_REQUEST['veiculo']."'
      ORDER BY data_hora ASC";

    $resViagem = oci_parse($conexao, $sqlViagem);

    if(!oci_execute($resViagem)){
        echo 'Erro ao executar o select de viagem:'.$sqlViagem;
    }else{
        while(ocifetchinto($resViagem, $ddRt, OCI_ASSOC)) {
            $arrayViagem[] = array(
                "codigoRota"=>$ddRt['CODIGO_ROTA'],
                "veiculo"=>$ddRt['VEICULO'],
                "data_hora"=>$ddRt['DATA_HORA'],
                "lat"=>str_replace(',', '.', $ddRt['LAT']),
                "lon"=>str_replace(',', '.', $ddRt['LON'])
            );
        }
    };



    $array['viagens'] = $arrayViagem;

    echo json_encode($array);
?>
