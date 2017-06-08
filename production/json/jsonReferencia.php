<?php
    header('Content-Type: text/html; charset=UTF-8');

    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo = new OracleCielo ();
    $conexao  = $oraCielo->getCon();

    $sqlReferencia = "
      SELECT 
          LATITUDE, LONGITUDE, DESCRICAO 
      FROM help_track_referencia
      WHERE CODIGO_REFERENCIA = '".$_REQUEST['codReferenciaIni']."' OR CODIGO_REFERENCIA = '".$_REQUEST['codReferenciaFim']."'";

    $resReferencia = oci_parse($conexao, $sqlReferencia);

    if(!oci_execute($resReferencia)){
        echo 'Erro ao executar o select de rota:'.$sqlReferencia;
    }else{
        #echo 'select rota ok:'.$sqlReferencia;
        while(ocifetchinto($resReferencia, $ddRt, OCI_ASSOC)) {
            $arrayReferencia[] = array(
                "data_hora"  => $ddRt['DESCRICAO'],
                "lat"        => str_replace(',', '.', $ddRt['LATITUDE']),
                "lon"        => str_replace(',', '.', $ddRt['LONGITUDE'])
            );
        }
    };

    $array['referencias'] = $arrayReferencia;

    echo json_encode($array);

