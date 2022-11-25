<?php

namespace App\View\Components\Products;

use App\Models\Product;
use Illuminate\View\Component;

class Products extends Component
{
    public $products;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->products = Product::get("product");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.products.products');
    }
}
