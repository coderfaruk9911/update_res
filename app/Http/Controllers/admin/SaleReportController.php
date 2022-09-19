<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;


class SaleReportController extends Controller
{
    public function view(Request $request){
        
        $today = Carbon::today()->toDateString();
        $datewiseData = Order::where('date', $request->date)->get();
        $datewiseTotal = Order::where('date', $request->date)->sum('paid_amount');
        $date =$request->date;

        // $todaySaleCount = Order::where('date',$today)->count();
        // $currentWeekSaleCount = Order::where('created_at', '>=', $previousWeek)->count();
        // $currentMonthCount = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        // $currentYearCount = Order::whereYear('created_at', Carbon::now()->year)->count();

        $todaySaleSum = Order::where('date',$today)->sum('paid_amount');
        $currentWeekSaleSum = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('paid_amount');
        $currentMonthSum = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');
        $currentYearSum = Order::whereYear('created_at', Carbon::now()->year)->sum('paid_amount');

        return view('admin.pages.sale_report.index',compact('todaySaleSum','currentWeekSaleSum','currentMonthSum','currentYearSum','datewiseData','datewiseTotal','date'));
    }

    public function todaySales(){
        $today = Carbon::today()->toDateString();
        $todaysTotal = Order::where('date',$today)->sum('paid_amount');
        $todaySaleData = Order::where('date',$today)->get();

        return view('admin.pages.sale_report.today_sale',compact('todaySaleData','todaysTotal'));
    }
    public function weeklySales(){
        $currentWeekSaleData = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('created_at','desc')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
       });
        $currentWeekTotal = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('paid_amount');

        return view('admin.pages.sale_report.weekly_sale',compact('currentWeekSaleData','currentWeekTotal'));
    }

    public function monthlySales(){
        $currentMonthData = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->orderBy('created_at','desc')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
       });
    //    dd($currentMonthData->toArray());
        $currentMonthTotal = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');

        return view('admin.pages.sale_report.monthly_sale',compact('currentMonthData','currentMonthTotal'));
    }

    public function yearlySales(){

        $currentYearData = Order::whereYear('created_at', Carbon::now()->year)->get();
        $currentYearTotal = Order::whereYear('created_at', Carbon::now()->year)->sum('paid_amount');

        return view('admin.pages.sale_report.yearly_sale',compact('currentYearData','currentYearTotal'));
    }



    public function searchByDate(Request $request){
        $today = Carbon::today()->toDateString();

        $todaySaleSum = Order::where('date',$today)->sum('paid_amount');
        $currentWeekSaleSum = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('paid_amount');
        $currentMonthSum = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');
        $currentYearSum = Order::whereYear('created_at', Carbon::now()->year)->sum('paid_amount');

        $datewiseData = Order::where('date', $request->date)->get();
        $datewiseTotal = Order::where('date', $request->date)->sum('paid_amount');
        $date = $request->date;

        if(count($datewiseData) > 0){
            return view('admin.pages.sale_report.index',compact('todaySaleSum','currentWeekSaleSum','currentMonthSum','currentYearSum','datewiseData','datewiseTotal','date'));
        }else{
            $notification = array(
                'messege' => 'Item Not Found! Please try Another Date',
                'alert-type' => 'error'
            );
            return redirect()->route('sale_report.view')->with($notification);
        }

    }

}
