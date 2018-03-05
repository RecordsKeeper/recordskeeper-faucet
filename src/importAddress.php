<?php
$config = include('config.php');
$chain = $config['chain_name'];
// Escape user inputs for security
$address = $_REQUEST['address'];

$response = null;
    
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
            CURLOPT_POSTFIELDS => "{\"method\":\"importaddress\",\"params\":[\"$address\",\"\", false],\"id\":1,\"chain_name\":\"$chain\"}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
            ));

            error_log("Sending importaddress request");

            $result = json_decode(curl_exec($curl));
            error_log(json_encode($result, JSON_PRETTY_PRINT));
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            header('Content-Type: application/json');

            $txn  = $result->result;
            if($httpCode == 200 && $result->error == null) {
                $response =  '{"message": "Address imported", "error": 0}';
            }
            else if($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
                $response =  '{"message": "Address not imported", "error": 1}';
                error_log("ERROR: Address not imported");
            }
            echo $response;

        } else {
            header('Content-Type: application/json');
            $data = '{"txnID": null, "message": "Invalid address", "error": 1}';
            echo $data;
            error_log("ERROR: Invalid Address length");
        }
        
    }
    catch(Exception $e){
        error_log("ERROR: could not connect to recordskeeper". $e->getMessage());
    }

function validStrLen($str){
    $len = strlen($str);
    if($len < 24){
        return FALSE;
    }else{
        return TRUE;
    }
} 

?>
