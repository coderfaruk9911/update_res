<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menuitem;
use App\Models\Orderdetail;

class OrderController extends Controller
{
    public function view(){
        $OrderList = Order::all();
        return view('admin.pages.order.index',compact('OrderList'));
    }

    public function addForm(){

        $lastInvoiceNumber = Order::latest('invoice_number')->first();
        if($lastInvoiceNumber==null){
            $invoice_number = '000001';
        }else{
            $invoice_number = str_pad(($lastInvoiceNumber->invoice_number + 1),6, "0", STR_PAD_LEFT);
        }
        return view('admin.pages.order.add_form',compact('invoice_number'));
    }





    public function autocomplete(Request $request)

    {

        $data = Menuitem::select("item_name as value", "id",'price')
                    ->where('item_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        return response()->json($data);

    }


    public function store(Request $request){
        $validated = $request->validate([
            'invoice_number' => 'required|unique:orders',
            'total_amount' => 'required|numeric|digits_between:1,10',
            'paid_amount' => 'required|numeric|digits_between:1,10',
            'item_name' => 'required',
            'item_quantity' => 'required',
            'unit_price' => 'required',
            'price' => 'required',
        ]);

        $data = new Order();

        $data->invoice_number = $request->invoice_number;
        $data->date = $request->date;
        $data->table_number = $request->table_number;
        $data->total_amount = $request->total_amount;
        $data->paid_amount = $request->paid_amount;
        $data->discount_amount = $request->discount_amount;
        $result = $data->save();

        

        if ($result) {
            foreach ($request->item_name as $key=>$item_name) { 
                $orderDetail = new Orderdetail();
                $orderDetail->item_name = $request->item_name[$key];
                $orderDetail->item_quantity = $request->item_quantity[$key];
                $orderDetail->unit_price = $request->unit_price[$key];
                $orderDetail->price = $request->price[$key];
               
                $Submit = $orderDetail->save();
                   
            }
            $notification = array(
                'messege' => 'Order Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('order_item.view')->with($notification);
        }
    }



    public function show($id){
        $showData = Expensedetails::join('expenses', 'expenses.invoice_number', '=', 'expensedetails.expense_id')
                ->join('stockproductlists', 'stockproductlists.id', '=', 'expensedetails.product_id')
                ->select( 'expenses.*' , 'expensedetails.*','stockproductlists.product_name')
                ->where('expenses.id', '=', $id)
                ->get();
        return view('admin.pages.expense.show', compact('showData'));
    }

    public function edit($id){
        $all_supplier = Supplier::all();
        $editData = Expensedetails::join('expenses', 'expenses.invoice_number', '=', 'expensedetails.expense_id')
                ->join('stockproductlists', 'stockproductlists.id', '=', 'expensedetails.product_id')
                ->select( 'expenses.*' , 'expensedetails.*','stockproductlists.product_name')
                ->where('expenses.id', '=', $id)
                ->first();
                // dd( $editData);
        return view('admin.pages.expense.edit', compact('editData','all_supplier'));
    }




    public function update(Request $request, $id){
        $validated = $request->validate([
            'invoice_date' => 'required',
            'product_name' => 'required|max:191',
            'total_amount' => 'required|numeric|digits_between:1,10',
            'paid_amount' => 'required|numeric|digits_between:1,10',
            'due_amount' => 'required|numeric|digits_between:1,10',
        ]);

        $data = Expense::findOrFail($id);

        $data->invoice_date = $request->invoice_date;
        $data->product_name = $request->product_name;
        $data->total_amount = $request->total_amount;
        $data->paid_amount = $request->paid_amount;
        $data->due_amount = $request->due_amount;
        $result = $data->save();

        if ($result) {
            $notification = array(
                'messege' => 'Invoice Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('expense_invoice.view')->with($notification);
        }
        
    }

    public function delete($id){

        $result = Expense::findOrFail($id);
        $multiRow = Expensedetails::where('expense_id',$result->invoice_number)->get();
        
        foreach($multiRow as $row){
            $productNameId = Stockproductlist::where('id',$row->product_id)->first();
            $update = $productNameId->unit - $row->unit;
            $productNameId->unit = $update;
            $productNameId->save();
        }
        
        $multidelete = Expensedetails::where('expense_id',$result->invoice_number)->delete();
        $result->delete();
        if ($result) {
            $notification = array(
                'messege' => 'Expense Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('expense_invoice.view')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Something Went Wrong ! Please Try Again',
                'alert-type' => 'success'
            );
        }
       
    }
}
