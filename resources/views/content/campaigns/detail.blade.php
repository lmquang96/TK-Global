@extends('layouts/contentNavbarLayout')

@section('title', 'Chiến dịch')
@section('page-title')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mb-0">
    <li class="breadcrumb-item">
      <a href="javascript:void(0);">Chiến dịch</a>
    </li>
    <li class="breadcrumb-item active">
      HDBank
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
  <div class="col-9">
    <div class="card" id="create-link">
      <div class="card-body">
        <h6>Tạo link chiến dịch</h6>
        <div class="row mb-4">
          <div class="col-9">
            <label class="form-label">Link sản phẩm</label>
            <input type="text" class="form-control" placeholder="" value="https://shopee.vn/" />
          </div>
          <div class="col-3">
            <label class="form-label">Tên miền</label>
            <select class="form-select" name="domains">
              <option value="1" selected>abc.com</option>
              <option value="2">xyz.com</option>
            </select>
          </div>
        </div>
        <div>
          <a class="me-1" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="toggleIcon()">
            Thông tin thêm
            <i class='bx bx-chevron-down more-info-icon'></i>
          </a>
          <div class="collapse mt-4" id="collapseExample">
            <div class="row">
              <div class="col-6 mb-4">
                <label class="form-label">Nguồn chiến dịch</label>
                <input type="text" class="form-control" placeholder="VD: google, facebook..."/>
              </div>
              <div class="col-6 mb-4">
                <label class="form-label">Cách tiếp thị</label>
                <input type="text" class="form-control" placeholder="VD: cpc, ads, banner,..."/>
              </div>
              <div class="col-6">
                <label class="form-label">Tên chiến dịch</label>
                <input type="text" class="form-control" placeholder="VD: the-tin-dung, vay-sinh-vien,..."/>
              </div>
              <div class="col-6">
                <label class="form-label">Nội dung chiến dịch</label>
                <input type="text" class="form-control" placeholder="VD: ngay-10-10, giam-lai-suat,..."/>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary mt-4" onclick="generateLink()">
          <span class="tf-icons bx bx-link bx-18px me-2"></span>Tạo Link
        </button>
        <div class="row mt-4 visually-hidden" id="link-generate-area">
          <div class="col">
            <div class="p-3 rounded" style="border: 2px solid #696cff; background-color: #e7e7ff;">
              <h6 class="text-blue">Tạo link thành công</h6>
              <label class="form-label text-blue">Link sản phẩm</label>
              <div class="input-group">
                <input type="text" class="form-control bg-white" id="root-link" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="https://abc.com/abcxyz">
                <button class="btn btn-primary" type="button" onclick="handleCopy()">
                  <i class='bx bx-copy me-2'></i> Copy
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-6" id="history-link">
      <div class="card-body">
        <h6>Lịch sử tạo link</h6>
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
              <tr>
                <td>
                  31-12-2024 14:57:30
                </td>
                <td>
                  <div class="input-group">
                    <input type="text" class="form-control bg-white" id="root-link" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="https://abc.com/abcxyz">
                    <button class="btn btn-primary" style="--bs-btn-padding-x: 0.75rem;" type="button" onclick="handleCopy()">
                      <i class='bx bx-copy'></i>
                    </button>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="text" class="form-control bg-white" id="root-link" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="https://shopee.vn/">
                    <button class="btn btn-primary" style="--bs-btn-padding-x: 0.75rem;" type="button" onclick="handleCopy()">
                      <i class='bx bx-copy'></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card mt-6" id="info">
      <div class="card-body">
        <h6>Thông tin chiến dịch</h6>
        <div>
          ah hihi đồ ngốc
        </div>
      </div>
    </div>
  </div>
  <div class="col-3">
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
        <hr />
        <div class="camps-detail-anchor">
          <div class="d-flex">
            <a href="#create-link">
              <i class="bx bx-link mb-2"></i>
              <span style="margin-left: 0.5rem">Tạo link</span>
            </a>
          </div>
          <div class="d-flex">
            <a href="#history-link">
              <i class="bx bx-history mb-2"></i>
              <span style="margin-left: 0.5rem">Lịch sử tạo link</span>
            </a>
          </div>
          <div class="d-flex">
            <a href="#info">
              <i class="bx bx-info-square mb-2"></i>
              <span style="margin-left: 0.5rem">Thông tin chiến dịch</span>
            </a>
          </div>
          <div class="d-flex">
            <a href="#">
              <i class="bx bx-line-chart mb-2"></i>
              <span style="margin-left: 0.5rem">Báo cáo đơn hàng</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Toast with Placements -->
<div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-medium">Thông báo</div>
    <small>Vừa xong</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Sao chép link phân phối thành công
  </div>
</div>
<!-- Toast with Placements -->
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
@section('page-script')
@vite(['resources/assets/js/ui-toasts.js'])
<script>
  let rotate = 0;
  function toggleIcon() {
    rotate += 180;
    $(".more-info-icon").css({
      transform: `rotate(${rotate}deg)`
    });
  }

  function generateLink() {
    $("#link-generate-area").removeClass("visually-hidden");
  }

  function handleCopy() {
    const toastPlacementExample = document.querySelector('.toast-placement-ex');
    selectedType = 'bg-primary';
    selectedPlacement = ['top-0', 'start-0'];

    toastPlacementExample.classList.add(selectedType);
    DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);
    toastPlacement = new bootstrap.Toast(toastPlacementExample);
    toastPlacement.show();
  }
</script>
@endsection
