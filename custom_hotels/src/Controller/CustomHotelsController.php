<?php
namespace Drupal\custom_hotels\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\Response;
/**
* Provides route responses for the Custom Api module.
*/
class CustomHotelsController extends ControllerBase {
 /**
  * Returns a simple message page.
  *
  * @return array
  *   A simple renderable array.
  */
 public function homePage() {
  

    $client = \Drupal :: httpClient();
    $request = $client->get("https://api-sandbox.rezserver.com/api/hotel/getExpress.Availability?format=json&refid=10032&api_key=950286731be2e8362c31161b177a50d7&check_in=2023-09-03&check_out=2023-09-06&latitude=40.7127753&longitude=-74.0059728&radius=30&limit=10&start=21");
    $response = $request->getBody()->getContents();
    $result = json::decode($response);
    // print_r($result)
    $data = $result['getHotelExpress.Availability']['results']['hotel_data'];

    foreach($data as $key => $value) {
      $data_hotel[] = $value;
    }
    // dd($data_hotel);
  return [
    '#theme' => 'testing', // The name of your Twig template file.
    '#hotels' => $data_hotel, // Pass the data to the template.
  ];
 }
}