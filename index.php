<?php
$myText = "Buy";


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

?>
<html>
<head>
  <script type="text/javascript" src="https://try.abtasty.com/66f086887bc08ea6de5b972880d51252.js"></script>
  <script>
    const addItem = () => { 
      let transactionItems = document.getElementById('transaction_items');
      const clone = transactionItems.children[0].cloneNode(true);
      transactionItems.appendChild(clone);
      for(let i = 0; i < transactionItems.childElementCount ; i++) {
        transactionItems.children[i].getElementsByClassName('item_value')[0].setAttribute("name", "item_value_" + i);
      }
    };
  </script>
</head>
<body>
  <div id="action_tracking">
    <button>Useless button (for action tracking)</button>
  </div>
<form id="transaction_form" action="/confirmation.html">
  <div id="transaction_items">
    <div> 
      <label>Item Price:</label><br>
      <input type="text" class="item_value" name="item_value_0" value="0"><br><br>
    </div>
  </div>
  <button type="button" onclick="addItem();">Add item</button> 
  <input type="submit" value="<?php echo $myText; ?>">
</form>
<p>
    Geoloc  infos:
</p>
<p>
<?php echo $geolocInfo ?>
</p>
</body>
</html>
