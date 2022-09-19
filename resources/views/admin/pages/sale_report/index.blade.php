@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Sales Summary')



@section('admin-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Sales Summary Report</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Sales Summary</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$todaySaleSum}} BDT.</h3>

              <p>Today's Sale</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('todaySales.details')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$currentWeekSaleSum}} BDT.</h3>

              <p>Weekly Sale</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('weeklySales.details')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$currentMonthSum}} BDT.</h3>

              <p>Monthly Sale</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('monthlySales.details')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$currentYearSum}} BDT.</h3>

              <p>Total Sale</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('yearlySales.details')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <section class="content mb-4">
    <div class="container-fluid">
        <h2 class="text-center display-5 font-weight-bold">Search By Date</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{route('searchBy.date')}}">
                    <div class="input-group">
                        <input type="date" name="date" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if (count($datewiseData)>0)

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

       {{-- {{ $date}}
        @foreach ($datewiseData as $date)
        
        @endforeach --}}

        <div class="card">
          <div class="card-header">
           
            <a href="{{route('searchByDate.view',$date)}}" class="btn btn-success float-right" target="_blank"> Download PDF</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Invoice Number</th>
                <th>Table Number</th>
                <th>Invoice Amount</th>
              </tr>
              </thead>
              <tbody>

                @foreach ($datewiseData as $key => $row)
                <tr>
                    <td>{{$row->invoice_number}}</td>
                    <td>{{$row->table_number}}</td>
                    <td>{{$row->paid_amount}} TK.</td>
                </tr>
                @endforeach

                <tr>
                  <td></td>
                  <td>Total Amount</td>
                  <td>{{$datewiseTotal}} TK.</td>
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
@endif



</div>




@endsection
@endif