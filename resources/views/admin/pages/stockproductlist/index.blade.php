@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Stockproductlist List')

@section('admin-content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stockproductlist List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Stockproductlist List</li>
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
                {{-- <a href="#" data-toggle="modal" data-target="#modal-default" class="btn btn-primary float-right">Add New Supplier </a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($productlists as $key => $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->product_name}}</td>
                        <td>{{$row->unit}}</td>
                        <td>@foreach ($Productlimits as $item)
                          @if($item->product_id == $row->id) 
                          @if($item->limit > $row->unit) <span class="badge badge-danger text-center">Need to Purchase </span> 
                          @elseif(($item->limit + 5) >= $row->unit)<span class="badge badge-warning text-center"> Out of Limit</span>
                          @else<span class="badge badge-success text-center">Available</span>
                          @endif
                          
                           @endif
                          
                        @endforeach
                      </td>
                        <td>
                          <a href="{{route('supplier.delete',$row->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          <a href="{{route('supplier.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
                          </a>
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



  <!-- modal-dialog -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('supplier.store')}}" method="post">
            @csrf
        <div class="modal-body">
          
            <div class="card-body">
                <div class="form-group">
                  <label for="inputPackage">Company Name</label>
                  <input type="text" id="inputPackage" name="company_name" value="{{old('company_name')}}" class="form-control" >
                </div>

                <div class="form-group">
                  <label for="inputSpeed">Contact Person Name</label>
                  <input type="text" id="inputSpeed" name="contact_person_name" value='{{old('contact_person_name')}}' class="form-control">
                </div>
                
                <div class="form-group">
                  <label for="inputprice">Contact Number</label>
                  <input type="text" name="contact_number" value='{{old('contact_number')}}' id="inputprice" class="form-control">
                </div>
                
              </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection
@endif