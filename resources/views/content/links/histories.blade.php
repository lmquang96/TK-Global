@extends('layouts/contentNavbarLayout')

@section('title', 'Lịch sử tạo link')
@section('page-title')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mb-0">
    <li class="breadcrumb-item">
      <a href="javascript:void(0);">Chiến dịch</a>
    </li>
    <li class="breadcrumb-item active">
      Lịch sử tạo link
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
        <form action="{{ route('links-history') }}" method="GET">
          <div class="row">
            <div class="col-4 mb-4">
              <label class="form-label">Khoảng ngày</label>
              <x-date-range-input name="date" date="{{ request('date') }}" />
            </div>
            <div class="col-4 mb-4">
              <label class="form-label">Chiến dịch</label>
              <input type="text" class="form-control" placeholder="Shopee" id="autoComplete" name="keyword" value="{{ request('keyword') }}" />
            </div>
            <div class="col-4 mb-4">
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
<div class="card">
  <h5 class="card-header">Dữ liệu</h5>
  @if ($linkHistories->isEmpty())
  <x-empty-data />
  @else
    {{-- <div class="card-body">
      <div class="row">
        <div class="col-6 col-lg-3 d-flex align-items-center">
          <div class="me-2" style="white-space: nowrap;">Hiển thị</div>
          <select class="form-select me-2">
            <option value="25">25 </option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <div style="white-space: nowrap;">Kết quả</div>
        </div>
      </div>
    </div> --}}
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Thời gian tạo</th>
          <th>Link affiliate</th>
          <th>Link gốc</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($linkHistories as $linkHistory)
        <tr>
          <td>
            {{ $linkHistory->created_at }}
          </td>
          <td>
            <div class="input-group">
              <input type="text" class="form-control bg-white" id="link-history-tracking-input-{{ $linkHistory->id }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="https://{{ $linkHistory->domain }}/t/{{ $linkHistory->code }}">
              <button class="btn btn-primary" style="--bs-btn-padding-x: 0.75rem;" type="button" onclick="handleCopy('#link-history-tracking-input-{{ $linkHistory->id }}')">
                <i class='bx bx-copy'></i>
              </button>
            </div>
          </td>
          <td>
            <div class="input-group">
              <input type="text" class="form-control bg-white" id="link-history-root-input-{{ $linkHistory->id }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{ $linkHistory->originial_url }}">
              <button class="btn btn-primary" style="--bs-btn-padding-x: 0.75rem;" type="button" onclick="handleCopy('#link-history-root-input-{{ $linkHistory->id }}')">
                <i class='bx bx-copy'></i>
              </button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-body">
    <x-paginate :paginator="$linkHistories" />
  </div>
  @endif
</div>
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
@vite('resources/assets/js/autocomplete.js')
@endsection