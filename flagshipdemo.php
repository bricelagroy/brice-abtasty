<?php

function getVisIpAddr() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


function callDecisionAPI($url, $data = null)
{
    $url = "https://decision-api.flagship.io/v1/bkiaa64n8mvg0ctk8de0"  . $url;
    $ch = curl_init();

    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json'
    );

    echo "url " . $url;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    if(!is_null($data)){
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $result = curl_exec($ch);
    $ch_error = curl_error($ch);
    if ($ch_error) {
        echo("cURL Error: $ch_error");
    } else {
        echo("curl success: " . $result);
    }
    curl_close($ch);

    return json_decode($result);
}


// Store the IP address
$vis_ip = getVisIPAddr();

// Use JSON encoded string and converts
// it into a PHP variable
$ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $vis_ip));

$geolocInfo =  'Country Name: ' . $ipdat->geoplugin_countryName . "\n";
$geolocInfo .= 'City Name: ' . $ipdat->geoplugin_city . "\n";
$geolocInfo .= 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
$geolocInfo .= 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
$geolocInfo .= 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
$geolocInfo .= 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
$geolocInfo .= 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
$geolocInfo .= 'Timezone: ' . $ipdat->geoplugin_timezone;

callDecisionAPI("/campaigns",  array("visitor_id" => $vis_ip, "context" => array("continent" => "Europe")));

?>
<html>
<head>
  <script type="text/javascript" src="https://try.abtasty.com/66f086887bc08ea6de5b972880d51252.js"></script>
</head>
<body>
<p>
    Geoloc  infos:
</p>
<p>
<?php echo $geolocInfo ?>
</p>
</body>
</html>
