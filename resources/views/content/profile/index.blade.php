@extends('layouts/contentNavbarLayout')

@section('title', 'Thông tin tài khoản')
@section('page-title')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mb-0">
      <li class="breadcrumb-item active">
        <a href="javascript:void(0);">Thông tin tài khoản</a>
      </li>
    </ol>
  </nav>
@endsection

@section('page-style')
  @vite('resources/assets/vendor/scss/pages/page-icons.scss')
@endsection

@section('content')

  <!-- Text alignment -->
  <div class="row">
    <div class="col-md-12">
      <div class="nav-align-top">
        <ul class="nav nav-pills flex-column flex-md-row mb-6">
          <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-user me-1_5"></i>
              Thông tin cá nhân</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('change-password') }}"><i
                class="bx bx-sm bx-lock-alt me-1_5"></i> Đổi mật khẩu</a></li>
        </ul>
      </div>
      <div class="card mb-6">
        <!-- Account -->
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
            <img
              src="{{ !empty(auth()->user()->profile->avatar) ? asset('assets/img/avatars/' . auth()->user()->profile->avatar) : asset('assets/img/avatars/default.png') }}"
              alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar"
              style="object-fit: cover;" />
            <form id="form-avatar-upload" action="{{ route('profile-update-avatar') }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Tải lên ảnh mới</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="upload" class="account-file-input" hidden accept="image/*"
                    name="avatar" />
                </label>

                <div>Tải lên ảnh JPG, GIF hoặc PNG. Dung lượng tối đa 2MB</div>
              </div>
            </form>
          </div>
        </div>
        <div class="card-body pt-4">
          <form method="POST" action="{{ route('profile-update-personal-info') }}">
            @csrf
            @method('PUT')
            <div class="row g-6">
              <div class="col-md-6">
                <label for="name" class="form-label">Họ và tên</label>
                <input class="form-control" type="text" name="name" id="lastName"
                  value="{{ auth()->user()->name }}" />
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" id="email" name="email"
                  value="{{ auth()->user()->email }}" placeholder="admin@example.com" disabled />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="phone">Số điện thoại</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">VN (+84)</span>
                  <input type="text" id="phone" name="phone" class="form-control"
                    placeholder="Nhập số điện thoại của bạn" value="{{ auth()->user()->profile->phone ?? '' }}" />
                </div>
              </div>
              <div class="col-md-6">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address"
                  placeholder="Nhập địa chỉ của bạn" value="{{ auth()->user()->profile->address ?? '' }}" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="city">Thành phố</label>
                <select id="city" class="select2 form-select" name="city"></select>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="account_type">Loại tài khoản</label>
                <select id="account_type" class="select2 form-select" name="account_type">
                  <option value="Individual"
                    {{ !empty(auth()->user()->profile->account_type) && auth()->user()->profile->account_type == 'Individual' ? 'selected' : '' }}>
                    Cá
                    nhân</option>
                  <option value="Company"
                    {{ !empty(auth()->user()->profile->account_type) && auth()->user()->profile->account_type == 'Company' ? 'selected' : '' }}>
                    Doanh
                    nghiệp</option>
                </select>
              </div>
            </div>
            <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3">Lưu</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
      <div class="card">
        <h5 class="card-header">Thông tin thanh toán</h5>
        <div class="card-body pt-4">
          <form method="POST" action="{{ route('profile-update-payment-info') }}">
            @csrf
            @method('PUT')
            <div class="row g-6">
              <div class="col-md-6">
                <label for="bank_owner" class="form-label">Chủ tài khoản</label>
                <input class="form-control" type="text" id="bank_owner" name="bank_owner"
                  value="{{ auth()->user()->profile->bank_owner ?? '' }}"
                  placeholder="Nhập tên chủ tài khoản ngân hàng của bạn" />
              </div>
              <div class="col-md-6">
                <label for="bank_number" class="form-label">Số tài khoản</label>
                <input class="form-control" type="text" name="bank_number" id="bank_number"
                  value="{{ auth()->user()->profile->bank_number ?? '' }}"
                  placeholder="Nhập số tài khoản ngân hàng  của bạn" />
              </div>
              <div class="col-md-6">
                <label for="bank" class="form-label">Ngân hàng</label>
                <select id="bank" class="select2 form-select" name="bank"></select>
              </div>
              <div class="col-md-6">
                <label for="bank_branch" class="form-label">Chi nhánh</label>
                <input class="form-control" type="text" name="bank_branch" id="bank_branch"
                  value="{{ auth()->user()->profile->bank_branch ?? '' }}"
                  placeholder="Nhập tên chi nhánh ngân hàng của bạn" />
              </div>
              <div class="col-md-6">
                <label for="citizen_id_no" class="form-label">Số CMT/CCCD</label>
                <input class="form-control" type="text" name="citizen_id_no" id="citizen_id_no"
                  value="{{ auth()->user()->profile->citizen_id_no ?? '' }}" placeholder="Nhập số CMT/CCCD của bạn" />
              </div>
              <div class="col-md-6">
                <label for="citizen_id_date" class="form-label">Ngày cấp</label>
                <x-date-input name="citizen_id_date"
                  value="{{ auth()->user()->profile->citizen_id_date ?? \Carbon\Carbon::now()->format('Y-m-d') }}" />
              </div>
              <div class="col-md-6">
                <label for="citizen_id_place" class="form-label">Nơi cấp</label>
                <input class="form-control" type="text" name="citizen_id_place" id="citizen_id_place"
                  value="{{ auth()->user()->profile->citizen_id_place ?? '' }}"
                  placeholder="Nhập nơi cấp CMT/CCCD của bạn" />
              </div>
              <div class="col-md-6">
                <label for="tax" class="form-label">Mã số thuế</label>
                <input class="form-control" type="text" name="tax" id="tax"
                  value="{{ auth()->user()->profile->tax ?? '' }}" placeholder="Nhập mã số thuế của bạn" />
              </div>
            </div>
            <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3">Lưu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Text alignment -->

  <!-- Toast with Placements -->
  @if (\Session::has('message'))
    <x-toast type="info" message="{{ \Session::get('message') }}" />
  @endif
  @if ($errors->any())
    <x-toast type="error" message="{{ $errors->first() }}" />
  @endif
  <!-- Toast with Placements -->

  <!--/ Card layout -->
@endsection
@section('page-script')
  <script>
    $(document).ready(function() {
      $.ajax({
        type: "GET",
        url: "https://provinces.open-api.vn/api/",
        success: function(response) {
          let profileCity = '{{ auth()->user()->profile->city_code ?? null }}'
          let html = '<option value="">-- Chọn --</option>';
          $.each(response, function(index, item) {
            html +=
              `<option value="${item.code}|${item.name}" ${profileCity == item.code ? 'selected' : ''}>${item.name}</option>`;
          });

          $('#city').html(html);
        }
      });

      $.ajax({
        type: "GET",
        url: "https://api.vietqr.io/v2/banks",
        success: function(response) {
          let profileCity = '{{ auth()->user()->profile->bank_code ?? null }}'
          let html = '<option value="">-- Chọn --</option>';
          $.each(response.data, function(index, item) {
            html +=
              `<option value="${item.code}|${item.name}" ${profileCity == item.code ? 'selected' : ''}>${item.name}</option>`;
          });

          $('#bank').html(html);
        }
      });

      @if (Session::has('message') || $errors->any())
        {
          toastShow();
        }
      @endif
    });

    $("#upload").change(function(e) {
      e.preventDefault();

      if ($(this).val().length > 0) {
        $("#form-avatar-upload").submit();
      }
    });
  </script>
@endsection
