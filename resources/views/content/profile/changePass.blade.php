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
        <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}"><i class="bx bx-sm bx-user me-1_5"></i> Thông tin cá nhân</a></li>
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-lock-alt me-1_5"></i> Đổi mật khẩu</a></li>
      </ul>
    </div>
    <div class="card mb-6">
      <h5 class="card-header">Đổi mật khẩu</h5>
      <div class="card-body pt-1">
        <form id="formAccountSettings" method="POST" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
          <div class="row">
            <div class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
              <label class="form-label" for="currentPassword">Mật khẩu hiện tại</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="············">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
          </div>
          <div class="row">
            <div class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
              <label class="form-label" for="newPassword">Mật khẩu mới</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="············">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>

            <div class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
              <label class="form-label" for="confirmPassword">Xác nhận mật khẩu</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
          </div>
          <h6 class="text-body">Yêu cầu mật khẩu:</h6>
          <ul class="ps-4 mb-0">
            <li class="mb-4">Độ dài ít nhất 8 kí tự trở lên</li>
            <li class="mb-4">Độ dài tối đa không quá 32 kí tự</li>
            <li>Có ít nhất một chữ hoa, một chữ số và một ký tự đặc biệt</li>
          </ul>
          <div class="mt-6">
            <button type="submit" class="btn btn-primary me-3">Lưu</button>
          </div>
        <input type="hidden"></form>
      </div>
    </div>
  </div>
</div>
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
