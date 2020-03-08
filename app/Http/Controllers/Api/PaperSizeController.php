<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PaperSize;
use App\PrintQuality;
use App\PrintRate;
use Illuminate\Http\Request;

class PaperSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PaperSize::query();

        $paper_sizes = $query->paginate(100);

        return $paper_sizes;
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
            'description' => 'required|max:50',
            'dimension' => 'required|max:20',
        ];

        $request->validate($rule);

        $paper_size = PaperSize::create($request->all());

        foreach (PrintQuality::select('id')->get() as $pq) {
            PrintRate::create([
                'print_quality_id'  => $pq->id,
                'paper_size_id'     => $paper_size->id,
                'rate'              => 0
            ]);
        }

        return $paper_size;
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
