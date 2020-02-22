@extends('mainsite.base')

@section('content')

@foreach ($data['dataUser'] as $key => $value)
{{-- expr --}}
@endforeach
<div class="container" style="min-height:400px;">
  <div class="row pt-3">
    <div class=" col-sm-3">
      <div class="card" style="width: 100%;">
        <div class="card-header">
          <h5 class="header-card1"><kbd>Trang cá nhân</kbd></h5>
        </div>
        <div class="card-body" style="padding: 0 0;">
          <div class="user-avatar text-center py-5">
            {{-- if anh dai dien = null, hien anh mac dinh , else hien anh trong fdb --}}
            @if ($value['anhdaidien'])
            <img src="../../../{{ $value['anhdaidien'] }}" alt="Ảnh đại diện" width="130" height="130">
            @else
            <img src="{{ asset('upload/user/person-icon.png') }}" alt="Ảnh đại diện" width="130" height="130">
            @endif
            
          </div>
        </div>
        <div class="card-body" style="padding: 0 0;">
          <div class="vertical-menu">
            <a class="active" disabled>Quản lý thông tin cá nhân</a>
            <a href="{{ route('user.change-info') }}">Thay đổi thông tin cá nhân</a>
            <a href="{{ route('user.change-pw') }}">Thay đổi mật khẩu</a>
          </div>

          <div class="vertical-menu">
            <a class="active" disabled>Quản lý tin rao</a>
            <a href="{{ route('user.user-product') }}">Quản lý tin rao bán/cho thuê</a>
            <a href="{{ route('upload-product') }}">Đăng tin rao bán, cho thuê</a>
          </div>

          <div class="vertical-menu">
            <a class="active" disabled>Tiện ích</a>
            <a href="{{ route('user.mailbox') }}">Hộp tin nhắn</a>
          </div>

          <div class="vertical-menu">
            <a class="active" disabled>Khác</a>
            <a href="#">Hướng dẫn sử dụng</a>
          </div>
        </div>
      </div>
      
    </div>




    <div class="col-sm-9">
      <div class="card" style="width: 100%;">
        <div class="card-body" style="padding: 0 0;">
          <div class="card-header">
            <h5 class="header-card1"><kbd>Nội dung tin nhắn</kbd></h5>
          </div>
          <div class="card-body">
            <form action="" method="POST" accept-charset="utf-8" accept-charset="utf-8" enctype="multipart/form-data">
             @csrf

             <div class="ml-3 mb-5">
              <a href="{{ route('user.mailbox') }}" title="Quay lại"><button type="button" class="btn btn-success">Quay lại hộp tin</button></a>
            </div>
            <div class="row">
              <div class="m-auto">
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif

                {{-- Thong bao thanh cong/that bai --}}
                @if (session('status-sendmail'))
                <div class="row alert alert-success">
                  <div class="col-md-12 text-center">
                    <h6 class="text-uppercase">{{ session('status-sendmail') }}</h6>
                  </div>
                </div>
                @elseif (session('failed-sendmail'))
                <div class="row alert alert-danger text-center">
                  <h6 class="text-uppercase">{{ session('failed-sendmail') }}</h6>
                </div>
                @endif
              </div>
            </div>

            @foreach ($data as $value)
               
            @endforeach

            <div class="form-group row">
              <label for="nguoi_nhan" class="col-sm-3 col-form-label"><b>Người nhận :</b></label>
              <div class="col-sm-12">
                @if ($value['nguoigui'] != null)
                    <input type="text" class="form-control-plaintext text-ip-restyle" id="nguoi_nhan" value="{{ $value['nguoigui'] }}" name="nguoi_nhan" >
                @else
                    <input type="text" class="form-control-plaintext text-ip-restyle" id="nguoi_nhan" name="nguoi_nhan">
                @endif

              </div>
            </div>

            <div class="form-group row">
              <label for="tieu_de" class="col-sm-2 col-form-label"><b>Tiêu đề :</b></label>
              <div class="col-sm-12">
                <input type="text" class="form-control-plaintext text-ip-restyle" id="tieu_de" name="tieu_de">
              </div>
            </div>

            <div class="form-group row">
              <label for="noi_dung" class="col-sm-2 col-form-label"><b>Nội dung :</b></label>
              <div class="col-sm-12">
                <textarea class="form-control" rows="10" name="noi_dung"></textarea>
              </div>
            </div>

            <div class="form-group row float-right">
              <a href="{{ route('user.mail-sendHandle') }}" title="Gửi tin" style="margin-right: 15px;"><button type="submit" class="btn btn-warning" >Gửi tin nhắn</button></a>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>



</div>


@endsection

@push('scripts')
  <script>
    $(document).ready(function() {           

        $(".img-user").attr("src", function(i, val) {
          return '../../../'+val; //i == index, val == original attribute, the id
        });

    });
  </script>
@endpush