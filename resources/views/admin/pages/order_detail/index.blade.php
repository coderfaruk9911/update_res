@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Order Details List')

@section('admin-content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Order Details List</li>
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
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                {{-- <a href="{{route('expense_invoice.add_form')}}"   class="btn btn-primary float-right">Add New Invoice </a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Item Name</th>
                    <th>Item Quantity</th>
                    <th>Unit Price</th>
                    <th>Price</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($OrderList as $key => $row)
                    <tr>
                        <td>{{$row->item_name}}</td>
                        <td>{{$row->item_quantity}}</td>
                        <td>{{$row->unit_price}}</td>
                        <td>{{$row->price}}</td>
                        <td>
                          {{-- <a href="{{route('expense_invoice.delete',$row->id)}}" title="Delete Invoice" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> --}}
                          {{-- <a href="{{route('expense_invoice.edit',$row->id)}}" title="Edit Invoice" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> --}}
                          {{-- <a href="{{route('expense_invoice.show',$row->id)}}" title="View Invoice Details" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a> --}}
                        </td>
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