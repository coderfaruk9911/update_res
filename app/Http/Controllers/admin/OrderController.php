<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menuitem;
use App\Models\Orderdetail;
use PDF;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function view(){

        $OrderList = Order::orderBy('id', 'desc')->where('created_at', '>=', Carbon::today())->get();
        // $lastRow = Order::latest('id')->first();
        // $lastInsertId = $lastRow->id;

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
        date_default_timezone_set("Asia/Dhaka");


           
                foreach ($request->item_name as $key=>$item_name) { 
                    $getproductid = Menuitem::where('item_name',$request->item_name[$key])->first(); 
                    if(empty($getproductid)){
                         
                         Orderdetail::where('invoice_id',$request->invoice_number)->delete();

                        $notification = array(
                            'messege' => 'Item Not Available',
                            'alert-type' => 'error'
                        );
                        return redirect()->route('order_item.view')->with($notification);
                    }
                    else{
                        $productId = $getproductid->id;
                    $orderDetail = new Orderdetail();
                    $orderDetail->item_id = $productId;
                    $orderDetail->invoice_id = $request->invoice_number;
                    $orderDetail->item_quantity = $request->item_quantity[$key];
                    $orderDetail->unit_price = $request->unit_price[$key];
                    $orderDetail->price = $request->price[$key];
                   
                    $Submit = $orderDetail->save();
                    }   
                

            }

            $data = new Order();

            $data->invoice_number = $request->invoice_number;
            $data->date = $request->date;
            $data->table_number = $request->table_number;
            $data->total_amount = $request->total_amount;
            $data->paid_amount = $request->paid_amount;
            $data->discount_amount = $request->discount_amount;
            $data->delivery_charge = $request->delivery_charge;
            $data->paid_status = '0';
            $data->cus_contact_number = $request->cus_contact_number;
            $result = $data->save();
            

            if($result){
            $notification = array(
                'messege' => 'Order Added Successfully',
                'alert-type' => 'success'
            );
            // return redirect()->route('order_item.view')->with($notification);

            date_default_timezone_set("Asia/Dhaka");
            $lastInsertId = DB::getPdo()->lastInsertId();
            

            $order =Order::where('id',$lastInsertId)->first(); 
            $orderdetials = Orderdetail::join('menuitems','menuitems.id','orderdetails.item_id')
            ->where('invoice_id',$order->invoice_number)->get();

            $name = 'Order-'.date('m-d-Y-h-i').'.'.'pdf';

            $data = [
                'order' => $order,
                'orderdetials' => $orderdetials,
                'invoice_numbe' => $request->invoice_numbe,
                'date' => $request->date,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'discount_amount' => $request->discount_amount,
            ];
              
            $pdf = PDF::loadView('admin.pages.pdf.auto_invoice', $data);
        
            return $pdf->download($name);
        }
        
    }



    public function show($id){
        $showData = Orderdetail::join('orders', 'orders.invoice_number', '=', 'orderdetails.invoice_id')
                ->join('menuitems', 'menuitems.id', '=', 'orderdetails.item_id')
                ->select( 'orders.*' , 'orderdetails.*','menuitems.item_name')
                ->where('orders.invoice_number', '=', $id)
                ->get();
        return view('admin.pages.order.show', compact('showData'));
    }

    public function edit($id){
        $total = Orderdetail::where('invoice_id',$id)->sum('price');

         $editData = Orderdetail::join('orders', 'orders.invoice_number', '=', 'orderdetails.invoice_id')
                ->join('menuitems', 'menuitems.id', '=', 'orderdetails.item_id')
                ->select( 'orders.*' , 'orderdetails.*','menuitems.item_name')
                ->where('orders.invoice_number', '=', $id)
                ->get();

        return view('admin.pages.order.edit',compact('editData','total'));
    }




    public function update(Request $request, $id){
           $s=0;
            foreach ($request->item_name as $key=>$item_name) { 
                
                $getproductid = Menuitem::where('item_name',$request->item_name[$key])->first(); 
                if(empty($getproductid)){
                    
                    Orderdetail::where('invoice_id',$request->invoice_number)->delete();

                    $notification = array(
                        'messege' => 'Item Not Available',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('order_item.view')->with($notification);
                }
                else{
                $productId = $getproductid->id;
                $getitem = Orderdetail::where('invoice_id',$request->invoice_number)
                                ->where('item_id',$productId)->first();

                   if(empty($getitem)) {
                    $orderDetail = new Orderdetail();
                    $orderDetail->item_id = $productId;
                    $orderDetail->invoice_id = $request->invoice_number;
                    $orderDetail->item_quantity = $request->item_quantity[$key];
                    $orderDetail->unit_price = $request->unit_price[$key];
                    $orderDetail->price = $request->price[$key];
                    $Submit = $orderDetail->save();
                   }
                   else{
                    
                    $orderDetail = Orderdetail::where('invoice_id',$request->invoice_number)->where('item_id', $productId)->first();
                  
                    // dd($request->item_quantity[$key]);
                    //$orderDetail->item_id = $productId;
                    //$orderDetail->invoice_id = $request->invoice_number;
                    $orderDetail->item_quantity = ($orderDetail->item_quantity + $request->item_quantity[$key]);
                    //$orderDetail->unit_price = $request->unit_price[$key];
                    $orderDetail->price = ($orderDetail->price + $request->price[$key]);
                    $Submit = $orderDetail->save();
                    
                   }

                }   
            

        }

        $data = Order::find($id);

        // $data->invoice_number = $request->invoice_number;
        // $data->date = $request->date;
        // $data->table_number = $request->table_number;
        $data->total_amount = $request->total_amount;
        $data->paid_amount = $request->paid_amount;
        // $data->discount_amount = $request->discount_amount;
        // $data->delivery_charge = $request->delivery_charge;
        // $data->cus_contact_number = $request->cus_contact_number;
        $result = $data->save();
        

        if($result){
        $notification = array(
            'messege' => 'Order update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        

        
    }
        
    }

    public function receptOrder(Request $request)
    {
        $receptOrder = Order::where('invoice_number',$request->invoice_number)->first();
        // dd($request->invoice_number);
        $receptOrder->paid_status='1';
        $receptOrder->discount_amount = $request->discount_amount;
        $receptOrder->delivery_charge = $request->delivery_charge;
        $result = $receptOrder->save();
        
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data Updated successfully'
                ]
            );


       
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


    // ajax delete item
    public function destroy($id){
        $result = Orderdetail::find($id)->delete($id);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
