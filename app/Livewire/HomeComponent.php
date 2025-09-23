<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $hits_products = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_hit', '=', '1')
            ->limit(8)
            ->get();

        $new_products = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_new', '=', '1')
            ->limit(8)
            ->get();

        return view('livewire.home-component', [
            'hits_products' => $hits_products,
            'new_products'  => $new_products,
        ]);
    }
}
