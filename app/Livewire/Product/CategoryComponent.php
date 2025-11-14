<?php

namespace App\Livewire\Product;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{

    private string $slug = '';

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $category = Category::query()->where('slug', '=', $this->slug)->firstOrFail();
        $ids      = \App\Helpers\Category\Category::getIds($category->id) . $category->id;

        return view('livewire.product.category-component');
    }
}
