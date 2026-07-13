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
          <div><a href="{{ env('APP_URL') . '/docs' }}">[ View Documentation ]</a></div>
        </div>
      </div>
      <div class="card mb-6">
        <h5 class="card-header">Your API Credentials</h5>
        <div class="card-body pt-1">
          @if (!$clientToken)
            <div class="mb-4">
              <form action="{{ route('generate-client') }}" method="GET">
                <button class="btn btn-primary{{ $apiToken ? ' disabled' : '' }}">+ Create Token</button>
              </form>
            </div>
          @else
            <div class="col-md-6 mb-4">
              <label class="form-label" for="client_id">API Key</label>
              <div class="input-group">
                <input type="text" class="form-control" id="client_id" value="{{ $clientToken->client_id }}" readonly
                  style="color: #a7acb2; background-color: rgba(34, 48, 62, 0.06); border-color: #cacdd1; opacity: 1;">
                <button class="btn btn-primary" type="button"
                  onclick="handleCopy('#client_id', 'Sao chép API key thành công')">
                  <i class='bx bx-copy me-2'></i> Copy
                </button>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <label class="form-label" for="client_secret">API Secret</label>
              <div class="input-group">
                <input type="text" class="form-control" id="client_secret" value="{{ $clientToken->client_secret }}"
                  readonly
                  style="color: #a7acb2; background-color: rgba(34, 48, 62, 0.06); border-color: #cacdd1; opacity: 1;">
                <button class="btn btn-primary" type="button"
                  onclick="handleCopy('#client_secret', 'Sao chép API Secret thành công')">
                  <i class='bx bx-copy me-2'></i> Copy
                </button>
              </div>
            </div>
            <div>
              <form action="{{ route('update-client') }}" method="POST">
                @csrf
                <button class="btn btn-primary">+ Generate new Token</button>
              </form>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- Toast with Placements -->
  <x-toast type="info" message="Sao chép thành công" />
  <!-- Toast with Placements -->
  <!--/ Text alignment -->

  <!--/ Card layout -->
@endsection
@section('page-script')
  <script>
    function handleCopy(target, $msg = "Sao chép thành công!") {
      let copyText = $(target);
      copyText.select();
      copyText[0].setSelectionRange(0, 99999);
      document.execCommand('copy');
      $(".toast-body").html($msg);
      toastShow();
    }
  </script>
@endsection
