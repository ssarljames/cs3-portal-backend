<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceRate;
use App\Models\ServiceTransaction;
use Illuminate\Http\Request;

class ServiceRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ServiceRate::query();

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
            'type' => 'required',
            'paper_size_id' => $request->type == ServiceTransaction::PRINT ? 'required' : 'nullable',
            'print_quality_id' => $request->type == ServiceTransaction::PRINT ? 'required' : 'nullable',
            'rate'              => 'required|numeric|max:99'
        ];

        $data = $request->validate($rule);

        $sr = ServiceRate::create( $data );

        return $sr;
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
