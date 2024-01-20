<?php

namespace App\Livewire\StoreManagementSystem;

use App\Helpers\Helper;
use App\Livewire\Alert\Notification;
use App\Models\Inventory\Product\Product;
use App\Models\StoreManagementSystem\ProductCart;
use App\Models\User;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class Products extends Component
{
    // public $products = [];
    public $id;
    public $products;
    public $addToCartCountProducts;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        User::findOrFail($this->id);

        $this->products = self::classHasProducts($this->id);

        $this->addToCartCountProducts = Helper::addToCartCountProducts($this->id);

        return view('livewire.store-management-system.products');
    }

    public function classHasProducts($user_id)
    {
        $user_query = User::leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->where('users.id', $user_id)
            ->where('sa.admission_status', true)
            ->select('sa.current_class_id');

        if (!$user_query->count() >= 1) {
            return redirect(route('store-management-system.seller'));
        }

        return Product::leftJoin('product_categories as pc', 'products.product_product_category_id', 'pc.product_category_id')
            ->leftJoin('class_has_products as chp', 'products.product_id', 'chp.class_has_product_product_id')
            ->where('pc.product_category_name', 'store_management_system')
            ->where('chp.class_has_product_class_id', function ($query) use ($user_id) {
                $query->select('current_class_id')
                    ->from('student_admissions  as sa')
                    ->where('sa.user_id', $user_id);
            })
            ->select('products.*', 'chp.*')
            ->get();
    }

    public function addToCart($user_id, $product_id)
    {
        $product_check = ProductCart::where('product_cart_buyer_id', $user_id)->where('product_cart_product_id', $product_id)->first();
        $product_quantity = (!empty($product_check->product_cart_quantity)) ? $product_check->product_cart_quantity : null;
        $product_quantity = $product_quantity + 1;

        if ($product_quantity == 1) {
            ProductCart::create([
                'product_cart_buyer_id' => $user_id,
                'product_cart_product_id' => $product_id,
                'product_cart_quantity' => $product_quantity
            ]);
            Notification::alert($this, 'success', 'Success!', 'Successfully added!');
            return;
        }

        self::addToCartIncrease($user_id, $product_id);
    }

    public function addToCartIncrease($user_id, $product)
    {
        $product_check = ProductCart::where('product_cart_buyer_id', $user_id)->where('product_cart_product_id', $product)->first();
        $product_quantity = (!empty($product_check->product_cart_quantity)) ? $product_check->product_cart_quantity : null;

        if (!$product_quantity >= 1) {
            return false;
        }

        if ($product_quantity >= 1) {
            ProductCart::where('product_cart_buyer_id', $user_id)
                ->where('product_cart_product_id', $product)
                ->update(['product_cart_quantity' => ($product_quantity + 1)]);
            Notification::alert($this, 'success', 'Success!', 'Successfully increased!');
        }
    }
}
