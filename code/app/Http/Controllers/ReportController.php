<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function export() 
    {
        // $ldate = date('Y-m-d H:i:s');
        return Excel::download(new ReportExport, 'All AE Account.xlsx');
    }
}
