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
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/css/autoComplete.02.min.css">
@endsection

@section('content')

  <!-- Text alignment -->
  <div class="row mb-6">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('report-order') }}" method="GET">
            <div class="row">
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Khoảng ngày</label>
                <x-date-range-input name="date" date="{{ request('date') }}" />
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Chiến dịch</label>
                <input type="text" class="form-control" placeholder="Enter something" id="autoComplete" name="keyword"
                  value="{{ request('keyword') }}" />
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Mã chuyển đổi/đơn hàng</label>
                <div class="input-group">
                  <button type="button" class="btn btn-outline-primary" id="code-name">Chuyển đổi</button>
                  <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0);"
                        onclick="handleChangeCode('code', 'Chuyển đổi')">Chuyển đổi</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);"
                        onclick="handleChangeCode('order_code', 'Đơn hàng')">Đơn hàng</a></li>
                  </ul>
                  <input type="hidden" name="code_key" value="{{ request('code_key') }}">
                  <input type="text" class="form-control" name="code_value" value="{{ request('code_value') }}">
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label for="exampleFormControlSelect1" class="form-label">Trạng thái</label>
                <select class="form-select" name="status">
                  <option value="">Tất cả</option>
                  <option value="Paid"{{ request('status') == 'Paid' ? 'selected' : '' }}>Đã thanh toán</option>
                  <option value="Approved"{{ request('status') == 'Approved' ? 'selected' : '' }}>Đã duyệt</option>
                  <option value="Pending"{{ request('status') == 'Pending' ? 'selected' : '' }}>Tạm duyệt</option>
                  <option value="Cancelled"{{ request('status') == 'Cancelled' ? 'selected' : '' }}>Hủy</option>
                </select>
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Sub ID 1</label>
                <input type="text" class="form-control" placeholder="VD: google, facebook..." name="sub1"
                  value="{{ request('sub1') }}" />
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Sub ID 2</label>
                <input type="text" class="form-control" placeholder="VD: cpc, ads, banner,..." name="sub2"
                  value="{{ request('sub2') }}" />
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Sub ID 3</label>
                <input type="text" class="form-control" placeholder="VD: the-tin-dung, vay-sinh-vien,..."
                  name="sub3" value="{{ request('sub3') }}" />
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label class="form-label">Sub ID 4</label>
                <input type="text" class="form-control" placeholder="VD: ngay-10-10, giam-lai-suat,..." name="sub4"
                  value="{{ request('sub4') }}" />
              </div>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <label></label>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                  <span class="tf-icons bx bx-filter bx-18px me-2"></span>Lọc
                </button>
              </div>
            </div>
          </form>
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
                <div class="d-flex h-100 rounded align-items-center justify-content-center"
                  style="background-color: #e9f9df">
                  <i class="bx bxs-pointer" style="color: #69df31"></i>
                </div>
              </div>
            </div>
            <p class="mb-1">Lượt click</p>
            <h4 class="card-title mb-3" id="total-click-value">0</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12 mb-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <div class="d-flex h-100 rounded align-items-center justify-content-center"
                  style="background-color: #d5f6fd">
                  <i class="bx bx-transfer" style="color: #30c5e2"></i>
                </div>
              </div>
            </div>
            <p class="mb-1">Số chuyển đổi</p>
            <h4 class="card-title mb-3" id="total-conversion-value">0</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12 mb-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <div class="d-flex h-100 rounded align-items-center justify-content-center"
                  style="background-color: #ffdfd5">
                  <i class="bx bxs-coin-stack" style="color: #f35b40"></i>
                </div>
              </div>
            </div>
            <p class="mb-1">Giá trị chuyển đổi</p>
            <h4 class="card-title mb-3" id="total-price-value">0₫</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12 mb-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <div class="d-flex h-100 rounded align-items-center justify-content-center"
                  style="background-color: #e8e8ff">
                  <i class="bx bxs-wallet" style="color: #7f7bee"></i>
                </div>
              </div>
            </div>
            <p class="mb-1">Hoa hồng phát sinh</p>
            <h4 class="card-title mb-3" id="total-com-value">0₫</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <a href="{{ route('report-order-export', request()->all()) }}" target="_blank" class="btn btn-primary mb-6 text-white">
      <span class="tf-icons bx bx-download bx-18px me-2"></span>Export
    </a>
  </div>
  <div class="card">
    <h5 class="card-header">Dữ liệu</h5>
    {{-- <div class="card-body">
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
  </div> --}}
    @if (!$data->isEmpty())
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID chuyển đổi</th>
              <th>Thời gian phát sinh</th>
              <th>Thời gian click</th>
              <th>Chiến dịch</th>
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
            @foreach ($data as $key => $row)
              <tr style="cursor: pointer;" onclick="handleShowOrderDetail('{{ $key }}')">
                <td>
                  {{ $row->code }}
                </td>
                <td>
                  {{ $row->order_time }}
                </td>
                <td>
                  {{ $row->click->created_at }}
                </td>
                <td>
                  {{ $row->campaign->name }}
                </td>
                <td>
                  {{ $row->order_code }}
                </td>
                <td>
                  {{ number_format($row->unit_price, 0, ',', '.') }}
                </td>
                <td>
                  {{ number_format($row->commission_pub, 0, ',', '.') }}
                </td>
                <td>
                  @if ($row->status == 'Pending')
                    <span class="badge bg-label-warning me-1">Tạm duyệt</span>
                  @elseif ($row->status == 'Approved' && !$row->paid_at)
                    <span class="badge bg-label-success me-1">Đã duyệt</span>
                  @elseif ($row->status == 'Approved' && $row->paid_at)
                    <span class="badge bg-label-success me-1">Đã thanh toán</span>
                  @else
                    <span class="badge bg-label-danger me-1">Đã hủy</span>
                  @endif
                </td>
                <td>
                  {{ $row->click->linkHistory->sub1 ?? 'N/A' }}
                </td>
                <td>
                  {{ $row->click->linkHistory->sub2 ?? 'N/A' }}
                </td>
                <td>
                  {{ $row->click->linkHistory->sub3 ?? 'N/A' }}
                </td>
                <td>
                  {{ $row->click->linkHistory->sub4 ?? 'N/A' }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-body">
        <x-paginate :paginator="$data" />
      </div>
    @else
      <x-empty-data />
    @endif
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
          <div class="table-responsive">
            <table class="table table-striped">
              <tbody class="table-border-bottom-0">
                <tr></tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ Text alignment -->

  <!--/ Card layout -->
@endsection
@section('page-script')
  <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  @vite('resources/assets/js/autocomplete.js')
  <script>
    $("#dropdownMenuButton").click(function() {
      new bootstrap.Dropdown(document.querySelector('.dropdown-toggle')).toggle();
    });

    function handleChangeCode(key, name) {
      $("#code-name").html(name);
      $("input[name=code_key]").val(key);
    }

    const detailModal = new bootstrap.Modal("#modalDetail");

    function handleShowOrderDetail(key) {
      let order = {!! json_encode($data) !!};
      order = order.data[key];
      let html = `
    <tr>
      <td class="text-nowrap">Chiến dịch</td>
      <td><a href="/campaigns/${order.campaign.code}">${order.campaign.name}</a></td>
    </tr>
    <tr>
      <td class="text-nowrap">ID click</td>
      <td>${order.click.code}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Thiêt bị</td>
      <td>${order.click.agent != null ? order.click.agent : 'N/A'}</td>
    </tr>
    <tr>
      <td class="text-nowrap">IP</td>
      <td>${order.click.ip != null ? order.click.ip : 'N/A'}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Mã sản phẩm</td>
      <td style="white-space: normal;">${order.product_code}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Tên sản phẩm</td>
      <td style="white-space: normal;">${order.product_name}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Sub ID 1</td>
      <td>${order.click.link_history.sub1 != null ? order.click.link_history.sub1 : 'N/A'}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Sub ID 2</td>
      <td>${order.click.link_history.sub2 != null ? order.click.link_history.sub2 : 'N/A'}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Sub ID 3</td>
      <td>${order.click.link_history.sub3 != null ? order.click.link_history.sub3 : 'N/A'}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Sub ID 4</td>
      <td>${order.click.link_history.sub4 != null ? order.click.link_history.sub4 : 'N/A'}</td>
    </tr>
    <tr>
      <td class="text-nowrap">Link gốc</td>
      <td>${order.click.link_history.original_url != null ? order.click.link_history.original_url : 'N/A'}</td>
    </tr>
    `;
      $("#modalDetail table tbody").html(html);
      detailModal.show();
    }

    $(document).ready(function() {
      let codeKey = '{{ request('code_key') }}';

      if (codeKey) {
        let name = 'Chuyển đổi';
        if (codeKey == 'order_code') {
          name = 'Đơn hàng';
        }
        $("#code-name").html(name);
      }
    });

    animateNumber('#total-click-value', {{ $clickCount }});
    animateNumber('#total-conversion-value', {{ $totalConversion }});
    animateNumber('#total-price-value', {{ $totalPrice }}, '₫');
    animateNumber('#total-com-value', {{ $totalCom }}, '₫');
  </script>
@endsection
