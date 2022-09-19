<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use PDF;

class PDFSaleSReportController extends Controller
{
    public function todaysSalePdf()
    {   
        $today = Carbon::today()->toDateString();
        $todaysTotal = Order::where('date',$today)->sum('paid_amount');
        $todaySaleData = Order::where('date',$today)->get();

        $name = 'todays_sale-'.date('m-d-Y-h-i').'.'.'pdf';
        
        
        $data = [
            'todaysTotal' => $todaysTotal,
            'todaySaleData' => $todaySaleData
        ];
          
        $pdf = PDF::loadView('admin.pages.pdf.todays_sale_pdf', $data);
    
        return $pdf->download($name);
    }


    public function weeklySalePdf()
    {   
        $currentWeekSaleData = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('created_at','desc')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
       });

        $currentWeekTotal = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('paid_amount');Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('paid_amount');

        $name = 'weekly_sale-'.date('m-d-Y-h-i').'.'.'pdf';
        
        
        $data = [
            'currentWeekSaleData' => $currentWeekSaleData,
            'currentWeekTotal' => $currentWeekTotal
        ];
          
        $pdf = PDF::loadView('admin.pages.pdf.weekly_sale_pdf', $data);
    
        return $pdf->download($name);
    }


    public function monthlySalePdf()
    {   
        $currentMonthData = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
       });
        $currentMonthTotal = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount');

        $name = 'monthly_sale-'.date('m-d-Y-h-i').'.'.'pdf';
        
        
        $data = [
            'currentMonthData' => $currentMonthData,
            'currentMonthTotal' => $currentMonthTotal
        ];
          
        $pdf = PDF::loadView('admin.pages.pdf.monthly_sale_pdf', $data);
    
        return $pdf->download($name);
    }


    public function yearlySalePdf()
    {   
        $currentYearData = Order::whereYear('created_at', Carbon::now()->year)->get();
        $currentYearTotal = Order::whereYear('created_at', Carbon::now()->year)->sum('paid_amount');

        $name = 'yearly_sale-'.date('m-d-Y-h-i').'.'.'pdf';
        
        
        $data = [
            'currentYearData' => $currentYearData,
            'currentYearTotal' => $currentYearTotal
        ];
          
        $pdf = PDF::loadView('admin.pages.pdf.yearly_sale', $data);
    
        return $pdf->download($name);
    }

    public function searchByDate($date){
        $datewiseData = Order::where('date', $date)->get();
        $datewiseTotal = Order::where('date', $date)->sum('paid_amount');

        return view('admin.pages.pdf.date_wise_sale',compact('datewiseData','datewiseTotal'));

    }


}
