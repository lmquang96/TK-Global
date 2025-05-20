<div class="card h-100">
  <div class="card-body">
    <div class="card-title d-flex align-items-start justify-content-between mb-4">
      <div class="avatar flex-shrink-0">
        <div class="d-flex h-100 rounded align-items-center justify-content-center"
          style="background-color: {{ $bg }}">
          <i class="bx {{ $icon }}" style="color: {{ $color }}"></i>
        </div>
      </div>
      {{-- <div class="dropdown">
        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          <i class="bx bx-dots-vertical-rounded text-muted"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
          <a class="dropdown-item" href="javascript:void(0);">View More</a>
          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
        </div>
      </div> --}}
    </div>
    <p class="mb-1">{{ $title }}</p>
    <h4 class="card-title mb-3" id="{{ $idValue }}">0₫</h4>
    <small class="text-{{ $changeType }} fw-medium">
      <i class="bx bx-{{ $arrowIcon }}"></i> <span id="{{ $idChange }}" class="{{ $idValue == 'total-balance-value' ? 'd-none' : '' }}">+0%</span></small>
  </div>
</div>
