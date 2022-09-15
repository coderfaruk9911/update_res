<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrativecost as Administrative;

class Administrativecost extends Controller
{
    public function view(){
        $AdministrativeCostList = Administrative::all();
        return view('admin.pages.administrative_cost.index',compact('AdministrativeCostList'));
    }


    public function store(Request $request){
        $validated = $request->validate([
            'date' => 'required|',
            'name' => 'required|max:191',
            'amount' => 'required',
        ]);

        $data = new Administrative();
        $data->date = $request->date;
        $data->name = $request->name;
        $data->amount = $request->amount;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Administrative Cost Added Successfully',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }
    }

    public function edit($id){
        $editData = Administrative::findOrFail($id);
        return view('admin.pages.administrative_cost.edit', compact('editData'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'date' => 'required|',
            'name' => 'required|max:191',
            'amount' => 'required',
        ]);

        $data = Administrative::findOrFail($id);

        $data->date = $request->date;
        $data->name = $request->name;
        $data->amount = $request->amount;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Administrative Cost Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('administrative_cost.view')->with($notification);
        }
        
    }

    public function delete($id){
        $result = Administrative::findOrFail($id)->delete();
        if ($result) {
            $notification = array(
                'messege' => 'Administrative Cost Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('administrative_cost.view')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Something Went Wrong ! Please Try Again',
                'alert-type' => 'error'
            );
        }
       
    }
}
