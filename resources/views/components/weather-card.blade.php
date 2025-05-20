<div class="card h-100">
  <div class="card-body text-center">
    <div class="weather-icon" style="height: 80px;">
      <img class="h-100" src="{{ $icon }}" />
    </div>
    <div class="weather-location mt-2">
      {{ $city }}
    </div>
    <div class="weather-temperature fw-bold fs-3">
      {{ $temperature }}°C
    </div>
    <div class="weather-condition">
      {{ $condition }}
    </div>
  </div>
</div>
