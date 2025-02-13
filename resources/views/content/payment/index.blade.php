@extends('layouts/contentNavbarLayout')

@section('title', 'Thanh toán')
@section('page-title')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mb-0">
      <li class="breadcrumb-item active">
        <a href="javascript:void(0);">Thanh toán</a>
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
    <div class="col-8">
      <div class="card mb-4">
        <div class="card-body">
          <div>
            <p class="mb-0">Bạn có thể đăng ký rút tiền trong khoảng 15 - 17 và 27 - 29 hàng tháng và đảm bảo số dư lớn
              hơn 200.000₫. Chúng tôi sẽ làm việc trong 1 ngày sau đó, số dư sẽ được chuyển khoản đến tài khoản ngân hàng
              của bạn.<br /> Nếu sau 1 ngày làm việc kế tiếp mà bạn vẫn chưa nhận được tiền, vui lòng liên ngay hệ với
              chúng tôi
              để được giải quyết.</p>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body invoice-preview-header">
          <h5>Thông tin thanh toán</h5>
          <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-6 mb-sm-0 mb-6">
              <div class="p-4 rounded" style="background-color: #22303e0f;">
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Chủ tài khoản:</td>
                      <td>{{ auth()->user()->profile->bank_owner }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Số tài khoản:</td>
                      <td>{{ auth()->user()->profile->bank_number }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Ngân hàng:</td>
                      <td>{{ auth()->user()->profile->bank_name }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Chi Nhánh:</td>
                      <td>{{ auth()->user()->profile->bank_branch }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Số CMT/CCCD:</td>
                      <td>{{ auth()->user()->profile->citizen_id_no }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Ngày cấp:</td>
                      <td>{{ \Carbon\Carbon::parse(auth()->user()->profile->citizen_id_date)->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Nơi cấp:</td>
                      <td>{{ auth()->user()->profile->citizen_id_place }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4" style="color: #a7acb2;">Mã số thuế:</td>
                      <td>{{ auth()->user()->profile->tax }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5 class="card-header">Lịch sử rút tiền</h5>
          <x-empty-data />
          {{-- <div class="table-responsive text-nowrap">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Thời gian đăng ký</th>
                  <th>Thời gian thanh toán</th>
                  <th>Trạng thái</th>
                  <th>Số tiền</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @for ($i = 0; $i < 5; $i++)
                  <tr>
                    <td>
                      2025-01-10 15:44:21
                    </td>
                    <td>
                      2025-01-10 15:44:21
                    </td>
                    <td><span class="badge bg-label-success me-1">Thành công</span></td>
                    <td>
                      45.000.000₫
                    </td>
                  </tr>
                @endfor
              </tbody>
            </table>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="credit-card p-4 rounded text-white">
            <div class="d-flex align-items-center">
              <img src="/assets/img/icons/payment/Mastercard-Logo.png" alt="" style="width: 32px;">
              <div style="margin-left: 0.5rem;">Master Card</div>
            </div>
            <div class="mt-4">
              Current Balance
            </div>
            <div class="fw-bold" style="font-size: 1.75rem;">
              0₫
            </div>
            <div class="d-flex mt-4 justify-content-between">
              <div>xxxx xxxx xxxx xxxx</div>
              <div>xx/xx</div>
            </div>
          </div>
          <div class="d-grid mt-5">
            <button class="btn btn-primary" id="btn-modal" {{ $flag ? '' : 'disabled' }}>
              <span class="me-2">
                Đăng ký rút tiền
              </span>
              <i class="bx bx-right-arrow-alt scaleX-n1-rtl"></i>
            </button>
          </div>
          <p class="mt-8">
            Trước khi đăng ký rút tiền bạn cần chắc chắn đã chấp nhận <a href="#">Điều khoản dịch vụ</a> và <a
              href="#">Chính sách bảo mật</a> của chúng tôi. Xin lưu ý rằng các khoản thanh toán không được hoàn
            lại.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-6">
            <h4 class="mb-2">Đăng ký rút tiền</h4>
            <p>Nhập số tiền bạn cần rút ≥ 200.000₫ và ≤ số dư bạn đang có</p>
          </div>
          <form id="addNewCCForm" class="row g-6 fv-plugins-bootstrap5 fv-plugins-framework"
            onsubmit="handleSubmission(event)">
            <div class="col-12 fv-plugins-icon-container">
              <label class="form-label w-100" for="modalAddCard">Số tiền (₫)</label>
              <div class="input-group input-group-merge has-validation">
                <input id="amount" name="amount" class="form-control credit-card-mask" type="text"
                  placeholder="Nhập số tiền bạn muốn rút" aria-describedby="amount">
              </div>
            </div>
            <small class="d-block text-danger mt-1" id="amount-error"></small>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-3">Xác nhận</button>
              <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                aria-label="Close">Hủy</button>
            </div>
            <input type="hidden">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Text alignment -->
  <!-- Toast with Placements -->
  <x-toast type="info" message="Đăng ký rút tiền thành công!" />
  <!-- Toast with Placements -->

  <!--/ Card layout -->
@endsection
@section('page-script')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    $("#dropdownMenuButton").click(function() {
      new bootstrap.Dropdown(document.querySelector('.dropdown-toggle')).toggle();
    });
    const myModal = new bootstrap.Modal(document.getElementById('paymentModal'));

    $("#btn-modal").click(function(e) {
      e.preventDefault();
      myModal.toggle();
    });

    function handleSubmission(e) {
      e.preventDefault();

      let amount = $("#amount").val();

      if (amount.length == 0) {
        $("#amount-error").html('Số tiền không được để trống!');
        return false;
      }

      if (/^[0-9]+$/.test(amount) == false) {
        $("#amount-error").html('Số tiền không đúng định dạng!');
        return false;
      }

      if (parseInt(amount) < 200000) {
        $("#amount-error").html('Số tiền phải lớn hơn 200.000₫!');
        return false;
      }

      if (parseInt(amount) % 10000 !== 0) {
        $("#amount-error").html('Số tiền phải là bội số của 10.000₫!');
        return false;
      }

      $.ajax({
        type: "POST",
        url: "/payment/submission",
        data: {
          _token: "{{ csrf_token() }}",
          amount: $("#amount").val()
        },
        success: function(response, status, xhr) {
          if (xhr.status == 200) {
            myModal.toggle();
            toastShow();
          }
        },
        error: function(xhr) {
          console.log(xhr.status, xhr.responseJSON.message);
          $(".bs-toast .toast-body").html(xhr.responseJSON.message);
          myModal.toggle();
          toastShow();
          $(".bs-toast").removeClass("bg-primary");
          $(".bs-toast").addClass("bg-danger");
        }
      });
    }
  </script>
@endsection
