<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InvLogTable extends Component
{
    public $invlog;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($invlog)
    {
        $this->invlog = $invlog;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inv-log-table');
    }
}
