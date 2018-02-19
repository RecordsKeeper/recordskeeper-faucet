<?php
$config = include('config.php');
// Connection constants
// define('MEMCACHED_HOST', '127.0.0.1');
// define('MEMCACHED_PORT', '11211');
// Escape user inputs for security
$address = $_REQUEST['address'];
    // $memcache = new Memcache;
    // $cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);
    // if ($cacheAvailable == true)
    // {
    //     $key = get_client_ip();
    //     $lastTimeStamp = $memcache->get($key);
    //     if(time()-$lastTimeStamp >= 43200){
    //         send($address);
    //     }
    // }
    try{
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
        CURLOPT_POSTFIELDS => "{\"method\":\"send\",\"params\":[\"$address\",10],\"chain_name\":\"recordskeeper-test\"}",
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
        // if($httpCode == 200){
        //     $memcache->set(get_client_ip(), time());
        // }
        header('Content-Type: application/json');
        echo $result;
        
    }
    catch(Exception $e){
        error_log("ERROR: could not connect to recordskeeper". $e->getMessage());
    }

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>