<?php

namespace App\View\Components;

use App\Settings\GeneralSettings;
use Illuminate\View\Component;

class BfBaseLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public GeneralSettings $settings)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bf-base-layout');
    }
}
