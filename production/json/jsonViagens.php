<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    $sqlBancoCondutor = "
        SELECT 
            *
        FROM ROTA 
        WHERE 
            placa  like '%MLT0017%'
    ";

$respostaBancoCondutor = oci_parse($conexao, $sqlBancoCondutor);

if(!oci_execute($respostaBancoCondutor)){
    echo ' Erro no select de BANCO_CONDUTOR.';
    echo $sqlBancoCondutor;
    exit();
}else{
    #echo $sqlBancoCondutor;
    while (($row = oci_fetch_assoc($respostaBancoCondutor)) != false) {
        $arrayBancoCondutor[] = array(
            "idBancoCondutor"   => $row['PLACA']
        );
    }
}

$array['bancoCondutor'] = $arrayBancoCondutor;

oci_free_statement($respostaBancoCondutor);
oci_close($conexaoOra);

$json = $array;

//start output
header('Content-Type: application/x-json');
echo json_encode($json);
//$array['viagens'] = $arrayViagem;
echo json_encode($array);
?>