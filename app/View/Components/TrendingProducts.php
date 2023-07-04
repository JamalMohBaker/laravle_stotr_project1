<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrendingProducts extends Component
{
    public $products;
    /**
     * Create a new component instance.
     */
    public $title;

    public function __construct($title ="Teding" , $count = 4)
    {
        $this->title = $title;
        $this->products = Product::withoutGlobalScope('owner') // ignore global scope
                    ->with('category') // name of relationship **for performance** لتقليل عملية الاستعلام
                    -> active()
                    ->latest('updated_at')
                    ->take($count) // = limit(5) just number of products
                    ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trending-products');
    }
}
