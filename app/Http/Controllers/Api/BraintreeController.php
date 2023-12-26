<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Api\OrdersController as ApiOrdersController;
use App\Models\Part;

class BraintreeController extends Controller
{
    public function getClientToken()
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        return response()->json(['clientToken' => $gateway->clientToken()->generate()]);
    }

    public function checkout(Request $request)
    {

        $nonce = $request->input('paymentMethodNonce');

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $orderItems = $request->input('orderItems');

        //calcolo del totale da pagare
        $totalToPay = 0;

        foreach ($orderItems as $itemData) {
            $part = Part::find($itemData['id']);
            $itemData['subtotal'] = $part->price * $itemData['quantity'];
            $totalToPay += $itemData['subtotal'];
        }

        \Log::info('Tot da pagare:', ['totalToPay' => $totalToPay]);

        $result = $gateway->transaction()->sale([
            'amount' => $totalToPay, 
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        
        if ($result->success) {

            // Estrai solo le colonne necessarie da ciascun item
            $filteredOrderItems = array_map(function ($item) {
                return [
                    'part_id' => $item['id'],
                    'quantity_ordered' => $item['quantity'],
                ];
            }, $orderItems);

            \Log::info('Contenuto di orderItems:', $filteredOrderItems);
            
            try {
                
                $ordersController = app('App\Http\Controllers\Api\OrdersController');
                $response = $ordersController->store(new Request(['orderItems' => $filteredOrderItems]));

                if ($response->getStatusCode() === 201) {

                    $responseData = $response->getOriginalContent();

                    \Log::info('RespData:', ['resp' => $responseData]);
        
                    if (isset($responseData['order']['order_number'])) {
                        $orderNumber = $responseData['order']['order_number'];
                        return response()->json(['success' => true, 'order_number' => $orderNumber]);
                    } else {
                        return response()->json(['success' => false, 'error' => 'Numero d\'ordine non trovato nei dati dell\'ordine']);
                    }

                } else {
                    return response()->json(['success' => false, 'error' => 'Errore durante la chiamata a OrdersController@store' . $response->getStatusCode()]);
                }

            } catch (\Throwable $e) {
                \Log::error('Errore durante la creazione dell\'ordine: ' . $e->getMessage());
            }

            
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }
}
