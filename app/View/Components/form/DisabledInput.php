<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DisabledInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $prevName;
    public $reqName;
    public $prevValue;
    public $reqValue;
    

    public function __construct(
        $label,
        $prevName,
        $reqName,
        $prevValue,
        $reqValue
    )
    {
        $this->label = $label;
        $this->prevName = $prevName;
        $this->reqName = $reqName;
        $this->prevValue = $prevValue;
        $this->reqValue = $reqValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.disabled-input');
    }
}
