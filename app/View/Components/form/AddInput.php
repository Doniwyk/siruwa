<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $placeholder;
    public $name;
    public $label;
    
    public function __construct($placeholder, $name, $label)
    {
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.add-input');
    }
}
