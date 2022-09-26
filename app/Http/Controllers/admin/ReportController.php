<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function allSupplierReport(){
        $detailstData = DB::table('expenses')
         ->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
         ->select('expenses.*', 'suppliers.*', DB::raw('sum(total_amount) AS total'),DB::raw('sum(paid_amount) AS paid'),DB::raw('sum(due_amount) AS due'))
         ->groupBy('supplier_id')
         ->get();
        return view('admin.pages.reports.all_supplier_reports',compact('detailstData'));
    }
}
