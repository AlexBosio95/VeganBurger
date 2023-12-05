<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $orderItemsData = $request->input('orderItems');
        
        // Verifica che $orderItems sia un array
        if (!is_array($orderItemsData) || empty($orderItemsData)) {
            return response()->json(['error' => 'Devi fornire almeno un orderItem.'], 400);
        }

        try {

            try {
                // Valida i dati dell'ordine
                $this->validate($request, [
                    'orderItems.*.part_id' => 'required|exists:parts,id',
                    'orderItems.*.quantity_ordered' => 'required|integer|min:1',
                ]);
            } catch (ValidationException $e) {
                // Gestisci gli errori di validazione se necessario
                return response()->json(['error' => 'Dati inseriti non validi'], 400);
            }
            
            // Crea un nuovo ordine
            $order = new Order([
                'order_number' => 'OR' . date('Ymd') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
                'status' => 'pending',
                'order_date' => Carbon::now(),
                'arrival_date' => Carbon::now(),
            ]);

            try {
                $order->save();
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Non è stato possibile salvare l\'ordine' . $th], 400);
            }
            

            // Crea e collega ciascun orderItem all'ordine
            $orderItems = [];
            foreach ($orderItemsData as $itemData) {

                $part = Part::find($itemData['part_id']);
                $itemData['unit_price'] = $part->price;
                $itemData['subtotal'] = $part->price * $itemData['quantity_ordered'];
                $orderItem = new Orderitem($itemData);
                $orderItem->order()->associate($order);
                $orderItem->save();
                $orderItems[] = $orderItem;
            }

            return response()->json([
                'message' => 'Ordine creato con successo',
                'order' => $order,
                'orderItems' => $orderItems,
            ], 201);

        } catch (\Throwable $e) {
            // Gestisci eventuali eccezioni qui
            return response()->json(['error' => 'Si è verificato un errore durante la creazione dell\'ordine.'], 500);
        }
    }


}
