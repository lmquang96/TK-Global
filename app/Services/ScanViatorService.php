<?php

namespace App\Services;

use App\Models\CampaignPostback;
use App\Models\Click;
use App\Models\Conversion;
use App\Models\Profile;
use Carbon\Carbon;
use App\Models\CommissionRate;

class ScanViatorService
{
  const USD_VND_RATE = 22500;
  const VAT_RATE = 1.1;

  public function scan()
  {
    $jsonString = '{"extendedBookings":[{"itineraryItemId":1346367663,"bookingDateTime":"2025-12-25T12:19:38Z","travelDate":"2026-12-20","productName":"The ULTIMATE Beer and Schnapps Day-Drinking Tour of Munich","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"252005P6","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"cancellationDate":"2025-12-28T07:15:14Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":360,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1346695719,"bookingDateTime":"2025-12-26T14:35:45Z","travelDate":"2026-12-17","productName":"Munich Christmas Market Food Tour with Tastings","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"158751P4","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"cancellationDate":"2025-12-30T23:00:32Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":356,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1346720343,"bookingDateTime":"2025-12-26T15:53:55Z","travelDate":"2026-12-21","productName":"Nuremberg Food Tour with Full Meal & Drinks by Do Eat Better","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"188552P36","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"cancellationDate":"2025-12-29T16:41:29Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":360,"excellentQuality":"No","bestConversion":"No","destination":"Nuremberg"},{"itineraryItemId":1346869367,"bookingDateTime":"2025-12-26T23:09:30Z","travelDate":"2026-12-15","productName":"Montmartre or Notre Dame Gourmet Food Tour with 10 Dishes & Wines","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"7812P1","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"cancellationDate":"2026-01-02T15:15:11Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":354,"excellentQuality":"Yes","bestConversion":"No","destination":"Paris"},{"itineraryItemId":1347804977,"bookingDateTime":"2025-12-29T09:01:51Z","travelDate":"2026-12-18","productName":"Rome Food Tour: Campo de\' Fiori, Ghetto, Trastevere Winner 2024 ","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"5614ROMEFOOD","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":1,"cancellationDate":"2025-12-30T21:28:19Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":354,"excellentQuality":"Yes","bestConversion":"No","destination":"Rome"},{"itineraryItemId":1347955717,"bookingDateTime":"2025-12-29T18:06:06Z","travelDate":"2026-12-21","productName":" Munich Old Town Food Tour with 10+ Bavarian Specialties","bookingStatus":"AMENDED","totalBookingAmount":"USD 470.40","commission":"USD 37.64","paymentStatus":"RESERVED","productCode":"7812P277","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":357,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1348007395,"bookingDateTime":"2025-12-29T20:24:01Z","travelDate":"2026-12-13","productName":"Paris Baking Insider Experience near Notre-Dame","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"47475P65","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":2,"cancellationDate":"2026-01-02T02:33:52Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":349,"excellentQuality":"Yes","bestConversion":"No","destination":"Paris"},{"itineraryItemId":1348409005,"bookingDateTime":"2025-12-30T21:27:02Z","travelDate":"2026-12-18","productName":"Rome Colosseum: Pizza & Aperitivo Food Tour at Sunset","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"5614P18","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":1,"cancellationDate":"2025-12-30T21:43:33Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":353,"excellentQuality":"Yes","bestConversion":"No","destination":"Rome"},{"itineraryItemId":1348745699,"bookingDateTime":"2025-12-31T23:05:58Z","travelDate":"2026-12-17","productName":"Original Munich Christmas Market Tour with Festive Wine and Food","bookingStatus":"CONFIRMED","totalBookingAmount":"USD 484.68","commission":"USD 38.76","paymentStatus":"RESERVED","productCode":"252005P7","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":351,"excellentQuality":"Yes","bestConversion":"No","destination":"Munich"},{"itineraryItemId":1349266819,"bookingDateTime":"2026-01-02T15:20:03Z","travelDate":"2026-12-15","productName":"Montmartre or Notre Dame Gourmet Food Tour with 10 Dishes & Wines","bookingStatus":"CANCELLED","totalBookingAmount":"USD 0.00","commission":"USD 0.00","paymentStatus":"CANCELLED","productCode":"7812P1","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"cancellationDate":"2026-01-03T00:05:37Z","cancellationSource":"CUSTOMER","sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":347,"excellentQuality":"Yes","bestConversion":"No","destination":"Paris"},{"itineraryItemId":1349391193,"bookingDateTime":"2026-01-02T21:21:48Z","travelDate":"2026-01-03","productName":"Paseos en barco de aventura - Noches de luces junto al agua en St. Augustine FL","bookingStatus":"CONFIRMED","totalBookingAmount":"USD 160.00","commission":"USD 12.80","paymentStatus":"PAID","productCode":"320234P2","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":4,"sourceLink":"https://www.viator.com/St-Augustine/d823-ttd/p-239910P4?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":1,"excellentQuality":"Yes","bestConversion":"Yes","destination":"St Augustine"},{"itineraryItemId":1349560541,"bookingDateTime":"2026-01-03T10:29:49Z","travelDate":"2026-12-13","productName":"Louvre Museum: Guided Tour at Closing Time with Mona Lisa","bookingStatus":"CONFIRMED","totalBookingAmount":"USD 268.83","commission":"USD 21.51","paymentStatus":"RESERVED","productCode":"67584P8","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"US","totalTravellers":3,"sourceLink":"https://www.viator.com/Paris/d479-ttd/p-3731P275?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":344,"excellentQuality":"Yes","bestConversion":"No","destination":"Paris"},{"itineraryItemId":1350043873,"bookingDateTime":"2026-01-04T19:47:21Z","travelDate":"2026-02-03","productName":"Los Angeles and Hollywood Small Group Day Tour from Las Vegas","bookingStatus":"CONFIRMED","totalBookingAmount":"ZAR 9798.22","commission":"USD 48.74","paymentStatus":"PAID","productCode":"50793P5","medium":"link","campaign":"d619147e29001e5d708199a9adcc159ef44b06ce","customerCountryCode":"ZA","totalTravellers":2,"sourceLink":"https://www.viator.com/Las-Vegas/d684-ttd/p-50793P5?pid=P00277730&mcid=42383&medium=link&campaign=d619147e29001e5d708199a9adcc159ef44b06ce&gad_source=1","daysToTravel":30,"excellentQuality":"Yes","bestConversion":"No","destination":"Las Vegas"}],"hasExtendedAgentFields":false,"hasExtendedWhitelabelFields":false}';

    $data = json_decode($jsonString, true);
    $data = $data['extendedBookings'];

    foreach ($data as $key => $item) {
      $click = Click::query()
        ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
        ->select('link_histories.*', 'clicks.id as click_id')
        ->where('clicks.code', $item['campaign'])
        ->first();

      $sales = (floatval(substr($item['totalBookingAmount'], 4)) * self::USD_VND_RATE) / self::VAT_RATE;
      $sumcom = (floatval(substr($item['commission'], 4)) * self::USD_VND_RATE) / self::VAT_RATE;

      $comRate = CommissionRate::where('user_id', $click->user_id)
      ->pluck('rate')->first();

      if (!$comRate) {
        $comRate = 0.7;
      }

      $comRate = floatval($comRate);

      Conversion::upsert([
        'code' => sha1(time() + $key),
        'order_code' => $item['itineraryItemId'],
        'order_time' => Carbon::parse($item['bookingDateTime'])->format('Y-m-d H:i:s'),
        'unit_price' => $sales,
        'quantity' => 1,
        'commission_pub' => $sumcom * $comRate,
        'commission_sys' => $sumcom * (1 - $comRate),
        'status' => $item['bookingStatus'] == 'CANCELLED' ? 'Cancelled' : ($item['bookingStatus'] == 'CONFIRMED' ? 'Approved' : 'Pending'),
        'product_code' => $item['productCode'],
        'product_name' => $item['productName'],
        'campaign_id' => $click->campaign_id,
        'click_id' => $click->click_id,
        'user_id' => $click->user_id,
        'updated_at'    => now(),
      ], [
        'campaign_id',
        'order_code',
        'product_code',
      ], [
        'unit_price',
        'quantity',
        'commission_pub',
        'commission_sys',
        'status',
        'updated_at',
      ]);
    }

    return true;
  }
}
