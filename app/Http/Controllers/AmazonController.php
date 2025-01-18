<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Revolution\Amazon\ProductAdvertising\Facades\AmazonProduct;

class AmazonController extends Controller
{

    public function show()
    {

        $response = AmazonProduct::search(category: 'All', keyword: 'desk lamp for home office' , page: 1);

        // ASIN
        // BrowseNodeInfo.WebsiteSalesRank.SalesRank (lowest likely to be 'Best Seller')
        // Offers.Listings.DeliveryInfo.IsPrimeEligible (boolean - prime)
        // Offers.Listings.Price.Amount (decimal)
        // Offers.Listings.Price.Currency (eg. GBP)
        // Offers.Listings.SavingBasis.Amount (decimal) (product's normal price - 'SavingBasis' won't exist if not on offer)
        // Images.Primary.Small.URL (primary image 75x75)

        //$response = AmazonProduct::item(asin: 'B000PH7UAQ');

        //$response = AmazonProduct::items(asin: ['B000PH7UAQ', 'ASIN2']);

        // $response = AmazonProduct::browse(node: '560800'); << works

        dd($response['SearchResult']['Items']);

    }
}
