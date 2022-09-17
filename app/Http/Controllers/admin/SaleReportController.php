<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;


class SaleReportController extends Controller
{
    public function view(){
        $today = Carbon::today()->toDateString();
        $previousWeek = Carbon::now()->subDays(7);

        // $todaySaleCount = Order::where('date',$today)->count();
        // $currentWeekSaleCount = Order::where('created_at', '>=', $previousWeek)->count();
        // $currentMonthCount = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        // $currentYearCount = Order::whereYear('created_at', Carbon::now()->year)->count();

        $todaySaleSum = Order::where('date',$today)->sum('paid_amount');
        $currentWeekSaleSum = Order::where('created_at', '>=', $previousWeek)->sum('paid_amount');
        $currentMonthSum = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');
        $currentYearSum = Order::whereYear('created_at', Carbon::now()->year)->sum('paid_amount');

        return view('admin.pages.sale_report.index',compact('todaySaleSum','currentWeekSaleSum','currentMonthSum','currentYearSum'));
    }

    public function todaySales(){
        $today = Carbon::today()->toDateString();
        $todaysTotal = Order::where('date',$today)->sum('paid_amount');
        $todaySaleData = Order::where('date',$today)->get();

        return view('admin.pages.sale_report.today_sale',compact('todaySaleData','todaysTotal'));
    }
    public function weeklySales(){
        $previousWeek = Carbon::now()->subDays(7);
        $currentWeekSaleData = Order::where('date', '>=', $previousWeek)->get();
        $currentWeekTotal = Order::where('date', '>=', $previousWeek)->sum('paid_amount');

        return view('admin.pages.sale_report.weekly_sale',compact('currentWeekSaleData','currentWeekTotal'));
    }

    public function monthlySales(){
        $currentMonthData = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        $currentMonthTotal = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');

        return view('admin.pages.sale_report.monthly_sale',compact('currentMonthData','currentMonthTotal'));
    }

    public function yearlySales(){

        $currentYearData = Order::whereYear('created_at', Carbon::now()->year)->get();
        $currentYearTotal = Order::whereYear('created_at', Carbon::now()->year)->sum('paid_amount');

        return view('admin.pages.sale_report.yearly_sale',compact('currentYearData','currentYearTotal'));
    }



}
