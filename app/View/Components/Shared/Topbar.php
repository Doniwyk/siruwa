<?php

namespace App\View\Components\Shared;

use App\Models\AccountModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Topbar extends Component
{
    /**
     * Create a new component instance.
     */
    public $account;

    public function __construct()
    {
        $id = Auth::id();
        $this->account = AccountModel::find($id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $account = $this->account;
        return view('components.shared.topbar', compact('account'));
    }
}
