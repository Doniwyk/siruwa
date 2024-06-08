<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDescriptionForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $document;
    public $idx;
    public string $formId;
    public string $statusValue;

    public function __construct($document, string $formId,string $statusValue, int $idx)
    {
        $this->document = $document;
        $this->idx = $idx;
        $this->formId = $formId;
        $this->statusValue = $statusValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.action-description-form');
    }
}
