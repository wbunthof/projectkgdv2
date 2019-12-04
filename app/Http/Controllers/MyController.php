<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport,"1214.xlsx");
    }
}
