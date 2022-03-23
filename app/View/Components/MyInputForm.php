<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyInputForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $name;
    public $showLabel;
    public $label;
    public $value;
    public $placeholder;
    public function __construct($type, $name, $showLabel, $label, $value, $placeholder)
    {
        $this->type = $type;
        $this->name = $name;
        $this->showLabel = $showLabel;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.my-input-form');
    }
}
