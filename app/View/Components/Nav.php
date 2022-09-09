<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items;
    public $active;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->items = config('nav');
        $this->active = Route::currentRouteName();
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
