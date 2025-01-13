@extends('layouts/blankLayout')

@section('title', 'Đăng nhập')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="https://newpub.adpia.vn/icons/logo-newpub-tet-01.svg" style="width: 120px;">
              </span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Chào mừng đến {{config('variables.templateName')}}! 👋</h4>
          <p class="mb-6">Xin vui lòng đăng nhập tài khoản của bạn và bắt đầu kiếm tiền nào!</p>

          <form id="formAuthentication" class="mb-6" action="{{url('/')}}" method="GET">
            <div class="mb-6">
              <label for="email" class="form-label">Email/Username</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Mật khẩu</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-8">
              <div class="d-flex justify-content-between mt-8">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    Lưu đăng nhập
                  </label>
                </div>
                <a href="{{ route('forgot-password') }}">
                  <span>Quên mật khẩu?</span>
                </a>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">Đăng nhập</button>
            </div>
          </form>

          <p class="text-center">
            <span>Bạn chưa có tài khoản?</span>
            <a href="{{ route('register') }}">
              <span>Đăng ký</span>
            </a>
          </p>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
@endsection
