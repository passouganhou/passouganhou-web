<?php

namespace App\Http\Controllers;

use App\Exports\ExportContact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new ExportContact($request->input('filter')), 'forms-passou-ganhou.xlsx');

        return redirect()->back();
    }
}
