@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Weekly Sale')

@section('admin-content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Weekly Sale</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Weekly Sale</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                {{-- <a href="#" data-toggle="modal" data-target="#modal-default" class="btn btn-primary float-right"> </a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Invoice Number</th>
                    <th>Table Number</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Discount Amount</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($currentWeekSaleData as $key => $row)
                    <tr>
                        <td>{{$row->invoice_number}}</td>
                        <td>{{$row->table_number}}</td>
                        <td>{{$row->total_amount}}</td>
                        <td>{{$row->paid_amount}}</td>
                        <td>{{$row->discount_amount}}</td>
                    </tr>
                    @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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