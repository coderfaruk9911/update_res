<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tablelist;

class TableListController extends Controller
{
    public function view(){
        $Tablelists = Tablelist::all();
        return view('admin.pages.tablelist.index',compact('Tablelists'));
    }


    public function store(Request $request){
        $validated = $request->validate([
            'tb_name' => 'unique:tablelists|max:191',
            'table_number' => 'required|unique:tablelists',
        ]);

        $data = new Tablelist();
        $data->tb_name = $request->tb_name;
        $data->table_number = $request->table_number;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Tablelist Add Successfully',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }
    }

    public function edit($id){
        $editData = Tablelist::findOrFail($id);
        return view('admin.pages.tablelist.edit', compact('editData'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'tb_name' => 'max:191',
            'table_number' => 'required',
        ]);

        $data = Tablelist::findOrFail($id);

        $data->tb_name = $request->tb_name;
        $data->table_number = $request->table_number;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Tablelist Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('table_list.view')->with($notification);
        }
        
    }

    public function delete($id){
        $result = Tablelist::findOrFail($id)->delete();
        if ($result) {
            $notification = array(
                'messege' => 'Tablelist Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('table_list.view')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Something Went Wrong ! Please Try Again',
                'alert-type' => 'error'
            );
        }
       
    }
}
