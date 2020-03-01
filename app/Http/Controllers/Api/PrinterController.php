<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Printer;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Printer::query();

        $printers = $query->paginate();

        return $printers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Printer $printer)
    {
        return $printer->append('current_session');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Printer $printer)
    {
        if($request->set_session_user_id){
            if($request->user()->id == $request->set_session_user_id && $printer->current_session == null){
                $printer->usages()->create([
                    'user_id' => $request->set_session_user_id,
                    'start' => now()
                ]);
            }
        }

        elseif($request->unset_session_user_id){
            if($request->user()->id == $request->unset_session_user_id){
                $usage = $printer->usages()
                            ->where('user_id', $request->unset_session_user_id)
                            ->where('end', null)
                            ->latest()
                            ->first();

                if($usage)
                    $usage->update([
                        'end' => now()
                    ]);
            }
        }

        return $this->show($printer);
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
