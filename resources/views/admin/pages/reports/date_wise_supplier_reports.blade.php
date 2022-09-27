@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Supplier Report')



@section('admin-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Supplier Report</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Supplier Report</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


  <section class="content mb-4">
    <div class="container-fluid">
        <h2 class="text-center display-5 font-weight-bold">Search By Date</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{route('dateWiseaSupplierPost.report')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <label for="" class="label label-default mt-2">Form Date: </label>
                                <input type="date" name="form" class="form-control" required>
                                <div class="input-group-append">
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <label for="" class="label label-default mt-2">To Date: </label>
                                <input type="date" name="to" class="form-control" required >

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">Show</button>

                            </div>
                        </div>
                    </div>

                    
                    
                </form>
            </div>
        </div>
    </div>
</section>




</div>




@endsection
@endif