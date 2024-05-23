<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmationPaymentCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $fundData;
    public $formId;
    public function __construct($fundData, $formId )
    {
        $this->fundData = $fundData;
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.confirmation-payment-card');
    }
}
