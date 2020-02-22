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
            <img src="../{{ $value['anhdaidien'] }}" alt="Ảnh đại diện" width="130" height="130">
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
            <h5 class="header-card1"><kbd>Hộp tin nhắn</kbd></h5>
          </div>
          <div class="card-body">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tin nhắn đến</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tin nhắn gửi</a>
                <a class="nav-item nav-link" id="nav-contact-tab" href="{{ route('user.mail-send') }}" role="tab">Soạn tin nhắn</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table edit_table table table-hover">
                  <thead class="table-info">
                    <tr class="text-center">
                     <th scope="col"><small><b>STT</b></small></th>
                     <th scope="col"><small><b>Nguời gửi</b></small></th>
                     <th scope="col"><small><b>Tiêu đề</b></small></th>
                     <th scope="col"><small><b>Thời gian</b></small></small></th>
                     <th scope="col" style="width: 250px"><small><b>Hành động</b></small></th>
                   </tr>
                 </thead>
                 <tbody>
                  @foreach ($data['dataMail'] as $key => $value)
                  <tr class="text-center">
                   <th>{{ $key + 1}} <a href="" title=""></th></a>
                   <td><small>{{ $value->nguoigui }}</small></td>
                   <td><small>{{ Str::words($value->tieu_de,10,'...') }}</small></td>
                   <td><small>{{ $value->created_at }}</small></td>
                   <td>
                    <a href="{{ route('user.mail-detail',[ 'mail_id' => $value->id ,'tieu_de' => Str::slug($value->tieu_de, '-') ]) }}" title="Xem"><button type="button" class="btn btn-info">Xem</button></a>
                    <a href="{{ route('user.mail-send',[ 'mail_id' => $value->id ]) }}" title="Trả lời"><button type="button" class="btn btn-warning">Trả lời</button></a>
                    <a href="{{ route('user.mail-delete',[ 'mail_id' => $value->id ]) }}" title="Xóa"><button type="button" class="btn btn-secondary">Xoá</button></a>
                  </td>
                </tr>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="m-auto">
              {{ $data['dataMail']->links() }}
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <table class="table edit_table table table-hover">
                  <thead class="table-info">
                    <tr class="text-center">
                     <th scope="col"><small><b>STT</b></small></th>
                     <th scope="col"><small><b>Người nhận</b></small></th>
                     <th scope="col"><small><b>Tiêu đề</b></small></th>
                     <th scope="col"><small><b>Thời gian</b></small></small></th>
                   </tr>
                 </thead>
                 <tbody>
                  @foreach ($data['dataSent'] as $key => $value)
                  <tr class="text-center">
                   <th>{{ $key + 1}} <a href="" title=""></th></a>
                   <td><small>{{ $value->tentaikhoan }}</small></td>
                   <td><small>{{ Str::words($value->tieu_de,10,'...') }}</small></td>
                   <td><small>{{ $value->created_at }}</small></td>
                </tr>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="m-auto">
              {{ $data['dataMail']->links() }}
            </div>
          </div>
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