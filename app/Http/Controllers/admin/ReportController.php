<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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


    public function dateWiseSupplierReport(Request $request){
        $start_date = Carbon::parse( $request->form_date)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse( $request->to_date)->format('Y-m-d H:i:s'); ;
                                    

        $result = DB::table('expenses')
         ->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
         ->select('expenses.*', 'suppliers.*', DB::raw('sum(total_amount) AS total'),DB::raw('sum(paid_amount) AS paid'),DB::raw('sum(due_amount) AS due'))
         ->whereDate('expenses.created_at', '>=', $start_date)
         ->whereDate('expenses.created_at', '<=', $end_date)
         ->groupBy('supplier_id')
         ->get();
        return view('admin.pages.reports.date_wise_supplier_reports',compact('result'));
    }


    public function dateWiseSupplierReportPost(Request $request){
        $start_date = Carbon::parse( $request->form_date)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse( $request->to_date)->format('Y-m-d H:i:s'); ;
                                    

        $result = DB::table('expenses')
         ->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
         ->select('expenses.*', 'suppliers.*', DB::raw('sum(total_amount) AS total'),DB::raw('sum(paid_amount) AS paid'),DB::raw('sum(due_amount) AS due'))
         ->whereDate('expenses.created_at', '>=', $start_date)
         ->whereDate('expenses.created_at', '<=', $end_date)
         ->groupBy('supplier_id')
         ->get();
        return view('admin.pages.reports.date_wise_supplier_reports',compact('result'));
    }
}
