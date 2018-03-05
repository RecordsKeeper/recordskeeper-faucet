<?php
$config = include('config.php');
$chain = $config['chain_name'];
$fromaddress = $config['from_address'];
$tokenQuantity = $config['token_quant'];
$coolDown = $config['time'];
// Escape user inputs for security
$address = $_REQUEST['address'];

$dbHost = $config["db_host"]; 
$dbName= $config["db_name"];
$dbUser = $config["db_user"];
$dbPwd = $config["db_pass"];

$response = null;
    
    try{
        $isValid = validStrLen($address);
        if($isValid) {

            if(!checkEligibility($address)) {
                header('Content-Type: application/json');
                $data = '{"txnID": null, "message": "Per address XRK token Limit reached. Use another address or wait for cool down period.", "error": 1}';
                echo $data;
                error_log("ERROR: Per address Limit reached.");
                die();
            }

        
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
            CURLOPT_POSTFIELDS => "{\"method\":\"sendfrom\",\"params\":[\"$fromaddress\",\"$address\",$tokenQuantity],\"id\":1,\"chain_name\":\"$chain\"}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
            ));

            error_log("Sending request");

            $result = json_decode(curl_exec($curl));
            error_log(json_encode($result, JSON_PRETTY_PRINT));
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            header('Content-Type: application/json');

            $txn  = $result->result;
            if($httpCode == 200 && $result->error == null) {
                $response =  '{"txnID": "'.$txn.'", "message": "Transaction sent", "error": 0}';
                storeDetails($address);
            }
            else if($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
                $msg = "Invalid address";
                if($result->error->code != -5) $msg = "Error occured. Try again.";
                $response =  '{"txnID": null, "message": "'.$msg.'", "error": 1}';
                error_log("ERROR: $msg");
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

function checkEligibility($address) { 
    try{
        $connectionString =  "mysql:host=". $GLOBALS["dbHost"]."; dbname=".$GLOBALS["dbName"].";";
        $pdo = new PDO($connectionString , $GLOBALS["dbUser"], $GLOBALS["dbPwd"]);
        $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        if($pdo != NULL) {
            $sql = 'SELECT * FROM faucet WHERE xrk_address = :address ORDER BY ID DESC' ;
            $sth = $pdo->prepare($sql);
            $sth->execute(array(':address' => $address));
            $row = $sth->fetch();

            if($row) {
                $lastReceivedAt = $row["received_at"];
                $date = new DateTime($lastReceivedAt, new DateTimeZone("UTC"));
                $lastReceivedTimestamp = $date->format('U');
                
                if((time() - $lastReceivedTimestamp) < $GLOBALS["coolDown"])  { return false; }
            }

            return true;
        }
      }
      catch(Exception $e) {
        error_log("ERROR:couldn't connect". $e->getMessage());
    }
      catch(PDOException $e) {
          error_log("ERROR: couldn't insert". $e->getMessage());
      }
}

function storeDetails($address) { 
    try{
        $connectionString =  "mysql:host=". $GLOBALS["dbHost"]."; dbname=".$GLOBALS["dbName"].";";
        $pdo = new PDO($connectionString , $GLOBALS["dbUser"], $GLOBALS["dbPwd"]);
        $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        if($pdo != NULL) {
            $receivedAt = date('Y-m-d H:i:s', time());
            $stmt = $pdo->prepare("INSERT INTO faucet (xrk_address, xrk_received, received_at, rk_chain) VALUES (:xrk_address, :xrk_received, :received_at, :rk_network)");
            $stmt->execute(array(':xrk_address' => $address,':xrk_received' => $GLOBALS["tokenQuantity"], ':received_at' => $receivedAt, 'rk_network' => $GLOBALS["chain"]));
            $insertedTransactionId = $pdo->lastInsertId(); 
            error_log("Inserted into faucet table. ID  ".$insertedTransactionId);
        }
      }
      catch(Exception $e) {
        error_log("ERROR:couldn't connect". $e->getMessage());
    }
      catch(PDOException $e) {
          error_log("ERROR: couldn't insert". $e->getMessage());
      }
}

?>
