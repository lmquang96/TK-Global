<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class WeatherCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $city,
        public string $temperature,
        public string $condition,
        public string $icon
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.weather-card');
    }
}
