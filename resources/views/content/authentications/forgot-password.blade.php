@extends('layouts/blankLayout')

@section('title', 'Quên mật khẩu')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">

      <!-- Forgot Password -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="https://newpub.adpia.vn/icons/logo-newpub-tet-01.svg" style="width: 120px;">
              </span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Quên mật khẩu? 🔒</h4>
          <p class="mb-6">Nhập email của bạn và chúng tôi sẽ gửi thông tin để đổi mật khẩu</p>
          <form id="formAuthentication" class="mb-6" action="{{url('/')}}" method="GET">
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
            </div>
            <button class="btn btn-primary d-grid w-100">Gửi</button>
          </form>
          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl me-1"></i>
              Quay về đăng nhập
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection
