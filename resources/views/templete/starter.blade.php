@extends('layouts.main')

@section('main-container');
  <!-- Navbar -->
  {{-- @include('layouts.header');
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar'); --}}

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row mb-2 float-right mx-5">
            <a class="btn btn-primary float-right" href="{{route('index')}}"> View All </a>
        </div>
    </div>
    <!-- /.content-header -->
    <form method="POST" action="/create">
        @csrf
        <div class="mx-3">
          <label for="category" class="form-label">Category :</label>
          <input type="text" class="form-control category" id="category" placeholder="Enter Catetory" @error('category') is-invaild @enderror " value="{{old('category')}}" name="category">
          @error('category')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-check mx-3 my-3">
          <label class="form-check-label ">
            <input class="form-check-input" type="checkbox" name="remember"> Remember me
          </label>
        </div>
        <button type="submit" class="btn btn-primary mx-3">Submit</button>
      </form>

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  {{-- @include('layouts.footer'); --}}

@endsection
