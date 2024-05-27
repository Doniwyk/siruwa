<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInputForm extends Component
{
    public $label;
    public $name;
    public $type;
    public $value;      

    public function __construct($label, $name, $type = 'text', $value = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }
    

    public function render(): View|Closure|string
    {
        return view('components.form.text-input-form');
    }
}
