@extends('layouts/blankLayout')

@section('title', 'Đăng nhập')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
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
              <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="{{ asset(config('app.site_logo')) }}" style="width: 160px;">
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1">Chào mừng đến {{ config('variables.templateName') }}! 👋</h4>
            <p class="mb-6">Xin vui lòng đăng nhập tài khoản của bạn và bắt đầu kiếm tiền nào!</p>

            <form id="formAuthentication" class="mb-6" action="{{ route('authenticate') }}" method="POST">
              @csrf
              @if ($errors->any())
                {!! implode(
                    '',
                    $errors->all('<label style="color: #ff3e1d; font-size: 85%; margin-bottom: 0.25rem;">:message</label>'),
                ) !!}
              @endif
              <div class="mb-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email của bạn"
                  autofocus>
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">Mật khẩu</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-8">
                <div class="d-flex justify-content-between mt-8">
                  <div class="form-check mb-0 ms-2">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
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
@section('page-script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
    integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @vite('resources/assets/js/authenticate.js')
@endsection
