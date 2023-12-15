<?php

namespace App\Livewire\StoreManagementSystem;

use App\Helpers\Helper;
use App\Models\Inventory\Product\Product;
use App\Models\StoreManagementSystem\ProductCart;
use App\Models\User;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class Products extends Component
{
    // public $products = [];
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $user = User::findOrFail($this->id); // here the problem
        $id = $user->id;

        return view('livewire.store-management-system.products', [
            'products' => Helper::classHasProducts($this->id),
            'addToCartCountProducts' => Helper::addToCartCountProducts($id)
        ]);
    }

    public function addToCart($user, $product)
    {
        return Helper::addToCart($user, $product);
    }
}
