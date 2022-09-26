@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','All Supplier Details')


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right"> All Supplier Details </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('expense_invoice.view')}}">All Invoice</a></li>
              <li class="breadcrumb-item active">All Supplier Details</li>
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
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Paid Amount</th>
                                        <th scope="col">Due Amount</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailstData as $row)
                                        <tr>
                                            <td>{{$row->company_name}}</td>
                                            <td>{{$row->total}}</td>
                                            <td>{{$row->paid}}</td>
                                            <td>{{$row->due}}</td>
                                            
                                          </tr>
                                        @endforeach

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