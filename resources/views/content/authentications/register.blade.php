@extends('layouts/blankLayout')

@section('title', 'Đăng ký')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection


@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
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
          <h4 class="mb-1">Hãy cùng kiếm tiền nào 🚀</h4>
          <p class="mb-6">Điền thông tin của bạn vào mẫu bên dưới thật dễ dàng!</p>

          <form id="formAuthentication" class="mb-6" action="{{url('/')}}" method="GET">
            <div class="mb-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus>
            </div>
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Mật khẩu</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="my-8">
              <div class="form-check mb-0 ms-2">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                <label class="form-check-label" for="terms-conditions">
                  Tôi đồng ý với
                  <a href="{{ route('terms-of-service') }}">Điều khoản dịch vụ</a> và <a href="{{ route('privacy-policy') }}">Chính sách bảo mật</a>
                </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">
              Đăng ký
            </button>
          </form>

          <p class="text-center">
            <span>Bạn đã có tài khoản?</span>
            <a href="{{ route('login') }}">
              <span>Đăng nhập</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
@endsection
