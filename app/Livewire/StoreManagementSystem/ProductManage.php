<?php

namespace App\Livewire\StoreManagementSystem;

use App\Livewire\Alert\Notification;
use App\Models\Inventory\Product\Product;
use App\Models\Inventory\Product\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManage extends Component
{
    use WithPagination;

    public $search;
    public $categories;

    public $product_name;
    public $product_description;
    public $product_category_id;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->categories = ProductCategory::all();
        return view('livewire.store-management-system.product-manage', [
            'products' => Product::leftJoin('product_categories as pc', 'products.product_product_category_id', 'pc.product_category_id')
                ->where('product_name', 'LIKE', "%{$this->search}%")
                ->paginate(5)
        ]);
    }

    public function store()
    {
        $this->validate([
            'product_name' => 'required',
            'product_description' => 'nullable',
            'product_category_id' => 'required'
        ]);

        Product::create([
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_product_category_id' => $this->product_category_id,
            'product_created_by' => auth()->user()->id,
            'product_updated_by' => auth()->user()->id
        ]);

        Notification::alert($this, 'success', 'Success!', 'Created!');

        $this->product_name = null;
        $this->product_description = null;
        $this->product_category_id = null;

        $this->dispatch('closeModelCreate');
    }

    public function update($id)
    {
        $this->validate([
            'product_name' => 'required',
            'product_description' => 'nullable'
        ]);

        Product::findOrFail($id);

        // Product::create([
        //     'product_name' => $this->product_name,
        //     'product_description' => $this->product_description,
        //     'product_created_by' => auth()->user()->id,
        //     'product_updated_by' => auth()->user()->id
        // ]);

        Notification::alert($this, 'success', 'Success!', 'Updated!');
    }
}
