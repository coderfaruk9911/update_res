@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Supplier Details')


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right">
              @foreach($detailstData as $index => $row)
                  @if($index == 0)
                  {{$row->company_name}} Details
                  @endif
              @endforeach
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('expense_invoice.view')}}">All Invoice</a></li>
              <li class="breadcrumb-item active"> Supplier Details</li>
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
                            
                        </div>
                       
                        

                        <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Invoice Number</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Paid Amount</th>
                                        <th scope="col">Due Amount</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailstData as $row)
                                        <tr>
                                            <td>{{$row->invoice_date}}</td>
                                            <td>{{$row->invoice_number}}</td>
                                            <td>{{$row->total_amount}}</td>
                                            <td>{{$row->paid_amount}}</td>
                                            <td>{{$row->due_amount}}</td>
                                            
                                          </tr>
                                        @endforeach
                                      


                                      
                                      {{-- <tr>
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
                                      </tr> --}}

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