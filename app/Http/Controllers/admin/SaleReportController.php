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

        $todaySaleCount = Order::where('date',$today)->count();
        $currentWeekSaleCount = Order::where('created_at', '>=', $previousWeek)->count();
        $currentMonthCount = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $currentYearCount = Order::whereYear('created_at', Carbon::now()->year)->count();

        // $todaySaleData = Order::where('date',$today)->get();
        // $currentWeekSaleData = Order::where('date', '>=', $previousWeek)->get();
        // $currentMonthData = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        // $currentYearData = Order::whereYear('created_at', Carbon::now()->year)->get();

        return view('admin.pages.sale_report.index',compact('todaySaleCount','currentWeekSaleCount','currentMonthCount','currentYearCount'));
    }

    public function todaySales(){
        $today = Carbon::today()->toDateString();
        $previousWeek = Carbon::now()->subDays(7);
        $todaySaleData = Order::where('date',$today)->get();

        return view('admin.pages.sale_report.today_sale',compact('todaySaleData'));
    }
    public function weeklySales(){
        $previousWeek = Carbon::now()->subDays(7);
        $currentWeekSaleData = Order::where('date', '>=', $previousWeek)->get();

        return view('admin.pages.sale_report.weekly_sale',compact('currentWeekSaleData'));
    }

    public function monthlySales(){
        $currentMonthData = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();

        return view('admin.pages.sale_report.monthly_sale',compact('currentMonthData'));
    }

    public function yearlySales(){

        $currentYearData = Order::whereYear('created_at', Carbon::now()->year)->get();

        return view('admin.pages.sale_report.yearly_sale',compact('currentYearData'));
    }




    
    public function monthlyPaid(Request $request){
        $currentYearTotalBill = Bill::sum(DB::raw('January + February + March + April + May + June + July + August + September + October + November + December'));

        $PaidCustomers = Bill::get( array(
            DB::raw('SUM(January) as total_Jan'),
            DB::raw('SUM(February) as total_Feb'),
            DB::raw('SUM(March) as total_Mar'),
            DB::raw('SUM(April) as total_Apr'),
            DB::raw('SUM(May) as total_May'),
            DB::raw('SUM(June) as total_Jun'),
            DB::raw('SUM(July) as total_Jul'),
            DB::raw('SUM(August) as total_Aug'),
            DB::raw('SUM(September) as total_Sept'),
            DB::raw('SUM(October) as total_Oct'),
            DB::raw('SUM(November) as total_Nov'),
            DB::raw('SUM(December) as total_Dec'),

          ));

            return view('admin.pages.paid_month_report',compact('PaidCustomers','currentYearTotalBill'));
    }


    public function singleUser($id){
        $customer = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
        ->select('customers.*', 'packages.price')
        ->where('user_id',$id)->first();

        $totalBill = Bill::where('customer_id',$id)->sum(DB::raw('January + February + March + April + May + June + July + August + September + October + November + December'));


        return view('admin.pages.single_user_details', compact('customer','totalBill'));
    }


    public function SingleMonthReportView(){
        return view('admin.pages.single_month_index');
    }
    public function SingleMonthReportMonth($month_name){

        if($month_name=='January'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Jan',0)->where('Jan','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='February'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Feb',0)->where('Feb','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='March'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Mar',0)->where('Mar','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='April'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Apr',0)->where('Apr','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='May'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('May',0)->where('May','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='June'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Jun',0)->where('Jun','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='July'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Jul',0)->where('Jul','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='August'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Aug',0)->where('Aug','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='September'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Sept',0)->where('Sept','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='October'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Oct',0)->where('Oct','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='November'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Nov',0)->where('Nov','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='December'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Dec',0)->where('Dec','!=','inActive')->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }

        
    }

    public function SingleMonthPaidMonth($month_name){

        if($month_name=='January'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Jan',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='February'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Feb',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='March'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Mar',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='April'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Apr',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='May'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('May',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='June'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Jun',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='July'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Jul',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='August'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Aug',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='September'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Sept',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='October'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Oct',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='November'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Nov',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }
        if($month_name=='December'){

           $results = Customer::join('packages', 'customers.package_id', '=', 'packages.id')
           ->select('customers.*', 'packages.price')->where('Dec',1)->get();
            return view('admin.pages.single_month_customer_view',compact('results'));
        }

        
    }
}
