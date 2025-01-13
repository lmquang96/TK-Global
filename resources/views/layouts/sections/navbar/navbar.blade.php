@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
@endif
@if(isset($navbarDetached) && $navbarDetached == '')
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="{{$containerNav}}">
    @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
          <span class="app-brand-text demo menu-text fw-bold text-heading">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
          <i class="bx bx-menu bx-md"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          {{-- <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search bx-md"></i>
            <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Tìm kiếm..." aria-label="Search...">
          </div> --}}
          @yield('page-title')
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <li class="nav-item lh-1 me-4">
            <button type="button" class="btn rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalSupport">
              <span class="tf-icons bx bx-support bx-18px me-2"></span>Liên hệ hỗ trợ
            </button>
          </li>

          <li class="nav-item lh-1 me-4">
            <div class="position-relative">
              <i class='bx bx-bell fs-3'></i>
              <div class="position-absolute top-0 end-0">
                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="height: 16px; width: 16px; font-size: 12px;">
                  9  
                </div>
              </div>
            </div>
            {{-- <a class="github-button" href="{{config('variables.repository')}}" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-laravel-admin-template-free on GitHub">Star</a> --}}
          </li>

          <!-- Place this tag where you want the button to render. -->
          <li class="nav-item lh-1 me-4">
            <div class="text-end">
              <div>
                lmquang96
              </div>
              <small class="d-block mt-1 text-sm text-warning">
                Thành viên
              </small>
            </div>
            {{-- <a class="github-button" href="{{config('variables.repository')}}" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-laravel-admin-template-free on GitHub">Star</a> --}}
          </li>

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/my-avatar.jpg') }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/my-avatar.jpg') }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">lmquang96</h6>
                      <small class="text-muted">Thành viên</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('profile') }}">
                  <i class="bx bx-user bx-md me-3"></i><span>Thông tin</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('terms-of-service') }}">
                  <i class="bx bx-list-check bx-md me-3"></i><span>Điều khoản dịch vụ</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('privacy-policy') }}">
                  <i class="bx bx-check-shield bx-md me-3"></i><span>Chính sách bảo mật</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('login') }}">
                  <i class="bx bx-power-off bx-md me-3"></i><span>Đăng xuất</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- Modal -->
  <div class="modal fade" id="modalSupport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Thông tin hỗ trợ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col d-flex gap-3">
              <div style="height: 20px;">
                <img src="https://rutdao247.vn/wp-content/uploads/2023/11/zalo-logo.png" alt="" style="height: 100%; padding: 2px;">
              </div>
              <div>
                <a href="#" target="_blank" class="text-decoration-underline">Liên hệ qua Zalo</a>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col d-flex gap-3">
              <div style="height: 20px;">
                <img src="https://cdn4.iconfinder.com/data/icons/social-media-2285/1024/logo-512.png" alt="" style="height: 100%;">
              </div>
              <div>
                <a href="#" target="_blank" class="text-decoration-underline">Liên hệ qua Fanpage</a>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col d-flex gap-3">
              <div>
                <i class='bx bxs-envelope text-primary'></i>
              </div>
              <div>
                example@gmail.com
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col d-flex gap-3">
              <div>
                <i class='bx bxs-phone text-primary'></i>
              </div>
              <div>
                0987654321
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col d-flex gap-3">
              <div>
                <i class='bx bxl-skype text-primary'></i>
              </div>
              <div>
                live:lmquang96
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
  <!-- / Navbar -->
