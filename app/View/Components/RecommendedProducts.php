<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class RecommendedProducts extends Component
{
    public $products;
    public $title = ''; // ۱. مقدار اولیه دادن به title

    public function __construct($limit = 4)
    {
        $visitedCategories = json_decode(Cookie::get('visited_categories', '[]'), true);

        if (!empty($visitedCategories)) {
            $this->products = Product::whereIn('category_id', $visitedCategories)
                                    ->inRandomOrder()
                                    ->take($limit)
                                    ->get();

            if ($this->products->isNotEmpty()) {
                $this->title = "Keep Shopping";
            }
        }


        if (empty($this->products) || $this->products->isEmpty()) {
            $this->title = "Last most viewed products";

            $this->products = Product::orderBy('views_count', 'desc')
                                    ->take($limit)
                                    ->get();
        }
    }

    public function render(): View|Closure|string
    {
        // ۲. پاس دادن صریح متغیرها به Blade
        return view('components.index.recommended-products', [
            'title' => $this->title,
            'products' => $this->products,
        ]);
    }
}
