<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class geocode extends Controller
{
    public function address(Request $request){
        $address = $request->address;
        $myCurl = curl_init();
        $data = [
          'apikey' => 'xXXxxXXxXXxxXXx',
          'geocode' => $address
        ];
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://geocode-maps.yandex.ru/1.x/?'.http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(/*здесь массив параметров запроса*/))
        ));
        $response = curl_exec($myCurl);
        curl_close($myCurl);

        echo "Ответ на Ваш запрос: ".$response;
    }
}
