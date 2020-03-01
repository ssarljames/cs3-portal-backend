<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Printer;
use App\PrintTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrintTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'printer_id' => 'required'
        ]);

        $printer = Printer::findOrFail($request->printer_id);

        $query = $printer->transactions()
                    ->where('created_at', '>=', $printer->current_session ? $printer->current_session['start_time'] : now());

        $query->transactionBy($printer->current_session['user']->id);
        $query->latest();

        $query->with('member');

        $transactions = $query->paginate();

        return $transactions;
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
            'printer_id'=> 'required|exists:printers,id',
            'member_id' => 'required',
            'time'      => "required:date_format:'M d, Y h:i A'",
            'transaction_items.*.size' => 'required|numeric|min:1',
            'transaction_items.*.quality' => 'required|numeric|min:1',
            'transaction_items.*.quantity' => 'required|numeric|min:1',
            'transaction_items.*.price' => 'required|numeric|min:1',
        ];


        $request->validate($rules);

        $transaction = $request->user()->print_transactions()->create([
            'printer_id' => $request->printer_id,
            'member_id' => $request->member_id,
            'time' => Carbon::createFromFormat('M d, Y h:i A', $request->time)
        ]);

        foreach ($request->transaction_items as $t)
            $transaction->print_transaction_items()->create($t);

        $transaction->updateSales();

        return $transaction;
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
