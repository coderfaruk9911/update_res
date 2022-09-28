@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Payment')


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right">Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('supplier_payment.view')}}">Supplier Due List</a></li>
              <li class="breadcrumb-item active">Payment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Error Massage -->
    <div class="container">
      <div class="row d-flex justify-content-center">
          <div class="col-6">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
          </div>
      </div>
  </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-8">

            <div class="card">
                <form action="{{route('payment.confirm',$supName->supplier_id)}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="invoice_number">Payment Invoice Number</label>
                                    <input type="text" id="invoice_number" name="invoice_number" value="{{$invoice_number}}"  class="form-control" readonly>
                                  </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date"  class="form-control" required>
                                  </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputPackage">Supplier name</label>
                                    <input   value="{{$supName->company_name}}" class="form-control" readonly>
                                    <input type="hidden"  name="supplier_id" value="{{$supName->supplier_id}}" class="form-control" readonly>
                                  </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="due_amount">Due Amount</label>
                                    <input type="text" id="due_amount" name="due_amount" value="{{$paymentData}}"  class="form-control" readonly>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paid_amount">Paid Amount</label>
                                    <input type="number" name="paid_amount"  id="paid_amount"  class="form-control">
                                  </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Payment</button>   
                      </div>
                </form>
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