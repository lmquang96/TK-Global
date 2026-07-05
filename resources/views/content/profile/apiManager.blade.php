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
          <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}"><i class="bx bx-sm bx-user me-1_5"></i>
              Thông tin cá nhân</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('change-password') }}"><i
                class="bx bx-sm bx-lock-alt me-1_5"></i> Đổi mật khẩu</a></li>
          <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                class="bx bx-sm bx-extension me-1_5"></i>
              API Access</a></li>
        </ul>
      </div>
      <div class="card mb-6">
        <h5 class="card-header">API Documentation</h5>
        <div class="card-body pt-1">
          <div>Use your API Token to authenticate requests.</div>
          <div>Base URL</div>
          <div>https://api.network.com/v1</div>
          <div>[ View Documentation ]</div>
        </div>
      </div>
      <div class="card mb-6">
        <h5 class="card-header">Your API Tokens</h5>
        <div class="card-body pt-1">
          <div class="mb-4">
            <button class="btn btn-primary disabled">+ Create Token</button>
          </div>
          <div class="col-md-6 mb-4">
            <div class="input-group">
              <input type="text" class="form-control" id="affiliate-id"
                value="{{ auth()->user()->profile->affiliate_id }}" readonly
                style="color: #a7acb2;     background-color: rgba(34, 48, 62, 0.06); border-color: #cacdd1; opacity: 1;">
              <button class="btn btn-primary" type="button" onclick="handleCopy('#affiliate-id')">
                <i class='bx bx-copy me-2'></i> Copy
              </button>
            </div>
          </div>
          <div class="mb-4">
            Please save it securely.
          </div>
          <div>
            <button class="btn btn-primary disabled">+ Generate new Token</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Text alignment -->

  <!--/ Card layout -->
@endsection
@section('page-script')
@endsection
