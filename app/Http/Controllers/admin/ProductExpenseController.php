<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dailyproductexpense;
use App\Models\Stockproductlist;
use App\Models\Productlimit;

class ProductExpenseController extends Controller
{
    public function view(){
        $provideProductList = Dailyproductexpense::all();
        return view('admin.pages.dailyproductexpense.index',compact('provideProductList'));
    }

    public function addForm(){
        $provideProductList = Dailyproductexpense::all();
        return view('admin.pages.dailyproductexpense.add_form',compact('provideProductList'));
    }


    public function store(Request $request){
        $validated = $request->validate([
            // 'company_name' => 'required|unique:suppliers|max:191',
            // 'contact_person_name' => 'required|max:191',
            // 'contact_number' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|size:11',
        ]);

        // $data = new Dailyproductexpense();
        // $data->expense_date = $request->expense_date;
        // $data->product_name = $request->product_name;
        // // $data->product_id = $request->product_id;
        // $data->quantity = $request->quantity;



        

        // foreach ($request->product_name as $key=>$product_name) { 

           
            $getproductid = Stockproductlist::where('product_name',$request->product_name)->first();
            $Limits = Productlimit::where('product_id',$getproductid->id)->first();
            
            if(empty( $Limits)){
                    $notification = array(
                        'messege' => 'Please Set the Limit',
                        'alert-type' => 'warning'
                    );
                return redirect()->route('kitchen_product_provide.view')->with($notification);
            }
            
            
            else{

                if($request->unit_title =='gm' || $request->unit_title == 'ml'){
                    $convert = $request->quantity / 1000;
                    if(($getproductid->unit - $Limits->limit)  < $convert){
                        
                        $notification = array(
                            'messege' => 'Out of Limit',
                            'alert-type' => 'warning'
                        );
                        
                return redirect()->route('kitchen_product_provide.view')->with($notification);

                }else{
                    $data = new Dailyproductexpense();
                    $data->product_name = $request->product_name;
                    $data->quantity = $request->quantity;
                    $data->expense_date = $request->expense_date;
                    $data->unit_title = $request->unit_title;
                    $result = $data->save();
                    if($result){
                        if($request->unit_title=='gm' || $request->unit_title=='ml'){
                            $convert = $request->quantity / 1000;
                            $updateNew = $getproductid->unit - $convert;
                            $getproductid->unit = $updateNew;
                            $updateProductUnit = $getproductid->save();
                            if($updateProductUnit){
                                $notification = array(
                                    'messege' => 'Successfully  Delivered',
                                    'alert-type' => 'success'
                                );
                            return redirect()->route('kitchen_product_provide.view')->with($notification);
        
                            }
                        }else{
                            $updateNew = $getproductid->unit - $request->quantity;
                            $getproductid->unit = $updateNew;
                            $updateProductUnit = $getproductid->save();
                            if($updateProductUnit){
                                $notification = array(
                                    'messege' => 'Successfully  Delivered',
                                    'alert-type' => 'success'
                                );
                            return redirect()->route('kitchen_product_provide.view')->with($notification);
        
                            }
                        }
                   
                    }
                    
                }
            }
                elseif(($getproductid->unit - $Limits->limit)  <= $request->quantity){
                    $notification = array(
                        'messege' => 'Out of Limit',
                        'alert-type' => 'warning'
                    );
                return redirect()->route('kitchen_product_provide.view')->with($notification);
                }else{
                    $data = new Dailyproductexpense();
                    $data->product_name = $request->product_name;
                    $data->quantity = $request->quantity;
                    $data->expense_date = $request->expense_date;
                    $data->unit_title = $request->unit_title;
                    $result = $data->save();
                    if($result){
                        if($request->unit_title=='gm' || $request->unit_title=='ml'){
                            $convert = $request->quantity / 1000;
                            $updateNew = $getproductid->unit - $convert;
                            $getproductid->unit = $updateNew;
                            $updateProductUnit = $getproductid->save();
                        }else{
                            $updateNew = $getproductid->unit - $request->quantity;
                            $getproductid->unit = $updateNew;
                            $updateProductUnit = $getproductid->save();
                            if($updateProductUnit){
                                $notification = array(
                                    'messege' => 'Successfully  Delivered',
                                    'alert-type' => 'success'
                                );
                            return redirect()->route('kitchen_product_provide.view')->with($notification);
        
                            }
                        }
                   
                    }
                }

            
        






        
            
        }
        
    }

    public function edit($id){
        $editData = Supplier::findOrFail($id);
        return view('admin.pages.supplier.edit', compact('editData'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'company_name' => 'required|max:191',
            'contact_person_name' => 'required|max:191',
            'contact_number' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|size:11',
        ]);

        $data = Supplier::findOrFail($id);

        $data->company_name = $request->company_name;
        $data->contact_person_name = $request->contact_person_name;
        $data->contact_number = $request->contact_number;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Supplier Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('supplier.view')->with($notification);
        }
        
    }

    public function delete($id){
        $result=Supplier::findOrFail($id)->delete();
        if ($result) {
            $notification = array(
                'messege' => 'Supplier Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('supplier.view')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Something Went Wrong ! Please Try Again',
                'alert-type' => 'success'
            );
        }
       
    }
}
