<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Statistics extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $bg,
        public string $color,
        public string $icon,
        public string $idValue,
        public string $idChange,
        public string $title,
        public string $changeType,
        public string $arrowIcon
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statistics');
    }
}
