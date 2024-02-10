<?php
include('env.php');

define("URL" , "https://api.nobitex.ir/v2/orderbook/all");


function get_data(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL, URL);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    return json_decode($result);
}
function beautify_data(){
    $data = get_data();
    $SYMBOLS = ['BTCIRT', 'ETHIRT', 'LTCIRT', 'USDTIRT', 'XRPIRT','BNBIRT', 'EOSIRT', 'XLMIRT','ETCIRT', 'TRXIRT', 'DOGEIRT', 'UNIIRT', 'DAIIRT', 'LINKIRT', 'DOTIRT',
     'AAVEIRT', 'ADAIRT', 'SHIBIRT', 'FTMIRT', 'MATICIRT', 'AXSIRT', 'MANAIRT', 'SANDIRT', 'AVAXIRT', 'MKRIRT', 
     'GMTIRT', 'USDCIRT', 'BTCUSDT', 'ETHUSDT', 'LTCUSDT', 'XRPUSDT', 'BCHUSDT', 'BNBUSDT', 'EOSUSDT', 'XLMUSDT',
      'ETCUSDT', 'TRXUSDT', 'PMNUSDT', 'DOGEUSDT', 'UNIUSDT', 'DAIUSDT', 'LINKUSDT', 'DOTUSDT', 'AAVEUSDT', 'ADAUSDT',
       'SHIBUSDT', 'FTMUSDT', 'MATICUSDT', 'AXSUSDT', 'MANAUSDT', 'SANDUSDT', 'AVAXUSDT', 'MKRUSDT', 'GMTUSDT', 'USDCUSDT'];
    foreach ($SYMBOLS as $key => $value) {
        echo $value . '<br>';
    }
}
beautify_data();