<?php

namespace App\Services;

use App\Models\CampaignPostback;
use App\Models\Click;
use App\Models\Conversion;
use App\Models\Profile;

class ScanViatorService
{
  const USD_VND_RATE = 22500;

  public function scan()
  {
    $jsonString = '{"extendedBookings":[{"itineraryItemId":1346367663,"bookingDateTime":"2025-12-25T12:19:38Z","travelDate":"2026-12-20","productName":"The ULTIMATE Beer and Schnapps Day-Drinking Tour of Munich","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"252005P6","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"cancellationDate":"2025-12-28T07:15:14Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":360,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1346695719,"bookingDateTime":"2025-12-26T14:35:45Z","travelDate":"2026-12-17","productName":"Munich Christmas Market Food Tour with Tastings","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"158751P4","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"cancellationDate":"2025-12-30T23:00:32Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":356,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1346720343,"bookingDateTime":"2025-12-26T15:53:55Z","travelDate":"2026-12-21","productName":"Nuremberg Food Tour with Full Meal & Drinks by Do Eat Better","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"188552P36","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"cancellationDate":"2025-12-29T16:41:29Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":360,"excellentQuality":"No","bestConversion":"No","destination":"Nuremberg"},{"itineraryItemId":1346869367,"bookingDateTime":"2025-12-26T23:09:30Z","travelDate":"2026-12-15","productName":"Montmartre or Notre Dame Gourmet Food Tour with 10 Dishes & Wines","bookingStatus":"CONFIRMED","totalBookingAmount":"USD 468.45","commission":"USD 37.47","paymentStatus":"RESERVED","productCode":"7812P1","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":354,"excellentQuality":"Yes","bestConversion":"No","destination":"Paris"},{"itineraryItemId":1347804977,"bookingDateTime":"2025-12-29T09:01:51Z","travelDate":"2026-12-18","productName":"Rome Food Tour: Campo de\' Fiori, Ghetto, Trastevere Winner 2024 ","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"5614ROMEFOOD","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":1,"cancellationDate":"2025-12-30T21:28:19Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":354,"excellentQuality":"Yes","bestConversion":"No","destination":"Rome"},{"itineraryItemId":1347955717,"bookingDateTime":"2025-12-29T18:06:06Z","travelDate":"2026-12-21","productName":" Munich Old Town Food Tour with 10+ Bavarian Specialties","bookingStatus":"AMENDED","totalBookingAmount":"USD 470.40","commission":"USD 37.64","paymentStatus":"RESERVED","productCode":"7812P277","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":357,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1348007395,"bookingDateTime":"2025-12-29T20:24:01Z","travelDate":"2026-12-13","productName":"Paris Baking Insider Experience near Notre-Dame","bookingStatus":"CONFIRMED","totalBookingAmount":"USD 228.00","commission":"USD 18.24","paymentStatus":"RESERVED","productCode":"47475P65","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":2,"sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":349,"excellentQuality":"Yes","bestConversion":"No","destination":"Paris"},{"itineraryItemId":1348409005,"bookingDateTime":"2025-12-30T21:27:02Z","travelDate":"2026-12-18","productName":"Rome Colosseum: Pizza & Aperitivo Food Tour at Sunset","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"5614P18","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":1,"cancellationDate":"2025-12-30T21:43:33Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":353,"excellentQuality":"Yes","bestConversion":"No","destination":"Rome"}],"hasExtendedAgentFields":false,"hasExtendedWhitelabelFields":false}';

    $data = json_decode($jsonString, true);
    $data = $data['extendedBookings'];

    foreach ($data as $key => $item) {
      $click = Click::query()
        ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
        ->select('link_histories.*', 'clicks.id as click_id')
        ->where('clicks.code', $item['campaign'])
        ->first();

      dd($click);
    }

    return true;
  }
}
