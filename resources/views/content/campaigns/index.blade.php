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
@endsection

@section('content')

<!-- Text alignment -->
<div class="row mb-6">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <label class="form-label">Từ khóa</label>
            <input type="text" class="form-control" placeholder="Shopee" />
          </div>
          <div class="col-3">
            <label class="form-label">Danh mục</label>
            <select class="form-select" name="categories">
              <option value="all" selected>Tất cả</option>
              <option value="1">Tài chính</option>
            </select>
          </div>
          <div class="col-3">
            <label class="form-label">Hình thức</label>
            <select class="form-select" name="categories">
              <option value="all" selected>Tất cả</option>
              <option value="1">CPS</option>
              <option value="1">CPQL</option>
            </select>
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
<div class="row mb-12 g-6">
  @for ($i = 0; $i < 12; $i++)
  <div class="col-md-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <img src="https://storage.googleapis.com/hyperlead-public/production/assets/offers/logo/Logo-HDBank.png" height="48" />
        </div>
        <h5 class="card-title mt-2">HDBank</h5> 
        <div class="d-flex">
          <i class="bx bxs-dollar-circle mb-2"></i>
          <span style="margin-left: 0.5rem">Lên đến 270.000₫</span>
        </div>
        <div class="d-flex">
          <i class="bx bx-shape-circle mb-2"></i>
          <span style="margin-left: 0.5rem">Tài chính/Ngân hàng</span>
        </div>
        <div class="d-flex">
          <i class="bx bx-git-branch mb-2"></i>
          <span style="margin-left: 0.5rem">CPS</span>
        </div>
        <a href="{{ route('campaigns-detail', ["id" => 123]) }}" class="btn btn-primary">Chi tiết</a>
      </div>
    </div>
  </div>
  @endfor
</div>
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
