<?php
require __DIR__ . '/vendor/autoload.php';
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
     'GMTIRT', 'USDCIRT'];
    $finalData = [];
    foreach ($SYMBOLS as $key => $value) {
        // echo date('H:m:s m/d/Y ' , $data->$value->lastUpdate);
        // $date = jdate($data->$value->lastUpdate)->format('datetime');
        if($data->$value->lastTradePrice > 0){
            array_push($finalData , [
                'name' => $value,
                'price' => $data->$value->lastTradePrice
            ]);
        }else{
            array_push($finalData , [
                'name' => $value ,
                'price' => $data->$value->lastTradePrice
            ]);
        }
    }
    return $finalData;
}
?>
<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>نرخ ارز دیجیتال</title>
        <meta name="description" , content="نرخ ارزهای دیجیتال را میتوانید به راحتی از این صفحه بخوانید تمامی آپدیت از سایت نوبیتکس میباشد ">
        <meta name="keywords" content="نرخ ارز , بازار , بیتکوین , اتریوم , دلار">
        <meta name="author" content="mehrab kordbacheh , مهراب کردبچه">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="fonts/css/style.css">
    </head>
    <body>
        <div class="container">
        <h1 class="pt-3 pb-3">نرخ بازار ارز دیجیتال</h1>
        <p>تمامی قیمت های زیر از سایت نوبیتکس استعلام گرفته شده میتوانید برای قیمت های بیشتر به این سایت مراجعه کنید</p>
        <a class="btn btn-primary" href="https://nobitex.ir/" target="_blank">سایت نوبیتکس</a>
        <a href="http://mehrabkordbacheh.com" class="btn btn-success" target="_self">بازگشت به سایت </a>
        <a href="https://github.com/Mehrabkb/api_currencies" class="btn btn-dark">سورس کد این صفحه </a>
        <div class="row">


    <?php 
       $fData = beautify_data();
       foreach ($fData as $key => $value) {
            echo '<div class="col-12 col-md-4 mt-3"><div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">'.$value['name'].'</h5>
              <p class="card-text">'.number_format($value['price']).'  Rial </p>
            </div>
          </div></div>';
       }
    ?>
                </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>