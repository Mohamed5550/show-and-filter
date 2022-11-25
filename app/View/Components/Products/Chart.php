<?php

namespace App\View\Components\Products;

use App\Models\ProductSearch;
use Illuminate\View\Component;

class Chart extends Component
{
    public $productSearches;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $data = ProductSearch::where("created_at", '>=', now()->subdays(30))
            ->orderBy('created_at')
            ->groupByRaw('DAY(created_at)')
            ->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as date, count(*) as total")
            ->get();
        $this->productSearches = json_encode($data);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.products.chart');
    }
}
