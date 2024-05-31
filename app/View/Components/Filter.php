<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    public $typeDocument;
    public $search;
    public $order;


    public function __construct(
        $typeDocument = "daftar-penduduk",
        $search = "",
        $order = "asc"
    ) {
        $this->typeDocument = $typeDocument;
        $this->search = $search;
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter');
    }
}
