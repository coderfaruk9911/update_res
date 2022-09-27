<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Expense;
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
        // $detailstData = DB::table('expenses')
        //  ->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
        //  ->select('expenses.*', 'suppliers.*', DB::raw('sum(total_amount) AS total'),DB::raw('sum(paid_amount) AS paid'),DB::raw('sum(due_amount) AS due'))
        //  ->groupBy('supplier_id')
        //  ->get();
        return view('admin.pages.reports.date_wise_supplier_reports');
    }


    public function dateWiseSupplierReportPost(Request $request){
        $from = $request->from;
        $to = $request->to;

        dd($to);
        // $title="Sales From: ".$from." To: ".$to;
        // $result = Expense::whereBetween('created_at', [$from.' 00:00:00',$to.' 23:59:59'])->get();
        // dd($result);

        $result = DB::table('expenses')
         ->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
         ->select('expenses.*', 'suppliers.*', DB::raw('sum(total_amount) AS total'),DB::raw('sum(paid_amount) AS paid'),DB::raw('sum(due_amount) AS due'))
         ->whereBetween('expenses.created_at', [$from.' 00:00:00',$to.' 23:59:59'])
         ->groupBy('supplier_id')
         ->get();

         dd($result);
        return view('admin.pages.reports.date_wise_supplier_reports');
    }
}
