@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')
@section('page-title')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mb-0">
      <li class="breadcrumb-item active">
        <a href="javascript:void(0);">Tổng quan</a>
      </li>
    </ol>
  </nav>
@endsection

@section('vendor-style')
  @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
  @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
  @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
  <div class="row">
    <div class="col-xxl-8 mb-6 order-0">
      <div class="card">
        <div class="d-flex align-items-start row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary mb-3">Xin chào {{ auth()->user()->name }}! 🎉</h5>
              <p class="mb-6">Hôm nay bạn đã kiếm đươc nhiều hoa hồng chưa?<br>Hãy kiểm tra
                chi tiết trong báo cáo của bạn.</p>

              <a href="{{ route('report-performance') }}" class="btn btn-sm btn-outline-primary">Xem ngay</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-6">
              <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="175" class="scaleX-n1-rtl"
                alt="View Badge User">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 order-1">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-12 mb-6">
          <x-statistics bg="#e9f9df" color="#69df31" icon="bxs-pointer" idValue="total-click-value"
            idChange="total-click-change" title="Lượt click"
            changeType="{{ $clickCountChange > 0 ? 'success' : 'danger' }}"
            arrowIcon="{{ $clickCountChange > 0 ? 'up-arrow-alt' : 'down-arrow-alt' }}" />
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-6">
          <x-statistics bg="#d5f6fd" color="#30c5e2" icon="bx-transfer" idValue="total-conversion-value"
            idChange="total-conversion-change" title="Số chuyển đổi"
            changeType="{{ $totalConversionChange > 0 ? 'success' : 'danger' }}"
            arrowIcon="{{ $totalConversionChange > 0 ? 'up-arrow-alt' : 'down-arrow-alt' }}" />
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-6">
          <x-statistics bg="#ffdfd5" color="#f35b40" icon="bxs-coin-stack" idValue="total-sales-value"
            idChange="total-sales-change" title="Giá trị chuyển đổi"
            changeType="{{ $totalSalesChange > 0 ? 'success' : 'danger' }}"
            arrowIcon="{{ $totalSalesChange > 0 ? 'up-arrow-alt' : 'down-arrow-alt' }}" />
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-6">
          <x-statistics bg="#e8e8ff" color="#7f7bee" icon="bxs-wallet" idValue="total-commission-value"
            idChange="total-commission-change" title="Hoa hồng phát sinh"
            changeType="{{ $totalComChange > 0 ? 'success' : 'danger' }}"
            arrowIcon="{{ $totalComChange > 0 ? 'up-arrow-alt' : 'down-arrow-alt' }}" />
        </div>
      </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-lg-12">
            <div class="card-header d-flex align-items-center justify-content-between">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Biểu đồ</h5>
              </div>
              {{-- <div class="dropdown">
                <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded bx-lg text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                  <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                </div>
              </div> --}}
            </div>
            <div class="card-header d-flex mb-6 pt-0">
              <div class="avatar flex-shrink-0 me-3">
                <div class="d-flex h-100 rounded align-items-center justify-content-center"
                  style="background-color: #e8e8ff">
                  <i class="bx bxs-wallet" style="color: #7f7bee"></i>
                </div>
              </div>
              <div>
                <p class="mb-0">Tổng hoa hồng</p>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1" id="chart-total-com">0₫</h6>
                  <small class="text-{{ $totalComChange > 0 ? 'success' : 'danger' }} fw-medium">
                    <i class='bx {{ $totalComChange > 0 ? 'bx-chevron-up' : 'bx-chevron-down' }} bx-lg'></i>
                    <span id="chart-total-com-change">0%</span>
                  </small>
                </div>
              </div>
            </div>
            {{-- <div id="totalRevenueChart" class="px-3"></div> --}}
            <div id="incomeChart" class="px-3"></div>
          </div>
          {{-- <div class="col-lg-4 d-flex align-items-center">
          <div class="card-body px-xl-9">
            <div class="text-center mb-6">
              <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">
                  <script>
                  document.write(new Date().getFullYear() - 1)

                  </script>
                </button>
                <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0);">2021</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">2020</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">2019</a></li>
                </ul>
              </div>
            </div>

            <div id="growthChart"></div>
            <div class="text-center fw-medium my-6">Tăng trưởng 62%</div>

            <div class="d-flex gap-3 justify-content-between">
              <div class="d-flex">
                <div class="avatar me-2">
                  <span class="avatar-initial rounded-2 bg-label-primary"><i class="bx bx-dollar bx-lg text-primary"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>
                    <script>
                    document.write(new Date().getFullYear() - 1)

                    </script>
                  </small>
                  <h6 class="mb-0">3.565.885₫</h6>
                </div>
              </div>
              <div class="d-flex">
                <div class="avatar me-2">
                  <span class="avatar-initial rounded-2 bg-label-info"><i class="bx bx-wallet bx-lg text-info"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>
                    <script>
                    document.write(new Date().getFullYear() - 2)

                    </script>
                  </small>
                  <h6 class="mb-0">4.274.445₫</h6>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
        </div>
      </div>
    </div>
    <!--/ Total Revenue -->
    <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2">
      <div class="row">
        {{-- <div class="col-12 mb-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-sm-row flex-column gap-10">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title mb-6">
                  <h5 class="text-nowrap mb-1">Profile Report</h5>
                  <span class="badge bg-label-warning">YEAR 2022</span>
                </div>
                <div class="mt-sm-auto">
                  <span class="text-success text-nowrap fw-medium"><i class='bx bx-up-arrow-alt'></i> 68.2%</span>
                  <h4 class="mb-0">$84,686k</h4>
                </div>
              </div>
              <div id="profileReportChart"></div>
            </div>
          </div>
        </div>
      </div> --}}
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Order Statistics -->
    {{-- <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-6">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-1 me-2">Thống kê theo ngành hàng</h5>
            <p class="card-subtitle">42.822.222 giá trị chuyển đổi</p>
          </div>
          <div class="dropdown">
            <button class="btn text-muted p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded bx-lg"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
              <a class="dropdown-item" href="javascript:void(0);">Select All</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-6">
            <div class="d-flex flex-column align-items-center gap-1">
              <h3 class="mb-1">8,258</h3>
              <small>Tổng số đơn hàng</small>
            </div>
            <div id="orderStatisticsChart"></div>
          </div>
          <ul class="p-0 m-0">
            <li class="d-flex align-items-center mb-5">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-mobile-alt'></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Tài chính</h6>
                  <small>Mobile, Earbuds, TV</small>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">825</h6>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-5">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-success"><i class='bx bx-closet'></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Thương mại điện tử</h6>
                  <small>T-shirt, Jeans, Shoes</small>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">238</h6>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-5">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-info"><i class='bx bx-home-alt'></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Du lịch</h6>
                  <small>Fine Art, Dining</small>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">849</h6>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-secondary"><i class='bx bx-football'></i></span>
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">Khác</h6>
                  <small>Football, Cricket Kit</small>
                </div>
                <div class="user-progress">
                  <h6 class="mb-0">99</h6>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div> --}}
    <!--/ Order Statistics -->

    <!-- Expense Overview -->
    <div class="col-md-6 col-lg-8 order-1 mb-6">
      <div class="card h-100">
        <div class="card-header nav-align-top">
          <div class="card-title mb-0">
            <h5 class="mb-1 me-2">Thống kê lượt click</h5>
            {{-- <p class="card-subtitle">42.822.222 giá trị chuyển đổi</p> --}}
          </div>
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
              {{-- <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">20/12/2024 - 26/12/2024 </button> --}}
              <x-date-range-input name="chart-click-filter"
                date="{{ \Carbon\Carbon::now()->subDays(7)->format('Y-m-d') }} - {{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                borderColor="#696cff" />
            </li>
            {{-- <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Tháng trước</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Profit</button>
          </li> --}}
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
              <div class="d-flex mb-6">
                <div class="avatar flex-shrink-0 me-3">
                  <div class="d-flex h-100 rounded align-items-center justify-content-center"
                    style="background-color: #e9f9df">
                    <i class="bx bxs-pointer" style="color: #69df31"></i>
                  </div>
                </div>
                <div>
                  <p class="mb-0">Tổng số lượt click</p>
                  <div class="d-flex align-items-center">
                    <h6 class="mb-0 me-1">{{ $clickCount }}</h6>
                    <small class="text-{{ $clickCountChange > 0 ? 'success' : 'danger' }} fw-medium">
                      <i class='bx bx-chevron-{{ $clickCountChange > 0 ? 'up' : 'down' }} bx-lg'></i>
                      {{ round(abs($clickCountChange)) }}%
                    </small>
                  </div>
                </div>
              </div>
              <div id="profileReportChart"></div>
              {{-- <div class="d-flex align-items-center justify-content-center mt-6 gap-3">
                <div class="flex-shrink-0">
                  <div id="expensesOfWeek"></div>
                </div>
                <div>
                  <h6 class="mb-0">Click trong tuần này</h6>
                  <small>Ít hơn 432 so với 7 ngày trước</small>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Expense Overview -->

    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-6">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Các chiến dịch mới</h5>
          {{-- <div class="dropdown">
            <button class="btn text-muted p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded bx-lg"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
              <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
            </div>
          </div> --}}
        </div>
        <div class="card-body pt-4">
          <ul class="p-0 m-0">
            @foreach ($newCampaigns as $item)
              <li class="d-flex align-items-center mb-6">
                <div class="avatar flex-shrink-0 me-3">
                  <a href="{{ route('campaigns-detail', ['id' => $item->code]) }}">
                    <img src="{{ $item->image_square }}" alt="User" class="rounded-3">
                  </a>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="d-block">{{ $item->category->name }}</small>
                    <h6 class="fw-normal mb-0">{{ $item->name }}</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-2">
                    <h6 class="fw-normal mb-0">
                      +{{ $item->commission_type == 'percent' ? $item->commission * 100 : number_format($item->commission) }}
                    </h6> <span class="text-muted">{{ $item->commission_type == 'percent' ? '%' : '₫' }}</span>
                  </div>
                </div>
              </li>
            @endforeach
            {{-- <li class="d-flex align-items-center mb-6">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded">
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="d-block">Tài chính</small>
                  <h6 class="fw-normal mb-0">Cay vang CPS</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <h6 class="fw-normal mb-0">+270.000</h6> <span class="text-muted">₫</span>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-6">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('assets/img/icons/unicons/chart.png') }}" alt="User" class="rounded">
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="d-block">Du lịch</small>
                  <h6 class="fw-normal mb-0">Klook CPS</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <h6 class="fw-normal mb-0">+5</h6> <span class="text-muted">%</span>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-6">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="User" class="rounded">
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="d-block">Tài chính</small>
                  <h6 class="fw-normal mb-0">Sky Credit CPS</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <h6 class="fw-normal mb-0">+130.000</h6> <span class="text-muted">₫</span>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center mb-6">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded">
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="d-block">Thời trang</small>
                  <h6 class="fw-normal mb-0">K&G Viet nam CPS</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <h6 class="fw-normal mb-0">+12</h6> <span class="text-muted">%</span>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('assets/img/icons/unicons/cc-warning.png') }}" alt="User" class="rounded">
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="d-block">Khóa học</small>
                  <h6 class="fw-normal mb-0">Udemy CPS</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <h6 class="fw-normal mb-0">+92.500</h6> <span class="text-muted">₫</span>
                </div>
              </div>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
    <!--/ Transactions -->
  </div>
  <script>
    animateNumber('#total-click-value', {{ $clickCount }});
    animateNumber('#total-click-change', {{ abs($clickCountChange) }}, '%');
    animateNumber('#total-conversion-value', {{ $totalConversion }});
    animateNumber('#total-conversion-change', {{ abs($totalConversionChange) }}, '%');
    animateNumber('#total-sales-value', {{ $totalSales }}, '₫');
    animateNumber('#total-sales-change', {{ abs($totalSalesChange) }}, '%');
    animateNumber('#total-commission-value', {{ $totalCom }}, '₫');
    animateNumber('#total-commission-change', {{ abs($totalComChange) }}, '%');

    animateNumber('#chart-total-com', {{ $totalCom }}, '₫');
    animateNumber('#chart-total-com-change', {{ abs($totalComChange) }}, '%');
  </script>
@endsection
