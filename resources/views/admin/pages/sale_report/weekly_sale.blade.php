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
                <a href="{{route('sale_report.view')}}" class="btn btn-dark font-weight-bold"> <i class="fa fa-arrow-left"></i> Back</a>
                <a href="{{route('weekly_sales_pdf.view')}}" class="btn btn-success float-right">Download PDF</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Invoice Amount</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($currentWeekSaleData as $key => $row)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$row->sum('paid_amount')}} TK.</td>
                    </tr>
                    @endforeach

                    <tr>
                      <td>Total Amount</td>
                      <td>{{$currentWeekTotal}} TK.</td>
                    </tr>
                  
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