@extends('layouts.app')
@section('title', 'Product List')
@section('content')
<div class="container">
  <!-- Content Wrapper. Contains page content -->
  <div class="row">
    <!-- Main content -->
    <section class="col-md-12">
    
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @if (session()->has('success'))
          <div class="demo-spacing-0">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <div class="alert-body">
                      {{session()->get('success')}}
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
          @endif

          @if (session()->has('error'))
          <div class="demo-spacing-0">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <div class="alert-body">
                      {{session()->get('error')}}
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
          @endif
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="product-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                  </tr>
                  </tfoot>
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
</div>
<!-- ./wrapper -->
@endsection

@section('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
    var listURL = "{{route('products.index')}}";    
</script>
@vite(['resources/js/product.js'])
@endsection