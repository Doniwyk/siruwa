<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInputForm extends Component
{
    public $label;
    public $name;

    public function __construct($label, $name)
    {
        $this->label = $label;
        $this->name = $name;
    }

    public function render(): View|Closure|string
    {
        return view('components.form.select-input-form');
    }
}
