@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Invoice Details')

<style>
    no-sort::after { display: none!important; }

.no-sort  { pointer-events: none!important; cursor: default!important; }
</style>

@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right"> Invoice Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('order_item.view')}}">All Invoice</a></li>
              <li class="breadcrumb-item active"> Invoice Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">

                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoice_number">Invoice Number</label>
                                @foreach($showData as $index => $row)
                                @if($index == 0)
                                <input type="text" readonly id="invoice_number" value="{{$row->invoice_number}}"  class="form-control">
                                @endif
                                @endforeach
                               
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoice_number">Invoice Date</label>
                                @foreach($showData as $index => $row)
                                @if($index == 0)
                                <input type="text" readonly id="invoice_number" value="{{$row->date}}"  class="form-control">
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoice_number">Table Number</label>
                                @foreach($showData as $index => $row)
                                @if($index == 0)
                                <input type="text" readonly id="invoice_number" value=" @if($row->table_number=='') N/A @else{{$row->table_number}} @endif"  class="form-control">
                                @endif
                                @endforeach
                                </div>
                        </div>

                        <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-bordered" id="example">
                                    <thead>
                                      <tr>
                                        <th class="no-sort sorting " scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Price</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($showData as $row)
                                        <tr>
                                            <td>{{$row->item_name}}</td>
                                            <td>{{$row->item_quantity}} {{$row->unit_title}}</td>
                                            <td>{{$row->unit_price}}</td>
                                            <td>{{$row->price}}</td>
                                          </tr>
                                        @endforeach
                                      


                                      
                                      <tr>
                                        <td colspan="2" style="border:0"></td>
                                        <td class="text-success font-weight-bold">Total</td>
                                        @foreach($showData as $index => $row)
                                            @if($index == 0)
                                            <td class="text-success font-weight-bold">{{$row->total_amount}}</td>
                                            @endif
                                        @endforeach
                                      </tr>
                                      <tr>
                                        <td colspan="2" style="border:0"></td>
                                        <td class="text-success font-weight-bold">Paid</td>
                                        @foreach($showData as $index => $row)
                                            @if($index == 0)
                                            <td class="text-success font-weight-bold">{{$row->paid_amount}}</td>
                                            @endif
                                        @endforeach
                                      </tr>
                                      <tr>
                                        <td colspan="2" style="border:0"></td>
                                        <td class="text-success font-weight-bold">Discount Amount</td>
                                        @foreach($showData as $index => $row)
                                        @if($index == 0)
                                        <td class="text-success font-weight-bold">{{$row->discount_amount}}</td>
                                        @endif
                                        @endforeach
                                      </tr>

                                    </tbody>
                                  </table>

                                
                            </div>
                            
                        </div>  
                    </div>
                        
                        
                        
                    </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>
$(document).ready(function(){
   $('#example').DataTable({
     'processing': true,
     'serverSide': true,
     'serverMethod': 'POST',
     'ajax': {
       'url':'/ajax/users.php'
     },
     'columns': [
        { data: 'id' }, /* index = 0 */
        { data: 'name' }, /* index = 1 */
        { data: 'email' }, /* index = 2 */
        { data: 'gender' }, /* index = 3 */
        { data: 'city' } /* index = 4 */
     ],
     'columnDefs': [ {
        'targets': [1,2], /* column index */
        'orderable': false, /* true or false */
     }]
   });
});
  </script>

@endsection
@endif