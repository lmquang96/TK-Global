@extends('layouts/contentNavbarLayout')

@section('title', 'Chiến dịch')
@section('page-title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Chiến dịch</a>
            </li>
            <li class="breadcrumb-item active text-truncate">
                {{ $campaign->name }}
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
        <div class="col-lg-9">
            <div class="card" id="create-link">
                <div class="card-body">
                    @if ($campaign->link_generate_type == 0)
                        <h6>Tạo link chiến dịch</h6>
                        <div class="row mb-4">
                            <div class="col-12 col-md-9">
                                <label class="form-label">Link sản phẩm</label>
                                <input type="text" class="form-control" placeholder="" value="{{ $campaign->url }}"
                                    id="original-link" />
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Tên miền</label>
                                <select class="form-select" id="domain" name="domain">
                                    <option value="track.tkglobal.asia">track.tkglobal.asia</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <a class="me-1" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample" onclick="toggleIcon()">
                                Thông tin thêm
                                <i class='bx bx-chevron-down more-info-icon'></i>
                            </a>
                            <div class="collapse mt-4" id="collapseExample">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-4">
                                        <label class="form-label">Nguồn chiến dịch</label>
                                        <input type="text" class="form-control" placeholder="VD: google, facebook..."
                                            id="sub1" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <label class="form-label">Cách tiếp thị</label>
                                        <input type="text" class="form-control"
                                            placeholder="VD: cpc, ads, banner,..."id="sub2" />
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Tên chiến dịch</label>
                                        <input type="text" class="form-control"
                                            placeholder="VD: the-tin-dung, vay-sinh-vien,..." id="sub3" />
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Nội dung chiến dịch</label>
                                        <input type="text" class="form-control"
                                            placeholder="VD: ngay-10-10, giam-lai-suat,..." id="sub4" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="generate-link" class="btn btn-primary mt-4" onclick="generateLink()">
                            <span class="tf-icons bx bx-link bx-18px me-2"></span>Tạo Link
                        </button>
                        <div class="row mt-4 visually-hidden" id="link-generate-area">
                            <div class="col">
                                <div class="p-3 rounded" style="border: 2px solid #696cff; background-color: #e7e7ff;">
                                    <h6 class="text-blue">Tạo link thành công</h6>
                                    <label class="form-label text-blue">Link sản phẩm</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-white" id="link-tracking"
                                            placeholder="" aria-label="Link Tracking" aria-describedby="button-addon1"
                                            value="" readonly>
                                        <button class="btn btn-primary" type="button"
                                            onclick="handleCopy('#link-tracking')">
                                            <i class='bx bx-copy me-2'></i> Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <h6>Tạo link chiến dịch</h6>
                        <div class="col text-danger">
                            Đây là chiến dịch tạo link thủ công, nên bạn hãy liên hệ với chúng tôi để được cung cấp link
                            tracking!
                        </div>
                    @endif
                </div>
            </div>
            <div class="card mt-6" id="history-link">
                <div class="card-body">
                    @if ($campaign->link_generate_type == 0)
                        <h6>Lịch sử tạo link <a href="{{ route('links-history', ['c' => $campaign->code]) }}">(Xem thêm)</a>
                        </h6>
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
                                                <div class="input-group" style="min-width: 200px;">
                                                    <input type="text" class="form-control bg-white"
                                                        id="link-history-tracking-input-{{ $linkHistory->id }}"
                                                        placeholder="" aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1"
                                                        value="https://{{ $linkHistory->domain }}/t/{{ $linkHistory->code }}">
                                                    <button class="btn btn-primary" style="--bs-btn-padding-x: 0.75rem;"
                                                        type="button"
                                                        onclick="handleCopy('#link-history-tracking-input-{{ $linkHistory->id }}')">
                                                        <i class='bx bx-copy'></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="min-width: 200px;">
                                                    <input type="text" class="form-control bg-white"
                                                        id="link-history-root-input-{{ $linkHistory->id }}" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1"
                                                        value="{{ $linkHistory->originial_url }}">
                                                    <button class="btn btn-primary" style="--bs-btn-padding-x: 0.75rem;"
                                                        type="button"
                                                        onclick="handleCopy('#link-history-root-input-{{ $linkHistory->id }}')">
                                                        <i class='bx bx-copy'></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h6>Lịch sử tạo link</a></h6>
                        <div class="col text-danger">
                            Đây là chiến dịch tạo link thủ công, nên rất tiếc chúng tôi sẽ không lưu lại lịch sử!
                        </div>
                    @endif
                </div>
            </div>
            <div class="card mt-6" id="info">
                <div class="card-body">
                    <h6>Thông tin chiến dịch</h6>
                    <div>
                        {!! $campaign->detail !!}
                    </div>
                    @if (!empty($campaign->allowed_rule))
                        @php
                            $traffics = json_decode($campaign->allowed_rule, true) ?? [];
                        @endphp
                        <h6>Traffic được chấp thuận</h6>
                        <div class="row mb-4">
                            @foreach ($traffics as $traffic)
                                <div class="col-6">
                                    <div class="d-flex mb-2">
                                        ✅ {{ $traffic }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($campaign->not_allowed_rule)
                        @php
                            $traffics = json_decode($campaign->not_allowed_rule, true) ?? [];
                        @endphp
                        <h6>Traffic không được chấp thuận</h6>
                        <div class="row mb-4">
                            @foreach ($traffics as $traffic)
                                <div class="col-6">
                                    <div class="d-flex mb-2">
                                        ❌ {{ $traffic }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($campaign->display_geo)
                        <h6>Quốc gia</h6>
                        @php
                            $geos = explode(',', $campaign->display_geo);
                        @endphp
                        <div>
                            <ul>
                                @foreach ($geos as $geo)
                                    <li>
                                        {{ $geo }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($campaign->cp_type && $campaign->commission_structure)
                        <h6>Dịch vụ</h6>
                        <div>
                            <ul>
                                <li>
                                    {{ $campaign->cp_type }}
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if ($campaign->device)
                        @php
                            $devices = json_decode($campaign->device, true);
                        @endphp
                        <h6>Thiết bị được áp dụng</h6>
                        <div class="row mb-4">
                            @foreach ($devices as $device)
                                <div>
                                    <ul>
                                        <li>
                                            {{ $device }}
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($campaign->os)
                        <h6>Hệ điều hành</h6>
                        <div>
                            <ul>
                                <li>
                                    {{ $campaign->os }}
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if ($campaign->conversion_flow)
                        <h6>Cách ghi nhận đơn hàng</h6>
                        <div>
                            {!! $campaign->conversion_flow !!}
                        </div>
                    @endif
                    @if ($campaign->commission_structure)
                        <h6>Bảng hoa hồng</h6>
                        <div>
                            {!! $campaign->commission_structure !!}
                        </div>
                    @endif
                    @if ($campaign->terms)
                        <h6>Các lưu ý đặc biệt</h6>
                        <div>
                            {!! $campaign->terms !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-6 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm-center">
                        <img src="{{ $campaign->image }}" height="48" />
                    </div>
                    <div class="row mt-4">
                        <div class="col-xs-12 col-sm-6 col-lg-12">
                            <h5 class="card-title mt-2">{{ $campaign->name }}</h5>
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
                        </div>
                        <hr class="d-block d-sm-none d-lg-block" />
                        <div class="camps-detail-anchor col-xs-12 col-sm-6 col-lg-12">
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
    </div>
    <!-- Toast with Placements -->
    <x-toast type="info" message="Sao chép link phân phối thành công" />
    <!-- Toast with Placements -->
    <!--/ Text alignment -->

    <!--/ Card layout -->
@endsection
@section('page-script')
    <script>
        let rotate = 0;

        function toggleIcon() {
            rotate += 180;
            $(".more-info-icon").css({
                transform: `rotate(${rotate}deg)`
            });
        }

        function generateLink() {
            $("#generate-link").html('Đang xử lý');
            $("#generate-link").prop("disabled", true);
            let originalLink = $('#original-link').val();
            let domain = $('#domain').val();
            let campaign = '{{ $campaign->code }}';
            let campaignId = '{{ $campaign->id }}';
            let sub1 = $('#sub1').val();
            let sub2 = $('#sub2').val();
            let sub3 = $('#sub3').val();
            let sub4 = $('#sub4').val();

            $.ajax({
                type: "post",
                url: "{{ route('links-store-history') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    originalLink: originalLink,
                    domain: domain,
                    campaignId: campaignId,
                    sub1: sub1,
                    sub2: sub2,
                    sub3: sub3,
                    sub4: sub4
                },
                success: function(response) {
                    let linkTracking = `https://${domain}/t/${response.data}`;
                    $("#generate-link").prop("disabled", true);
                    $("#link-tracking").val(linkTracking);
                    $("#link-generate-area").removeClass("visually-hidden");
                    $("#generate-link").html('Tạo Link');
                    $("#generate-link").prop("disabled", false);
                }
            });
        }

        function handleCopy(target) {
            let copyText = $(target);
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);
            document.execCommand('copy');
            toastShow();
        }
    </script>
@endsection
