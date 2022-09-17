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
        $previousWeek = Carbon::now()->subDays(7);
        $currentWeekSaleData = Order::where('date', '>=', $previousWeek)->get();
        $currentWeekTotal = Order::where('date', '>=', $previousWeek)->sum('paid_amount');

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
        $currentMonthData = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
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


}
