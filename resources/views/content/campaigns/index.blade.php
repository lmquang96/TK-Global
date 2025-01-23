@extends('layouts/contentNavbarLayout')

@section('title', 'Chiến dịch')
@section('page-title')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mb-0">
    <li class="breadcrumb-item active">
      <a href="javascript:void(0);">Chiến dịch</a>
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
        <form action="{{ route('campaigns') }}" method="GET">
          <div class="row">
            <div class="col-3">
              <label class="form-label">Từ khóa</label>
              <input type="text" class="form-control" placeholder="Shopee" id="autoComplete" name="keyword" value="{{ request('keyword') }}"/>
            </div>
            <div class="col-3">
              <label class="form-label">Danh mục</label>
              <select class="form-select" name="category">
                <option value="">Tất cả</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-3">
              <label class="form-label">Hình thức</label>
              <select class="form-select" name="cp_type">
                <option value="">Tất cả</option>
                <option value="CPS" {{ request('cp_type') == 'CPS' ? 'selected' : '' }}>CPS</option>
                <option value="CPQL" {{ request('cp_type') == 'CPQL' ? 'selected' : '' }}>CPQL</option>
              </select>
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
<div class="row mb-12 g-6">
  @foreach ($campaigns as $campaign)
  <div class="col-md-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <img src="{{ $campaign->image }}" height="48" />
        </div>
        <h5 class="card-title mt-2 text-truncate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" data-bs-original-title="<span>{{ $campaign->name }}</span>">{{ $campaign->name }}</h5> 
        <div class="d-flex">
          <i class="bx bxs-dollar-circle mb-2"></i>
          <span style="margin-left: 0.5rem">{{ $campaign->commission_text }}</span>
        </div>
        <div class="d-flex">
          <i class="bx bx-shape-circle mb-2"></i>
          <span style="margin-left: 0.5rem">{{ $campaign->category->name }}</span>
        </div>
        <div class="d-flex">
          <i class="bx bx-git-branch mb-2"></i>
          <span style="margin-left: 0.5rem">{{ $campaign->cp_type }}</span>
        </div>
        <a href="{{ route('campaigns-detail', ["id" => $campaign->code]) }}" class="btn btn-primary">Chi tiết</a>
      </div>
    </div>
  </div>
  @endforeach
</div>

@if ($campaigns->isEmpty())
<x-empty-data />
@endif
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
@vite('resources/assets/js/autocomplete.js')
@endsection