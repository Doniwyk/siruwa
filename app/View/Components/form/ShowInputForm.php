<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowInputForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $value;
    public $name;
    public function __construct($label, $value, $name)
    {
        $this->label = $label;
        $this->value = $value;
        $this->name = $name;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.show-input-form');
    }
}
