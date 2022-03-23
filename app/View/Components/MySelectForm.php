<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MySelectForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $showLabel;
    public $label;
    public $value;
    public $options;
    public function __construct($name, $showLabel, $label, $value, $options)
    {
        $this->name = $name;
        $this->showLabel = $showLabel;
        $this->label = $label;
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.my-select-form');
    }
}
