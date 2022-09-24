<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('src')?>/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('src')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('src')?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('src')?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('src')?>/dist/css/adminlte.min.css">
  <style>
  .img-table{
    width: 150px;
    height: auto;
  }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('src')?>/index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('src')?>/index3.html" class="brand-link">
      <img src="<?php echo base_url('src')?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('src')?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                <button class="btn btn-add btn-success"><i class="fas fa-plus"></i> Add Product </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Pictures</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Expired</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1; foreach($data_product as $dp):?>
                  <tr>
                    <td><?php echo $no++?></td>
                    <td><img class="img-table" src="data:image/png;base64,<?php echo $dp->picture?>"></td>
                    <td><?php echo $dp->name?></td>
                    <td><?php echo $dp->qty?></td>
                    <td><?php $date = strtotime($dp->expiredAt); echo date('Y-m-d',$date)?></td>
                    <td><button data-id="<?php echo $dp->id?>" class="btn btn-edit btn-small btn-info"><i class="fas fa-pencil-alt"></i></button>
                    <button data-id="<?php echo $dp->id?>" class="btn btn-delete btn-small btn-danger"><i class="fas fa-trash"></i></button></
                    </td>
                  </tr>
                  <?php endforeach;?>
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    
    </div>

  </footer>

  <div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addForm" class="needs-validation" enctype="multipart/form-data" novalidate>
              <div class="container">

                  <div class="form-group row">
                      <label for="id" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="name_id" name="name"
                              placeholder="Enter your Name" required />
                              <div class="invalid-feedback">
                                  Please choose a Name Product.
                                </div>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="validationCustomUsername"  class="col-sm-2 col-form-label">Upload Image</label>
                      <div class="input-group col-sm-10">
                        
                        <input type="file" accept="image/png" class="form-control" id="picture" name="picture_product" placeholder="Enter your Username" required>
                        <div class="invalid-feedback">
                          Please choose a Image.
                        </div>
                      </div>
                  </div>

                    <div class="form-group row">
                      <label for="id" class="col-sm-2 col-form-label">Quantity</label>
                      <div class="col-sm-10">
                          <input type="number" min="1" max="9999999999999999999" class="form-control" id="qty_product" name="qty"
                              placeholder="Enter Quantity Product" required />
                              <div class="invalid-feedback">
                                  Please Input Quantity Product.
                                </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id" class="col-sm-2 col-form-label">Expired Date</label>
                      <div class="col-sm-10">
                          <input type="date" class="form-control" id="expired_date" name="expired_date"
                              placeholder="Enter Quantity Product" required />
                              <div class="invalid-feedback">
                                  Please Input Quantity Product.
                                </div>
                      </div>
                    </div>
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-edit" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm" class="needs-validation" novalidate>
              <div class="container">

                  <div class="form-group row">
                      <label for="id" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="Name"
                              placeholder="Enter your Name" required />
                              <div class="invalid-feedback">
                                  Please choose a Name Product.
                                </div>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="validationCustomUsername"  class="col-sm-2 col-form-label">Upload Image</label>
                      <div class="input-group col-sm-10">
                        
                        <input type="file" accept="image/png" class="form-control" id="picture" name="picture" placeholder="Enter your Username" required>
                        <div class="invalid-feedback">
                          Please choose a Image.
                        </div>
                      </div>
                  </div>

                    <div class="form-group row">
                      <label for="id" class="col-sm-2 col-form-label">Quantity</label>
                      <div class="col-sm-10">
                          <input type="number" min="1" max="9999999999999999999" class="form-control" id="qty" name="qty"
                              placeholder="Enter Quantity Product" required />
                              <div class="invalid-feedback">
                                  Please Input Quantity Product.
                                </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id" class="col-sm-2 col-form-label">Expired Date</label>
                      <div class="col-sm-10">
                          <input type="date" class="form-control" id="expired_date" name="expired_date"
                              placeholder="Enter Quantity Product" required />
                              <div class="invalid-feedback">
                                  Please Input Quantity Product.
                                </div>
                      </div>
                    </div>
                    <input type="text" name="id_product" id="id_product" style="display:none">
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are Your Sure Delete Product?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button"class="btn btn-confirmDelete btn-danger">Delete</button>
        </div>
     
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('src')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('src')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('src')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('src')?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('src')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('src')?>/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  set_date();
$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function set_date(){
          var dtToday = new Date();
          
          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();
          
          var maxDate = year + '-' + month + '-' + day;
          $('#expired_date').attr('min', maxDate);
  }

  $(document).ready(function () {
    var product_id;

    $('.btn-add').click(function (e) { 
      e.preventDefault();
      $('#modal-add').modal('show'); 
    });

    $('.btn-edit').click(function (e) { 
      e.preventDefault();
      product_id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/product_Id')?>",
        data: {
          id : product_id,
        },
        dataType: "JSON",
        success: function (response) {
          var data_product = response.data[0];
          $('#name').val(data_product.name);
          $('input[name="qty"]').val(data_product.qty);
          $('input[name="expired_date"]').val(data_product.expiredAt);
          $('input[name="id_product"]').val(product_id);
          setTimeout(() => {
            $('#modal-edit').modal('show'); 
            set_date();
          }, 1000);
        }
      });
      
    });

    $('.btn-delete').click(function (e) { 
      e.preventDefault();
      $('#modal-delete').modal('show');
      product_id = $(this).data('id');
    });

    $('.btn-confirmDelete').click(function (e) { 
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/delete_product')?>",
        data: {
          id : product_id,
        },
        success: function (response) {
          $('#modal-delete').modal('toggle');
              $(document).Toasts('create', {
                class: 'bg-success',
                autohide: true,
                delay: 1500,
                title: 'Success',
                body: 'Success Delete Product',
              });

              setTimeout(() => {
                window.location.reload();
              }, 1000);
        }
      });
    });
    $('#addForm').submit(function (e) { 
      e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/add_product')?>",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function (response) {
            $('#modal-add').modal('toggle');
              $(document).Toasts('create', {
                class: 'bg-success',
                autohide: true,
                delay: 1500,
                title: 'Success',
                body: 'Success Add Product',
              });

              setTimeout(() => {
                window.location.reload();
              }, 1000);
          }
        });
        
      });

      $('#editForm').submit(function (e) { 
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/edit_product')?>",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function (response) {
            $('#modal-edit').modal('toggle');
              $(document).Toasts('create', {
                class: 'bg-success',
                autohide: true,
                delay: 1500,
                title: 'Success',
                body: 'Success Edit Product',
              });

              setTimeout(() => {
                window.location.reload();
              }, 1000);
          }
        });
      });
  });
</script>
</body>
</html>
