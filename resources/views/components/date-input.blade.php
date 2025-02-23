<div class="input-group">
    <input type="text" class="form-control" name="{{ $name }}" id="datepicker">
    <span class="input-group-text" style="padding-left: calc(0.543rem - 2px); padding-right: calc(0.543rem - 2px);">
      <i class='bx bx-calendar'></i>
    </span>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/@easepick/datetime@1.2.1/dist/index.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@easepick/core@1.2.1/dist/index.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@easepick/base-plugin@1.2.1/dist/index.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@easepick/preset-plugin@1.2.1/dist/index.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@easepick/lock-plugin@1.2.1/dist/index.umd.min.js"></script>
  <script>
    const picker = new easepick.create({
      element: document.getElementById('datepicker'),
      css: [
        'https://cdn.jsdelivr.net/npm/@easepick/core@1.2.1/dist/index.css',
        'https://cdn.jsdelivr.net/npm/@easepick/preset-plugin@1.2.1/dist/index.css',
        'https://cdn.jsdelivr.net/npm/@easepick/lock-plugin@1.2.1/dist/index.css',
      ],
      zIndex: 999,
      lang: 'vi-VN',
      plugins: ['PresetPlugin'],
      PresetPlugin: {
        customLabels: [
          'Hôm nay',
          'Hôm qua',
          '7 ngày trước',
          '30 ngày trước',
          'Tháng này',
          'Tháng trước'
        ]
      },
    });

    let value = '{{ $value ?? null }}';
    if (value !== null) {
      picker.setDate(new Date(value));
    } else {
      picker.setDate(new Date());
    }
  </script>