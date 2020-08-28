<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

$visitorIP = getVisIPAddr();

if(isset($_GET['continent'])) {
    $continentName = $_GET['continent'];
} else {
    $continentName = getContinentFromIP($visitorIP);
}

$apiResponse = callDecisionAPI("/campaigns",  array("visitor_id" => $visitorIP, "context" => array("continent" => $continentName)));

$textVisible = false;
$coloredText = false;
$campaigns = $apiResponse['campaigns'];
foreach ($campaigns as $campaign) {
    $modifications = $campaign['variation']['modifications']['value'];
    echo "\n" . json_encode($modifications);
    if(isset($modifications)) {
        $textVisible = $modifications['textVisible'] === "true";
        $coloredText = $modifications['coloredText'] === "true";
    }
    echo "\n" . json_encode($modifications);
}

echo "ok";

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

function getContinentFromIP($ip) {
    // Store the IP address


// Use JSON encoded string and converts
// it into a PHP variable
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    $geolocInfo =  'Country Name: ' . $ipdat->geoplugin_countryName . "\n";
    $geolocInfo .= 'City Name: ' . $ipdat->geoplugin_city . "\n";
    $geolocInfo .= 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
    $geolocInfo .= 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
    $geolocInfo .= 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
    $geolocInfo .= 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
    $geolocInfo .= 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
    $geolocInfo .= 'Timezone: ' . $ipdat->geoplugin_timezone;

    $continentName = $ipdat->geoplugin_continentName;
    return $continentName;
}


function callDecisionAPI($url, $data = null)
{
    $url = "https://decision-api.flagship.io/v1/bkiaa64n8mvg0ctk8de0"  . $url;
    $ch = curl_init();

    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json'
    );

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
    }
    curl_close($ch);

    echo $result;
    return json_decode($result);
}


?>
<html>
<head>
  <script type="text/javascript" src="https://try.abtasty.com/66f086887bc08ea6de5b972880d51252.js"></script>
</head>
<body>

<p>
   Your continent is <?php echo $continentName ?>
</p>
<div>
    <form action="/flagshipdemo.php">
        <label>Change continent:</label>
        <select name="continent" onchange="this.form.submit()">
            <option value="North America">North America</option>
            <option value="South America">South America</option>
            <option value="Asia">Asia</option>
            <option value="Europe">Europe</option>
            <option value="Africa">Africa</option>
            <option value="Oceania">Oceania</option>
        </select>
    </form>
</div>

<div>
    <p>Thanks to Flagship, a text will appear below if you are not in Asia. And it will be yellow if you are in North America  </p>
    <?php if ($textVisible) :?>
        <?php if ($coloredText) :?>
        <style>
            .flagship_text {
                color: yellow;
            }
        </style>
        <?php endif ;?>
        <p class="flagship_text">Lorem Ipsum</p>
    <?php endif ;?>
</div>
</body>
</html>
