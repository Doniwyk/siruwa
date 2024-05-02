<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $placeholder;
    public $type;
    public $name;
    public $id;
    public $value;
    
    public function __construct($label, $placeholder, $type, $name, $id, $value = null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.input');
    }
}
