<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HighlightCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $newsData;

    public function __construct($newsData)
    {
        $this->newsData = $newsData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.highlight-card');
    }
}
