@extends('layouts/contentNavbarLayout')

@section('title', 'Báo cáo đơn hàng')
@section('page-title')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mb-0">
    <li class="breadcrumb-item">
      <a href="javascript:void(0);">Báo cáo</a>
    </li>
    <li class="breadcrumb-item active">
      Đơn hàng
    </li>
  </ol>
</nav>
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/page-icons.scss')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/css/autoComplete.02.min.css">
@endsection

@section('content')

<!-- Text alignment -->
<div class="row mb-6">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-4 mb-4">
            <label class="form-label">Khoảng ngày</label>
            <x-date-range-input name="yyyymmdd" />
          </div>
          <div class="col-4 mb-4">
            <label class="form-label">Chiến dịch</label>
            <input type="text" class="form-control" placeholder="Shopee" id="autoComplete" />
          </div>
          <div class="col-4 mb-4">
            <label class="form-label">Mã chuyển đổi/đơn hàng</label>
            <div class="input-group">
              <button type="button" class="btn btn-outline-primary">Chuyển đổi</button>
              <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);">Chuyển đổi</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Đơn hàng</a></li>
              </ul>
              <input type="text" class="form-control">
            </div>
          </div>
          <div class="col-4 mb-4">
            <label for="exampleFormControlSelect1" class="form-label">Trạng thái</label>
            <select class="form-select">
              <option value="1">Tất cả</option>
              <option value="2">Tạm duyệt</option>
              <option value="3">Đã duyệt</option>
              <option value="4">Hủy</option>
            </select>
          </div>
          <div class="col-4 mb-4">
            <label class="form-label">Sub ID 1</label>
            <input type="text" class="form-control" placeholder="Shopee" />
          </div>
          <div class="col-4 mb-4">
            <label class="form-label">Sub ID 2</label>
            <input type="text" class="form-control" placeholder="Shopee" />
          </div>
          <div class="col-4 mb-4">
            <label class="form-label">Sub ID 3</label>
            <input type="text" class="form-control" placeholder="Shopee" />
          </div>
          <div class="col-4 mb-4">
            <label class="form-label">Sub ID 4</label>
            <input type="text" class="form-control" placeholder="Shopee" />
          </div>
          <div class="col-4 mb-4">
            <label></label>
            <button type="button" class="btn btn-primary" style="width: 100%;">
              <span class="tf-icons bx bx-filter bx-18px me-2"></span>Lọc
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- <h6 class="pb-1 mb-6 text-muted">Chiến dịch nổi bật</h6> --}}
<div class="col-lg-12 col-md-12 order-1">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-12 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="paypal" class="rounded">
            </div>
          </div>
          <p class="mb-1">Lượt click</p>
          <h4 class="card-title mb-3">2.456</h4>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
            </div>
          </div>
          <p class="mb-1">Số chuyển đổi</p>
          <h4 class="card-title mb-3">9.652</h4>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
            </div>
          </div>
          <p class="mb-1">Giá trị chuyển đổi</p>
          <h4 class="card-title mb-3">88.489.320₫</h4>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
            </div>
          </div>
          <p class="mb-1">Hoa hồng phát sinh</p>
          <h4 class="card-title mb-3">12.628.500₫</h4>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <h5 class="card-header">Dữ liệu</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-6 col-lg-3 d-flex align-items-center">
        <div class="me-2" style="white-space: nowrap;">Hiển thị</div>
        <select class="form-select me-2">
          <option value="1" selected="">25</option>
          <option value="2">50</option>
          <option value="3">100</option>
        </select>
        <div style="white-space: nowrap;">Kết quả</div>
      </div>
      <div class="col-6 col-lg-3">
        <button type="button" class="btn btn-outline-primary">
          <span class="tf-icons bx bx-download bx-18px me-2"></span>Tải xuống
        </button>
      </div>
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID chuyển đổi</th>
          <th>Thời gian phát sinh</th>
          <th>Thời gian click</th>
          <th>ID đơn hàng</th>
          <th>Giá trị đơn hàng(₫)</th>
          <th>Hoa hồng(₫)</th>
          <th>Trạng thái</th>
          <th>Sub ID 1</th>
          <th>Sub ID 2</th>
          <th>Sub ID 3</th>
          <th>Sub ID 4</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @for ($i = 0; $i < 5; $i++)
        <tr style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalDetail">
          <td>
            5b9f309f7e38ff6db7dbfb4fb10e09a3
          </td>
          <td>
            2025-01-07 13:45:51
          </td>
          <td>
            2025-01-07 13:45:51
          </td>
          <td>
            1360133424012396
          </td>
          <td>
            {{ number_format(2456789, 0, ',', '.') }}
          </td>
          <td>
            {{ number_format(2456, 0, ',', '.') }}
          </td>
          <td>
            <span class="badge bg-label-warning me-1">Tạm duyệt</span>
          </td>
          <td>
            facebook
          </td>
          <td>
            ads
          </td>
          <td>
            giam-gia-soc-thang-1
          </td>
          <td>
          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
  <div class="card-body">
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li class="page-item first">
          <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left bx-sm"></i></a>
        </li>
        <li class="page-item prev">
          <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left bx-sm"></i></a>
        </li>
        <li class="page-item">
          <a class="page-link" href="javascript:void(0);">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="javascript:void(0);">2</a>
        </li>
        <li class="page-item active">
          <a class="page-link" href="javascript:void(0);">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="javascript:void(0);">4</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="javascript:void(0);">5</a>
        </li>
        <li class="page-item next">
          <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right bx-sm"></i></a>
        </li>
        <li class="page-item last">
          <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right bx-sm"></i></a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Chi tiết đơn hàng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <tbody class="table-border-bottom-0">
              <tr>
                <td>
                  Chiến dịch
                </td>
                <td>
                  Shopee MCN
                </td>
              </tr>
              <tr>
                <td>
                  ID click
                </td>
                <td>
                  e107d7d717052de30d7c1abe667c8d88
                </td>
              </tr>
              <tr>
                <td>
                  Thiêt bị
                </td>
                <td>
                  N/A
                </td>
              </tr>
              <tr>
                <td>
                  IP
                </td>
                <td>
                  113.185.104.65
                </td>
              </tr>
              <tr>
                <td>
                  Tên sản phẩm
                </td>
                <td style="white-space: normal;">
                  Đầm Midi Dáng Xoè Cotton Lạnh Xếp Ly Vai, Váy Dáng Dài Thời Trang Nữ Thanh Lịch Maybi
                </td>
              </tr>
              <tr>
                <td>
                  Sub ID 1
                </td>
                <td>
                  facebook
                </td>
              </tr>
              <tr>
                <td>
                  Sub ID 2
                </td>
                <td>
                  ads
                </td>
              </tr>
              <tr>
                <td>
                  Sub ID 3
                </td>
                <td>
                  giam-gia-sap-san-thang-1
                </td>
              </tr>
              <tr>
                <td>
                  Sub ID 4
                </td>
                <td>
                  N/A
                </td>
              </tr>
              <tr>
                <td>
                  Link gốc
                </td>
                <td>
                  https://shopee.vn/
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
@endsection
@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
@vite('resources/assets/js/autocomplete.js')
@endsection