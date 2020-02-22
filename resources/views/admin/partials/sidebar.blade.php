<!-- Sidebar -->
<ul class="sidebar navbar-nav navbar-light">
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Trang quản trị</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Quản lý danh mục</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">

      <h6 class="dropdown-header">Quản lý sản phẩm</h6>
      <a class="dropdown-item" href="{{ route('admin.add-product') }}"><small>Thêm mới sản phẩm</small></a>
      <a class="dropdown-item" href="{{ route('admin.display-allproduct') }}"><small>Danh sách sản phẩm</small></a>

      <div class="dropdown-divider"></div>
      
      <h6 class="dropdown-header">Quản lý hình ảnh</h6>
      <a class="dropdown-item" href="{{ route('admin.add-image') }}"><small>Thêm mới hình ảnh</small></a>
      <a class="dropdown-item" href="{{ route('admin.display-allimage') }}"><small>Danh sách hình ảnh</small></a>

      <div class="dropdown-divider"></div>
      
      <h6 class="dropdown-header">Quản lý loại sản phẩm</h6>
      <a class="dropdown-item" href="{{ route('admin.add-productcate') }}"><small>Thêm mới loại sản phẩm</small></a>
      <a class="dropdown-item" href="{{ route('admin.display-allProCate') }}"><small>Danh sách loại sản phẩm</small></a>

      {{-- <div class="dropdown-divider"></div>

      <h6 class="dropdown-header">Quản lý hộp tin nhắn</h6>
      <a class="dropdown-item" href=""><small>Thêm mới tin nhắn</small></a>
      <a class="dropdown-item" href=""><small>Danh sách tin nhắn</small></a> --}}

      <div class="dropdown-divider"></div>

      <h6 class="dropdown-header">Quản lý tin tức</h6>
      <a class="dropdown-item" href="{{ route('admin.add-post') }}"><small>Thêm mới tin tức</small></a>
      <a class="dropdown-item" href="{{ route('admin.edit-post') }}"><small>Danh sách tin tức</small></a>
      
      <div class="dropdown-divider"></div>

      <h6 class="dropdown-header">Quản lý người dùng</h6>
      <a class="dropdown-item" href="{{ route('admin.add-user') }}"><small>Thêm mới người dùng</small></a>
      <a class="dropdown-item" href="{{ route('admin.display-alluser') }}"><small>Danh sách người dùng</small></a>

      <div class="dropdown-divider"></div>

      <h6 class="dropdown-header">Quản lý phản hồi</h6>
      <a class="dropdown-item" href="{{ route('admin.display-allreport') }}"><small>Danh sách phản hồi</small></a>


    </div>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Thống kê</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Thống kê</h6>
       <a class="dropdown-item" href="{{ route('admin.user-statistic') }}"><small>Thống kê người dùng</small></a>
        <a class="dropdown-item" href="{{ route('admin.product-statistic') }}"><small>Thống kê tin rao</small></a>
    </div>
  </li>

</ul>