@extends('layouts/contentNavbarLayout')

@section('title', 'Báo cáo hiệu suất')
@section('page-title')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mb-0">
    <li class="breadcrumb-item">
      <a href="javascript:void(0);">Báo cáo</a>
    </li>
    <li class="breadcrumb-item active">
      Hiệu suất
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
          <div class="col-3">
            <label class="form-label">Khoảng ngày</label>
            <div class="input-group">
              <input type="text" class="form-control" name="yyyymmdd" id="datepicker">
              <span class="input-group-text" style="padding-left: calc(0.543rem - 2px); padding-right: calc(0.543rem - 2px);">
                <i class='bx bx-calendar'></i>
              </span>
            </div>
          </div>
          <div class="col-3">
            <label class="form-label">Chiến dịch</label>
            <input type="text" class="form-control" placeholder="Shopee" id="autoComplete" />
          </div>
          <div class="col-3 mt-auto">
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
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Chiến dịch</th>
          <th>Lượt click</th>
          <th>Chuyển đổi</th>
          <th>Giá trị chuyển đổi</th>
          <th>Hoa hồng</th>
          <th>Tỉ lệ</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @for ($i = 0; $i < 5; $i++)
        <tr>
          <td>
            <a href="#">Shopee MCN</a>
          </td>
          <td>
            {{ number_format(2456, 0, ',', '.') }}
          </td>
          <td>
            {{ number_format(2456, 0, ',', '.') }}
          </td>
          <td>
            {{ number_format(2456789, 0, ',', '.') }}
          </td>
          <td>
            {{ number_format(2456789, 0, ',', '.') }}
          </td>
          <td>
            {{ number_format(24.5, 1, ',', '.') }}%
          </td>
          <td>
            <a href="{{ route('report-order') }}">
              <span class="badge bg-label-primary me-1">Chi tiết</span>
            </a>
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
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/@easepick/datetime@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/core@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/base-plugin@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/range-plugin@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/preset-plugin@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/lock-plugin@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
<script>
  const picker = new easepick.create({
    element: document.getElementById('datepicker'),
    css: [
      'https://cdn.jsdelivr.net/npm/@easepick/core@1.2.1/dist/index.css',
      'https://cdn.jsdelivr.net/npm/@easepick/range-plugin@1.2.1/dist/index.css',
      'https://cdn.jsdelivr.net/npm/@easepick/preset-plugin@1.2.1/dist/index.css',
      'https://cdn.jsdelivr.net/npm/@easepick/lock-plugin@1.2.1/dist/index.css',
    ],
    zIndex: 999,
    lang: 'vi-VN',
    plugins: ['RangePlugin', 'PresetPlugin'],
    RangePlugin: {
      locale: {
        one: 'ngày',
        other: 'ngày',
      }
    },
    PresetPlugin: {
      customLabels: [
        'Hôm nay',
        'Hôm qua',
        '7 ngày trước',
        '30 ngày trước',
        'Tháng này',
        'Tháng trước'
      ]
    },
  });

  picker.setStartDate(new Date());
  picker.setEndDate((new Date()).setDate((new Date()).getDate() - 7));

  const autoCompleteJS = new autoComplete({
  data: {
    src: async () => {
      try {
        document
          .getElementById("autoComplete")
          .setAttribute("placeholder", "Loading...");
        // Fetch External Data Source
        const source = await fetch(
          "/campaigns/list"
        );
        const data = await source.json();
        // Post Loading placeholder text
        document
          .getElementById("autoComplete")
          .setAttribute("placeholder", autoCompleteJS.placeHolder);
        // Returns Fetched data
        return data;
      } catch (error) {
        return error;
      }
    },
    keys: ["mid", "name"],
    cache: true,
    filter: (list) => {
      // Filter duplicates
      // incase of multiple data keys usage
      const filteredResults = Array.from(
        new Set(list.map((value) => value.match))
      ).map((name) => {
        return list.find((value) => value.match === name);
      });

      return filteredResults;
    }
  },
  placeHolder: "shopee",
  resultsList: {
    noResults: true,
    maxResults: 15,
    tabSelect: true
  },
  resultItem: {
    highlight: true
  },
  events: {
    input: {
      focus: () => {
        if (autoCompleteJS.input.value.length) autoCompleteJS.start();
      }
    }
  }
});

autoCompleteJS.input.addEventListener("selection", function (event) {
  const feedback = event.detail;
  autoCompleteJS.input.blur();
  // Prepare User's Selected Value
  const selection = feedback.selection.value[feedback.selection.key];
  // Replace Input value with the selected value
  autoCompleteJS.input.value = selection;
});

</script>
@endsection
