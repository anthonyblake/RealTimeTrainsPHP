<?php

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value
function CallAPI($method, $url, $data)
{
    //$basiccreds = "username:password";
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                //$url = sprintf("%s?%s", $url, http_build_query($data));
                $url = sprintf("%s", $url);
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, $basiccreds);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_STDERR, $fp);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function GetPrestonDepartures()
{
    $configs = include('config.php');

    $curl = curl_init();

    $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://api.rtt.io/api/v1/json/search/PRE',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_USERPWD => $configs['apiuser'] . ":" . $configs['apipass'],
    CURLOPT_VERBOSE => 1,
    CURLOPT_STDERR => $fp
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function GetPrestonDeparturesTable()
{
    $rawjson = GetPrestonDepartures();
    //var_dump(json_decode($rawjson,true));

    $jsonarray = json_decode($rawjson,true);

    //var_dump($jsonarray["services"][0]["locationDetail"]["destination"]);
    $depTableHtml='<table class="departureTable">';

    $depTableHtml=$depTableHtml .'<tr><th>Destination</th><th>Scheduled</th><th>Estimated</th><th>Service</th></tr>';

    foreach($jsonarray["services"] as $service)
    {
        $depTableHtml=$depTableHtml .'<tr><td>'.
                                        $service["locationDetail"]["destination"][0]["description"]."</td><td>".
                                        substr_replace($service["locationDetail"]["gbttBookedDeparture"],":",2,0)."</td><td>".
                                        substr_replace($service["locationDetail"]["realtimeDeparture"],":",2,0)."</td><td>".
                                        $service["atocName"]. "</td></tr>";
    }
    $depTableHtml=$depTableHtml .'</table>';

    return $depTableHtml;
}
?>