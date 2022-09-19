@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Edit Table')


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right">Edit Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('table_list.view')}}">All Table</a></li>
              <li class="breadcrumb-item active">edit Table</li>
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
                <form action="{{route('table_list.update',$editData->id)}}" method="post">
                    @csrf
                    <div class="card-body"> 

                        <div class="form-group">
                            <label for="tb_name">Table Name</label>
                            <input type="text" id="tb_name" name="tb_name" value="{{$editData->tb_name}}" class="form-control" >
                        </div>
        
                        <div class="form-group">
                            <label for="table_number">Table Number</label>
                            <input type="text" id="table_number " name="table_number" value="{{$editData->table_number}}" class="form-control">
                        </div>


                        <button type="submit" class="btn btn-primary float-right">Update</button>
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