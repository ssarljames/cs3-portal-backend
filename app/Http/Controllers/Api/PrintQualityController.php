<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaperSize;
use App\Models\PrintQuality;
use App\Models\ServiceRate;
use App\Models\ServiceTransaction;
use Illuminate\Http\Request;

class PrintQualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PrintQuality::query();

        $print_qualities = $query->paginate(20);

        return $print_qualities;
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
            'description' => 'required|max:50'
        ];

        $request->validate($rule);

        $print_quality = PrintQuality::create($request->all());

        foreach (PaperSize::select('id')->get() as $ps) {
            ServiceRate::create([
                'type'              => ServiceTransaction::PRINT,
                'print_quality_id' => $print_quality->id,
                'paper_size_id'     => $ps->id,
                'rate'              => 0
            ]);
        }

        return $print_quality;
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
