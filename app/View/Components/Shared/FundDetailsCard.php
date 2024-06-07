<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FundDetailsCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $moneyTotalKematian;
    public $moneyTotalSampah;

    public function __construct($moneyTotalKematian, $moneyTotalSampah)
    {
        $this->moneyTotalKematian = $moneyTotalKematian;
        $this->moneyTotalSampah = $moneyTotalSampah;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.fund-details-card');
    }
}
