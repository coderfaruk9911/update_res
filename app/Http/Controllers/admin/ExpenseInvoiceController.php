<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Supplier;
use App\Models\Stockproductlist;
use App\Models\Expensedetails;
use App\Models\Supplierduedetail;
use Carbon\Carbon;

class ExpenseInvoiceController extends Controller
{
    public function view(){
        $ExpenseList = Expense::all();
        return view('admin.pages.expense.index',compact('ExpenseList'));
    }

    public function addForm(){
        $all_supplier = Supplier::all();
        $lastInvoiceNumber = Expense::latest('invoice_number')->first();
        if($lastInvoiceNumber==null){
            $invoice_number = '000001';
        }else{
            $invoice_number = str_pad(($lastInvoiceNumber->invoice_number + 1),6, "0", STR_PAD_LEFT);
        }
        return view('admin.pages.expense.add_form',compact('invoice_number','all_supplier'));
    }





    public function autocomplete(Request $request)

    {

        $data = Stockproductlist::select("product_name as value", "id")

                    ->where('product_name', 'LIKE', '%'. $request->get('search'). '%')

                    ->get();

    

        return response()->json($data);

    }


    public function store(Request $request){
        $validated = $request->validate([
            'invoice_number' => 'required|unique:expenses',
            'invoice_date' => 'required',
            'total_amount' => 'required|numeric|digits_between:1,10',
            'paid_amount' => 'required|numeric|digits_between:1,10',
            'due_amount' => 'required|numeric|digits_between:1,10',
            'quantity' => 'required',
            'unit_price' => 'required',
            'unit' => 'required',
            'price' => 'required',
        ]);

        

        $data = new Expense();

        $data->invoice_number = $request->invoice_number;
        $data->invoice_date = $request->invoice_date;
        $data->supplier_id = $request->supplier_id;
        $data->total_amount = $request->total_amount;
        $data->paid_amount = $request->paid_amount;
        $data->due_amount = $request->due_amount;
        $result = $data->save();

        $supDue = Supplierduedetail::where('supplier_id',$request->supplier_id)
        ->where('date',$request->invoice_date)->first();
        if($supDue){
            $supDue->due_amount =  $supDue->due_amount + $request->due_amount;
            $supDue->total_amount = $supDue->total_amount + $request->total_amount;
            $supDue->paid_amount = $supDue->paid_amount + $request->paid_amount;
            $result = $supDue->save();
        }else{

        $Due = new Supplierduedetail();

        $Due->date = $request->invoice_date;
        $Due->supplier_id = $request->supplier_id;
        $Due->due_amount = $request->due_amount;
        $Due->total_amount = $request->total_amount;
        $Due->paid_amount = $request->paid_amount;
        $result = $Due->save();

        }

        


        if ($result) {
            foreach ($request->product_name as $key=>$product_name) { 
                $allreadyHave = Stockproductlist::where('product_name',$request->product_name[$key])->first();
                if($allreadyHave)
                {
                    $getproductid = Stockproductlist::where('product_name',$request->product_name[$key])->first(); 
                    $productId = $getproductid->id;
                    $sumUnit = Stockproductlist::where('id',$productId)->sum('unit');

                    if($request->quantity[$key] == $request->unit[$key]){
                        $getproductid->unit = $request->unit[$key]+$sumUnit;
                        //$eDetails->total_quantity = $request->unit[$key];
                    }else{
                        if( $request->unit_title[$key]=="gm" || $request->unit_title[$key]=="ml"){
                            $convert = $request->quantity[$key] / 1000;
                           // $eDetails->total_quantity = $request->unit[$key] * $convert;
                            $getproductid->unit = ($request->unit[$key] * $convert)+$sumUnit; 
                        }else{
                           // $eDetails->total_quantity = $request->unit[$key] * $request->total_quantity[$key];
                            $getproductid->unit = ($request->unit[$key] * $request->quantity[$key])+$sumUnit;  
                        }
                                          
                    }
                    
                    $getproductid->save();
                }
                else{

                    $pName = new Stockproductlist();
                    $pName->product_name = $request->product_name[$key];

                    if($request->quantity[$key] == $request->unit[$key]){
                        $pName->unit = $request->unit[$key];
                        //$eDetails->total_quantity = $request->unit[$key];
                    }else{
                        if( $request->unit_title[$key]=="gm" || $request->unit_title[$key]=="ml"){
                            $convert = $request->quantity[$key] / 1000;
                           // $eDetails->total_quantity = $request->unit[$key] * $convert;
                           $pName->unit = $request->unit[$key] * $convert; 
                        }else{
                           // $eDetails->total_quantity = $request->unit[$key] * $request->total_quantity[$key];
                           $pName->unit = $request->unit[$key] * $request->quantity[$key];  
                        }
                                          
                    }
                   // $pName->unit = $request->unit[$key];
                    $done=$pName->save();
                }     
            }
            
            foreach ($request->product_name as $key=>$product_name) {

                $getproductid = Stockproductlist::where('product_name',$request->product_name[$key])->first(); 
                $productId = $getproductid->id;


                $eDetails = new Expensedetails();
                $eDetails->quantity = $request->quantity[$key];
                $eDetails->unit_title = $request->unit_title[$key];
                $eDetails->product_id = $productId;
                $eDetails->expense_id = $request->invoice_number;
                $eDetails->unit_price = $request->unit_price[$key];
                $eDetails->unit = $request->unit[$key];
                $eDetails->price = $request->price[$key];
                if($request->quantity[$key] == $request->unit[$key]){
                    $eDetails->total_quantity = $request->unit[$key];
                }else{
                    if( $request->unit_title[$key]=="gm" || $request->unit_title[$key]=="ml"){
                        $convert = $request->quantity[$key] / 1000;
                        $eDetails->total_quantity = $request->unit[$key] * $convert; 
                    }else{
                        $eDetails->total_quantity = $request->unit[$key] * $request->quantity[$key]; 
                    }
                                      
                }
                
                $done=$eDetails->save(); 
            }


            $notification = array(
                'messege' => 'Invoice Add Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('expense_invoice.view')->with($notification);
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


    public function redirect(){
        return redirect()->route('order_item.view');
    }
}
