<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orderdetail;

class OrderDetailsController extends Controller
{
    public function view(){
        $OrderList = Orderdetail::join('menuitems', 'menuitems.id', '=', 'orderdetails.item_id')
                ->select('orderdetails.*','menuitems.item_name')
                ->get();
        return view('admin.pages.order_detail.index',compact('OrderList'));
    }
    
}
