<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menuitem;

class MenuItemController extends Controller
{
    public function view(){
        $allItems = Menuitem::all();
        return view('admin.pages.menu_item.index',compact('allItems'));
    }


    public function store(Request $request){
        $validated = $request->validate([
            'item_name' => 'required|unique:menuitems|max:191',
            'price' => 'required|numeric',
        ]);

        $data = new Menuitem();
        $data->item_name = $request->item_name;
        $data->price = $request->price;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Menuitem Add Successfully',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }
    }

    public function edit($id){
        $editData = Menuitem::findOrFail($id);
        return view('admin.pages.menu_item.edit', compact('editData'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'item_name' => 'required|max:191',
            'price' => 'required|numeric',
        ]);

        $data = Menuitem::findOrFail($id);

        $data->item_name = $request->item_name;
        $data->price = $request->price;
        $result = $data->save();
        if ($result) {
            $notification = array(
                'messege' => 'Menuitem Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('menu_item.view')->with($notification);
        }
        
    }

    public function delete($id){
        $result=Menuitem::findOrFail($id)->delete();
        if ($result) {
            $notification = array(
                'messege' => 'Menuitem Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('menu_item.view')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Something Went Wrong ! Please Try Again',
                'alert-type' => 'success'
            );
        }
       
    }
}
