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
            <div class="row">
              @foreach ($data['mailDetail'] as $value)
              {{-- expr --}}
              @endforeach

              <div class="ml-3 mb-5">
                <a href="{{ route('user.mailbox') }}" title="Quay lại"><button type="button" class="btn btn-success">Quay lại hộp tin</button></a>
                <a href="{{ route('user.mail-send',[ 'mail_id' => $value->id ]) }}" title="Soạn tin"><button type="button" class="btn btn-warning">Trả lời</button></a>
              </div>
            </div>



            <div class="form-group row">
              <label for="nguoi_gui" class="col-sm-2 col-form-label">Người gửi</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext text-ip-restyle" id="nguoi_gui" value="{{ $value->nguoigui }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="tieu_de" class="col-sm-2 col-form-label">Tiêu đề</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext text-ip-restyle" id="tieu_de" value="{{ $value->tieu_de }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="noi_dung" class="col-sm-2 col-form-label">Nội dung</label>
              <div class="col-sm-10">
                <textarea name="noi_dung" class="form-control" disabled="disabled" rows="10">{{ $value->noi_dung }}</textarea>
              </div>
            </div>

          </div>
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