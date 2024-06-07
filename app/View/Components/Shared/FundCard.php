<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FundCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $moneyTotal;
    public $paymentService;

    public function __construct($type, $moneyTotal)
    {
        $this->type = $type;
        $this->moneyTotal = $moneyTotal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.fund-card');
    }
}
