@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Edit Menu Item')


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right">Edit Menu Item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('menu_item.view')}}">All Menu Item</a></li>
              <li class="breadcrumb-item active">edit Menu Item</li>
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
                <form action="{{route('menu_item.update',$editData->id)}}" method="post">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="item_name">Menu Item Name</label>
                        <input type="text" id="item_name" name="item_name" value='{{$editData->item_name}}' class="form-control" >
                      </div>
      
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" value='{{$editData->price}}' class="form-control">
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