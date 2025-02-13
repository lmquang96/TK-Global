<div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true"
  data-bs-delay="5000">
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-medium">Thông báo</div>
    <small>Vừa xong</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{ $message ?? '' }}
  </div>
</div>

<script>
  function toastShow() {
    const toastPlacementExample = document.querySelector('.toast-placement-ex');
    let selectedType = 'bg-primary';
    let inputType = '{{ $type ?? null }}';
    if (inputType == 'error') {
      selectedType = 'bg-danger';
    }
    let selectedPlacement = ['top-0', 'start-0'];

    toastPlacementExample.classList.add(selectedType);
    DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);
    let toastPlacement = new bootstrap.Toast(toastPlacementExample);
    toastPlacement.show();
  }
</script>
