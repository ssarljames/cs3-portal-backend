<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ServiceTransaction::query();

        $query->stationId($request->station_id)
                ->fromTime($request->time);

        $query->with('customer')
            ->orderBy('time', 'desc');

        return $query->paginate($request->page_size ? $request->page_size : $this->defaultPageSize);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'station_id' => 'required',
            'customer_user_id' => 'required',
            'transaction_items.*.type' => 'required|in:1,2',
            'transaction_items.*.paper_size_id' => $request->type == ServiceTransaction::PRINT ? 'required':'',
            'transaction_items.*.print_quality_id' => $request->type == ServiceTransaction::PRINT ? 'required':'',
            'transaction_items.*.quantity' => 'required|numeric|min:1',
            'transaction_items.*.price' => 'required|numeric'
        ];

        $request->validate($rules);

        DB::beginTransaction();

        try{

            $sales = 0;
            foreach ($request->transaction_items as $item) {
                $sales += $item['quantity'] * $item['price'];
            }

            $transaction = ServiceTransaction::create([
                'station_id' => $request->station_id,
                'user_id' => $request->user()->id,
                'customer_user_id' => $request->customer_user_id,
                'sales' => $sales,
                'time' => now()
            ]);

            foreach ($request->transaction_items as $item) {
                $transaction->items()->create([
                    'type' => $item['type'],
                    'paper_size_id' => $item['paper_size_id'],
                    'print_quality_id' => $item['print_quality_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price']
                ]);
            }


            DB::commit();



            return $transaction->load('customer');

        }catch(Exception $e){
            DB::rollBack();

            return response()->json(['error' => $e], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
