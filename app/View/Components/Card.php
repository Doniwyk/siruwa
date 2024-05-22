<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $type;
    public $label;
    public $value;
    public $data;
    /**
     * Create a new component instance.
     */
    public function __construct( $label, $value, $data = null,$type = null)
    {
        $this->type = $type;
        $this->label = $label;
        $this->data = $data;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
