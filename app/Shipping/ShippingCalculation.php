<?php

namespace App\Shipping;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Order;

class ShippingCalculation
{
   public function shipping(Order $order)
   {

       // return $order->products->count();
        foreach($order->products as $product){
           $products[]= array(
                "description"=> $product->name,
                "declared_value"=> $product->price,
                "weight"=> $product->weight,
                "height"=> $product->height,
                "length"=>$product->length,
                "width"=> $product->width
           );
        }
       $body = [
            "consignments"=>[[
                "customer_code"=> "HRYRYN 01",
                "reference_number"=> "",
                "service_type_id"=> "B2C",
                "load_type"=> "NON-DOCUMENT",
                "description"=> "Skyhome Items",
                "cod_favor_of"=> "",
                "dimension_unit"=> "cm",
                "length"=> "",
                "width"=> "",
                "height"=> "",
                "weight_unit"=> "kg",
                "weight"=> "4.050",
                "declared_value"=> $order->total,
                "declared_price"=> "",
                "cod_amount"=> $order->total,
                "cod_collection_mode"=> "Cash",
                "prepaid_amount"=> "",
                "num_pieces"=> $order->products->count(),
                "customer_reference_number"=> $order->id,
                "is_risk_surcharge_applicable"=> true,
                "origin_details"=> [
                    "name"=> "Harayr Alrayan - Skyhome",
                    "phone"=> "0138309008",
                    "alternate_phone"=> "0138309008",
                    "address_line_1"=>"Souq Al hub – 12th street",
                    "address_line_2"=>"prince Bandar street – Al-suwaiket",
                    "city"=>"Dammam",
                    "state"=> "Eastern Province"
                ],
                "destination_details"=>[
                    "name"=>$order->first_name.' '.$order->last_name,
                    "phone"=>$order->phone,
                    "alternate_phone"=> "",
                    "address_line_1"=> $order->address,
                    "address_line_2"=> "",
                    "city"=>$order->city,
                    "state"=> $order->state
                ],
                "pieces_detail"=> $products
             ]
            ]
         ];

    //     $response = Http::withHeaders([
    //      'api-key' => '53f04e4b718f40be666131096af5d3',
    //      'Content-Type' => 'application/json'
    //     ])->get('https://demodashboardapi.shipsy.in/api/customer/integration/consignment/track?reference_number=TT126922');
    //   dd($response->body());


     $response = Http::withHeaders([
         'api-key' => 'bb91ff378f727b3cc9894e9a32c387',
         'Content-Type' => 'application/json'
        ])->post('https://api.zajil-express.com/api/customer/integration/consignment/softdata', $body);
        //return $response->body();
    return json_decode($response->body())->data[0]->reference_number ;

   }
}
