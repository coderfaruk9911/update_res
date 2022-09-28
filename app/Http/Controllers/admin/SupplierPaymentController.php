<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Supplierduedetail;
use App\Models\Supplierpayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierPaymentController extends Controller
{
    public function view(){
        $SupplierDueList = Supplierduedetail::where('due_amount', '>',0)->select([DB::raw("SUM(due_amount) as total_due"), DB::raw("(supplier_id) as sup_id")])
        ->groupBy('supplier_id')
        ->get();
        return view('admin.pages.supplierdue.index',compact('SupplierDueList'));
    }


    public function paymentForm($id){
        $lastInvoiceNumber = Supplierpayment ::latest('invoice_number')->first();
        if($lastInvoiceNumber==null){
            $invoice_number = '000001';
        }else{
            $invoice_number = str_pad(($lastInvoiceNumber->invoice_number + 1),6, "0", STR_PAD_LEFT);
        }

        $supName= Supplierduedetail::join('suppliers','suppliers.id','supplierduedetails.supplier_id')->where('supplier_id',$id)->first();

        $paymentData = Supplierduedetail::where('supplier_id',$id)->where('due_amount', '>',0)->sum('due_amount');
    

        
        return view('admin.pages.supplierdue.payment_form', compact('paymentData','invoice_number','supName'));
    }

    public function paymentConfirm(Request $request, $id){


            $data = new Supplierpayment();
            $data->invoice_number = $request->invoice_number;
            $data->date = $request->date;
            $data->supplier_id = $request->supplier_id;
            $data->paid_amount = $request->paid_amount;
            $result = $data->save();



            if ($result) {
                $paid_amount = $request->paid_amount;
                $DueUser = Supplierduedetail::where('supplier_id',$id)->where('due_amount', '>',0)->get();
                // dd($DueUser);
                
                
                foreach($DueUser as $row){
                   
                    if($paid_amount > 0){
                    if($row->due_amount > $paid_amount){
                        $paymentUser = Supplierduedetail::where('supplier_id',$id)->first();
                       $paymentUser->due_amount = $row->due_amount - $paid_amount;
                        $paid_amount = 0;
                        $paymentUser->save();
                    }
                    else if($row->due_amount == $paid_amount){
                        $paymentUser = Supplierduedetail::where('supplier_id',$id)->first();
                        $paymentUser->due_amount = $row->due_amount - $paid_amount;
                        $paid_amount = 0;
                        $paymentUser->save();
                    }
                    else if($row->due_amount < $paid_amount){
                        $paymentUser = Supplierduedetail::where('supplier_id',$id)->first();
                        $paymentUser->due_amount = 0;
                        $paymentUser->save();
                        $update_paid_amount = $paid_amount - $row->due_amount;
                        $paid_amount = $update_paid_amount;
                        
                    }
                    
                }
                $paymentAdvanced = Supplierduedetail::where('supplier_id',$id)->first();
                $paymentAdvanced->advanced_amount== $paid_amount;
                $paymentAdvanced->save();
                }

                 


                $notification = array(
                    'messege' => 'Supplier Payment Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('supplier_payment.view')->with($notification);
            }

  












        
        
        
    }

    // public function delete($id){
    //     $result=Supplierpayment::findOrFail($id)->delete();
    //     if ($result) {
    //         $notification = array(
    //             'messege' => 'Supplierpayment Delete Successfully',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->route('Supplierpayment.view')->with($notification);
    //     }else{
    //         $notification = array(
    //             'messege' => 'Something Went Wrong ! Please Try Again',
    //             'alert-type' => 'success'
    //         );
    //     }
       
    // }
}
