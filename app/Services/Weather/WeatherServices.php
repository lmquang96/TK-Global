<?php

namespace App\Services\Weather;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class WeatherServices
{
  public function getCurrent($city)
  {
    return Cache::remember('weather', 3600, function () use ($city) {
      try {
        $key = "612f94c2c40f4351ae543130252005";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.weatherapi.com/v1/current.json?key=$key&q=$city&lang=vi",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));


        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        $icon = $this->getIcon($response->current->condition->code);

        $result = [
          'code' => $response->current->condition->code,
          'city' => $response->location->name,
          'temperature' => round($response->current->temp_c),
          'condition' => $response->current->condition->text,
          'icon' => empty($icon) ? $response->current->condition->icon : $icon
        ];

        return $result;
      } catch (\Throwable $th) {
        $result = [
          'city' => 'Hanoi',
          'temperature' => 30,
          'condition' => 'Có nắng',
          'icon' => $this->getIcon('1000')
        ];

        return $result;
      }
    });
  }

  function getCity()
  {
    return Cache::remember('location', 86400, function () {
      try {
        $ip = \Request::ip() == '127.0.0.1' ? '117.4.242.101' : \Request::ip();

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://ip-api.com/json/$ip",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        return $response->city;
      } catch (\Throwable $th) {
        return 'Hanoi';
      }
    });
  }

  function getIcon($code)
  {
    $icon = "";
    switch ($code) {
      // Có mây
      case '1003':
        $icon = "https://cdn-icons-png.flaticon.com/128/5370/5370498.png";
        break;

      // Nắng
      case '1000':
        $icon = "https://cdn-icons-png.flaticon.com/128/4814/4814268.png";
        break;

      // Nhiều mây
      case '1006':
        $icon = "https://cdn-icons-png.flaticon.com/128/414/414927.png";
        break;

      // Âm u
      case '1009':
        $icon = "https://cdn-icons-png.flaticon.com/128/5546/5546241.png";
        break;

      // Sương mù
      case '1030':
        $icon = "https://cdn-icons-png.flaticon.com/128/4005/4005817.png";
        break;

      // Mưa rải rác
      case '1063':
        $icon = "https://cdn-icons-png.flaticon.com/128/4088/4088981.png";
        break;

      // Mưa nhẹ nhàng
      case '1180':
        $icon = "https://cdn-icons-png.flaticon.com/128/1959/1959342.png";
        break;

      // Mưa kèm sấm sét
      case '1276':
        $icon = "https://cdn-icons-png.flaticon.com/128/9755/9755210.png";
        break;

      default:
        # code...
        break;
    }

    return $icon;
  }
}
