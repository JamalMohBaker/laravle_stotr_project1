<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Shoplayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;

    public $showBreadcrumb;
    public function __construct($title , $showBreadcrumb)
    {
        $this->title=$title;
        $this->showBreadcrumb = $showBreadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.shop',[
            // 'title' => $this->title, does not imprtant for passing manually
        ]);
    }
}
