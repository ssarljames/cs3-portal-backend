<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PrintRate;
use Illuminate\Http\Request;

class PrintRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PrintRate::query();

        $query->updatedRates();

        $query->with('paper_size', 'print_quality');
        // $query->orderBy('created_at', 'desc');
        $print_rates = $query->paginate(100);

        return $print_rates;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'paper_size_id' => 'required',
            'print_quality_id' => 'required',
            'rate'              => 'required|numeric'
        ];

        $request->validate($rule);

        $pr = PrintRate::create($request->all());

        return $pr;
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
