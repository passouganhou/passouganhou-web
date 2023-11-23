<?php

namespace App\View\Components\Forms\Inputs;

use Illuminate\View\Component;

class FloatingLabelSelect extends Component
{
    public $name;
    public $label;
    public $options;
    public $placeholder;
    public $wireModel;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $options, $placeholder, $wireModel = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->wireModel = $wireModel ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.inputs.floating-label-select');
    }
}
