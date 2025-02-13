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
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/css/autoComplete.02.min.css">
@endsection

@section('content')

  <!-- Text alignment -->
  <div class="row mb-6">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('report-performance') }}" method="GET">
            <div class="row">
              <div class="col-3">
                <label class="form-label">Khoảng ngày</label>
                <x-date-range-input name="date" date="{{ request('date') }}" />
              </div>
              <div class="col-3">
                <label class="form-label">Chiến dịch</label>
                <input type="text" class="form-control" placeholder="Enter something" id="autoComplete" name="keyword"
                  value="{{ request('keyword') }}" />
              </div>
              <div class="col-3 mt-auto">
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
                <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
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
                <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded">
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
                <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="wallet info" class="rounded">
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
                <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded">
              </div>
            </div>
            <p class="mb-1">Hoa hồng phát sinh</p>
            <h4 class="card-title mb-3" id="total-com-value">0₫</h4>
          </div>
        </div>
      </div>
    </div>
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
      </div>
    </div> --}}
    @if (!$data->isEmpty())
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
            @foreach ($data as $row)
              @php
                $clickByCampaignId = isset($clicks[$row->campaign->id]) ? $clicks[$row->campaign->id]['cnt'] : 0;
              @endphp
              <tr>
                <td>
                  <a href="{{ route('campaigns-detail', ['id' => $row->campaign->code]) }}">{{ $row->campaign->name }}</a>
                </td>
                <td>
                  {{ number_format($clickByCampaignId, 0, ',', '.') }}
                </td>
                <td>
                  {{ number_format($row->cnt, 0, ',', '.') }}
                </td>
                <td>
                  {{ number_format($row->total_price, 0, ',', '.') }}
                </td>
                <td>
                  {{ number_format($row->total_com, 0, ',', '.') }}
                </td>
                <td>
                  {{ number_format($clickByCampaignId > 0 ? ($row->cnt / $clickByCampaignId) * 100 : 0, 1, ',', '.') }}%
                </td>
                <td>
                  <a href="{{ route('report-order', ['keyword' => $row->campaign->name, 'date' => request('date')]) }}">
                    <span class="badge bg-label-primary me-1">Chi tiết</span>
                  </a>
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
  <!--/ Text alignment -->

  <!--/ Card layout -->
@endsection
@section('page-script')
  <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
  <script>
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

    autoCompleteJS.input.addEventListener("selection", function(event) {
      const feedback = event.detail;
      autoCompleteJS.input.blur();
      // Prepare User's Selected Value
      const selection = feedback.selection.value[feedback.selection.key];
      // Replace Input value with the selected value
      autoCompleteJS.input.value = selection;
    });

    animateNumber('#total-click-value', {{ $clickCount }});
    animateNumber('#total-conversion-value', {{ $totalConversion }});
    animateNumber('#total-price-value', {{ $totalPrice }}, '₫');
    animateNumber('#total-com-value', {{ $totalCom }}, '₫');
  </script>
@endsection
