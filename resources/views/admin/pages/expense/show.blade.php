@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Invoice Details')


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
              <li class="breadcrumb-item"><a href="{{route('expense_invoice.view')}}">All Invoice</a></li>
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
                                <input type="text" readonly id="invoice_number" value="{{$row->invoice_date}}"  class="form-control">
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoice_number">Supplier Name</label>
                                @foreach($showData as $index => $row)
                                @if($index == 0)
                                <input type="text" readonly id="invoice_number" value=" @if($row->supplier_id=='') N/A @else{{$row->supplier_id}} @endif"  class="form-control">
                                @endif
                                @endforeach
                                </div>
                        </div>

                        <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Price</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($showData as $row)
                                        <tr>
                                            <td>{{$row->product_name}}</td>
                                            <td>{{$row->quantity}} {{$row->unit_title}}</td>
                                            <td>{{$row->unit_price}}</td>
                                            <td>{{$row->unit}}</td>
                                            <td>{{$row->price}}</td>
                                          </tr>
                                        @endforeach
                                      


                                      
                                      <tr>
                                        <td colspan="3"></td>
                                        <td class="text-success font-weight-bold">Total</td>
                                        @foreach($showData as $index => $row)
                                            @if($index == 0)
                                            <td class="text-success font-weight-bold">{{$row->total_amount}}</td>
                                            @endif
                                        @endforeach
                                      </tr>
                                      <tr>
                                        <td colspan="3"></td>
                                        <td class="text-success font-weight-bold">Paid</td>
                                        @foreach($showData as $index => $row)
                                            @if($index == 0)
                                            <td class="text-success font-weight-bold">{{$row->paid_amount}}</td>
                                            @endif
                                        @endforeach
                                      </tr>
                                      <tr>
                                        <td colspan="3"></td>
                                        <td class="text-success font-weight-bold">Due</td>
                                        @foreach($showData as $index => $row)
                                        @if($index == 0)
                                        <td class="text-success font-weight-bold">{{$row->due_amount}}</td>
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

@endsection
@endif