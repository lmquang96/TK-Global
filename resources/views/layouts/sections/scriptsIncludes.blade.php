@php
  use Illuminate\Support\Facades\Vite;
@endphp
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<!-- laravel style -->
@vite(['resources/assets/vendor/js/helpers.js'])

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
@vite(['resources/assets/js/config.js'])

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
  function animateNumber(element, targetValue, after = '') {
    const duration = 1000; // 1 giây
    const $number = $(element);

    $({
      value: 0
    }).animate({
      value: targetValue
    }, {
      duration: duration,
      easing: "linear", // Dạng tiến trình của animation (có thể thay đổi)
      step: function(now) {
        // Cập nhật giá trị trong mỗi bước của animation
        $number.text(Math.floor(now).toLocaleString("vi-VN") + after); // Làm tròn số
      }
    });
  }
</script>
