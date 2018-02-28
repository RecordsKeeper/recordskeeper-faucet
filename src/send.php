<?php
$config = include('config.php');
$chain = $config['chain_name'];
$fromaddress = $config['from_address'];
$tokenQuant = $config['token_quant'];
// Escape user inputs for security
$address = $_REQUEST['address'];
    
    try{
        $isValid = validStrLen($address);
        if($isValid) {
        
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_PORT => $config['rk_port'],
            CURLOPT_URL => $config['rk_host'],
            CURLOPT_USERPWD => $config['rk_user'].":".$config['rk_pass'],
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"method\":\"sendfrom\",\"params\":[\"$fromaddress\",\"$address\",$tokenQuant],\"id\":1,\"chain_name\":\"$chain\"}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
            ));

            error_log("Sending request");

            $result = curl_exec($curl);
            error_log(json_encode($result, JSON_PRETTY_PRINT));
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            header('Content-Type: application/json');
            echo $result;
        } else {
            header('Content-Type: application/json');
            $data = '{"message": "Address length not valid"}';
            echo $data;
            error_log("ERROR: Invalid Address");
        }
        
    }
    catch(Exception $e){
        error_log("ERROR: could not connect to recordskeeper". $e->getMessage());
    }

function validStrLen($str){
    $len = strlen($str);
    if($len != 34){
        return FALSE;
    }else{
        return TRUE;
    }
}    
?>