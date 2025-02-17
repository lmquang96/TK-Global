@extends('layouts/blankLayout')

@section('title', 'Xác thực Email')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic px-4">
      <div class="authentication-inner">


        <!-- Verify Email -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1"
                class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="{{ asset(config('app.site_logo')) }}" style="width: 160px;">
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1">Xác thực Email của bạn ✉️</h4>
            <p class="text-start mb-0">
              Link kích hoạt tài khoản sẽ được gửi tới địa chỉ email của bạn: <span
                class="fw-medium text-heading">{{ auth()->user()->email }}</span> Vui lòng nhấp vào link bên dưới để tiếp
              tục.
            </p>
            <form id="formVerification" action="{{ route('verification.send') }}" method="POST">
              @csrf
              <a class="btn btn-primary w-100 my-6" href="javascript:void(0)"
                onclick="event.preventDefault(); this.closest('#formVerification').submit();">
                Gửi xác thực
              </a>
            </form>
          </div>
        </div>
        <!-- /Verify Email -->
      </div>
    </div>
  </div>
@endsection
