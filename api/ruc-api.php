<?php

//obtenemos el json de entrada
$inputJSON = file_get_contents('php://input');
//v(erificamos el json recibido
if ($inputJSON) {
    $data = json_decode($inputJSON, true);

    //el json tienen que tener 11 digitos
    if (isset($data['dato']) && strlen($data['dato']) === 11) {

        // Datos
        $token = 'apis-token-7965.B9KHGPZquU49jy7VyHOBX86Wyr';
        $ruc = $data['dato'];

        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar ruc sunat
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: http://apis.net.pe/api-ruc',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        echo $response;

        // curl_close($curl);
        // // Datos de empresas según padron reducido
        // $empresa = json_decode($response);
        // var_dump($empresa);
    }else{
        //respuesta en caso haya digitos faltantes
        $response =array('error' => false, 'massage' => 'el ruc no contiene 11 digitos');
        echo json_encode($response);
    }
}else{
    $response =array('error' => false, 'massage' => 'no se recibio un json');
        echo json_encode($response);
}
