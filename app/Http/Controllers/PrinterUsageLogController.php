<?php

namespace App\Http\Controllers;

use App\PrinterUsageLog;
use Illuminate\Http\Request;

class PrinterUsageLogController extends Controller
{
    public function index(Request $request){
        $query = PrinterUsageLog::latest();

        $printer_usage_logs = $query->paginate(100);

        return view('printer-usage-logs.index', compact('printer_usage_logs'));
    }
}
