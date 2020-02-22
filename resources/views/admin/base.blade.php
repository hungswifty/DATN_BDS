<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản trị</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset ('css/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset ('css/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

   {{--  <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> --}}
  
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sb-admin.css') }}" >
    <link rel="stylesheet" href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    

    @stack('stylesheet')

  </head>

  <body id="page-top">
        @include('admin.partials.header')
    <div id="wrapper">
      {{-- Sidebar --}}
        @include('admin.partials.sidebar')
      <div id="content-wrapper">
        @yield('content')
      

        @include('admin.partials.footer')
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('admin.logout') }}">Logout</a>
            {{-- Logout --}}
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('css/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('css/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('Datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor5-classic/ckeditor.js') }}"></script>
    <script src="{{ asset('bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.12.1/jquery-ui.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('css/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>



    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/button-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/button-table/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/button-table/jszip.min.js') }}"></script>
    <script src="{{ asset('js/button-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/button-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/button-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/button-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/admin/sb-admin.js') }}"></script>
    <script src="{{ asset('js/mainsite/login-jq.js') }}"></script>

    

    <!-- Latest compiled and minified JavaScript -->
    @routes
    @stack('script')
    
  </body>

</html>
