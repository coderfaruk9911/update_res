<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menuitem;
use App\Models\Orderdetail;
use App\Models\Expense;
use App\Models\Expensedetails;
use PDF;

class PDFController extends Controller
{
    public function generatePDF($id)
    {   
        date_default_timezone_set("Asia/Dhaka");
        $order = Order::findOrFail($id);
        $orderdetials = Orderdetail::join('menuitems','menuitems.id','orderdetails.item_id')
        ->where('invoice_id',$order->invoice_number)->get();
        $name = 'Order-'.date('m-d-Y-h-i').'.'.'pdf';
        
        // dd($name);
        
        
        $data = [
            'order' => $order,
            'orderdetials' => $orderdetials
        ];
          
        $pdf = PDF::loadView('admin.pages.pdf.order_invoice', $data);
    
        return $pdf->download($name);
    }



    public function expenseInvoice($id)
    {   
        date_default_timezone_set("Asia/Dhaka");
        $expenses = Expense::join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')->findOrFail($id);
        $expensesDetails = Expensedetails::join('stockproductlists', 'stockproductlists.id', '=', 'expensedetails.product_id')
        ->select( 'expensedetails.*','stockproductlists.product_name')
        ->where('expense_id', '=', $expenses->invoice_number)
        ->get();

        $name = 'Expense-'.date('m-d-Y-h-i').'.'.'pdf';
        
        $data = [
            'expenses' => $expenses,
            'expensesDetails' => $expensesDetails
        ];
        
        
          
        $pdf = PDF::loadView('admin.pages.pdf.expense_invoice', $data);
    
        return $pdf->download($name);
    }



}
