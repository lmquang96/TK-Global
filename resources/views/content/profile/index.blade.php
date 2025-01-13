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
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-user me-1_5"></i> Thông tin cá nhân</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('change-password')}}"><i class="bx bx-sm bx-lock-alt me-1_5"></i> Đổi mật khẩu</a></li>
      </ul>
    </div>
    <div class="card mb-6">
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
          <img src="{{asset('assets/img/avatars/my-avatar.jpg')}}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Tải lên ảnh mới</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>

            <div>Tải lên ảnh JPG, GIF hoặc PNG. Dung lượng tối đa 2MB</div>
          </div>
        </div>
      </div>
      <div class="card-body pt-4">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row g-6">
            <div class="col-md-6">
              <label for="firstName" class="form-label">Username</label>
              <input class="form-control" type="text" id="firstName" name="firstName" value="admin" autofocus />
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Họ và tên</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="Lê Minh Quang" />
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input class="form-control" type="text" id="email" name="email" value="admin@example.com" placeholder="john.doe@example.com" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="phoneNumber">Số điện thoại</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">VN (+84)</span>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="326018395" value="0326018395" />
              </div>
            </div>
            <div class="col-md-6">
              <label for="address" class="form-label">Địa chỉ</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="Mễ Trì, Nam Từ Liêm" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="country">Thành phố</label>
              <select id="country" class="select2 form-select">
                <option value="">-- Chọn --</option>
                <option value="Australia" selected>Hà Nội</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
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
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row g-6">
            <div class="col-md-6">
              <label for="firstName" class="form-label">Chủ tài khoản</label>
              <input class="form-control" type="text" id="firstName" name="firstName" value="LE MINH QUANG" autofocus />
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Số tài khoản</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="987654987654" />
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Ngân hàng</label>
              <input class="form-control" type="text" id="email" name="email" value="Quỹ Tín dụng Nhân dân Trung ương - CCF" placeholder="john.doe@example.com" />
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Chi nhánh</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="Hà Nội" />
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Số CMT/CCCD</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="123456789112" />
            </div>
            <div class="col-md-6">
              <label for="address" class="form-label">Ngày cấp</label>
              <input type="date" class="form-control" id="address" name="address" value="2025-01-10" />
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Nơi cấp</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="Cục Cảnh sát quản lí hành chính về trật tự xã hội" />
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Mã số thuế</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="8638110008" />
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

<!--/ Card layout -->
@endsection
