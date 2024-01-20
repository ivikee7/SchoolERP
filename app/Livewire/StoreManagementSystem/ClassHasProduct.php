<?php

namespace App\Livewire\StoreManagementSystem;

use App\Livewire\Alert\Notification;
use App\Models\AcademicSession;
use App\Models\Inventory\Product\ClassHasProduct as ProductClassHasProduct;
use App\Models\Inventory\Product\Product;
use App\Models\Inventory\Product\ProductCategory;
use App\Models\StudentClass;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ClassHasProduct extends Component
{
    use WithPagination;

    public $search;

    // form values
    public $class_id;
    public $product_id;
    public $academic_session_id;
    public $price;

    // requirement

    // data
    public $products;
    public $categories;
    public $classes;
    public $sessions;

    public $class_has_product_class_id;
    public $class_has_product_product_id;
    public $class_has_product_price;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->classes = StudentClass::all();
        $this->categories = ProductCategory::all();
        $this->products = Product::all();
        $this->sessions = AcademicSession::all();

        return view('livewire.store-management-system.class-has-product', [
            'class_has_products' => StudentClass::where('student_classes.name', 'LIKE', "%{$this->search}%")
                ->select('student_classes.id', 'student_classes.name as class_name')
                ->paginate(20)
        ]);
    }

    public function getProductsOfClass($class_id)
    {
        return ProductClassHasProduct::leftJoin('products as p', 'class_has_products.class_has_product_product_id', 'p.product_id')
            ->leftJoin('academic_sessions as ac', 'class_has_products.class_has_product_academic_session_id', 'ac.id')
            ->where('class_has_products.class_has_product_class_id', $class_id)
            ->where('ac.session_end', '>', now())
            ->get();
    }

    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'product_id' => 'required',
            'price' => 'required'
        ]);

        ProductClassHasProduct::create([
            'class_has_product_class_id' => $this->class_id,
            'class_has_product_product_id' => $this->product_id,
            'class_has_product_price' => $this->price,
            'class_has_product_created_by' => auth()->user()->id,
            'class_has_product_updated_by' => auth()->user()->id
        ]);

        $this->dispatch('closeModelCreate');

        Notification::alert($this, 'success', 'Success!', 'Created!');
    }

    public function assignProducts()
    {
        $variable = $this->validate([
            'class_id' => 'required',
            'product_id' => 'required',
            'price' => 'required'
        ]);

        if (!$variable) {
            Notification::alert($this, 'warning', 'Failed!', 'Session not found!');
            $this->dispatch('model_assign_show');
        }

        if (!AcademicSession::where('id', $this->academic_session_id)) {
            Notification::alert($this, 'warning', 'Failed!', 'Session not found!');
            $this->dispatch('model_assign_show');
        }

        if (!StudentClass::where('id', $this->class_id)) {
            Notification::alert($this, 'warning', 'Failed!', 'Class not found!');
            $this->dispatch('model_assign_show');
        }

        if (!Product::where('product_id', $this->product_id)) {
            Notification::alert($this, 'warning', 'Failed!', 'Product not found!');
            $this->dispatch('model_assign_show');
        }

        ProductClassHasProduct::create([
            'class_has_product_class_id' => $this->class_id,
            'class_has_product_academic_session_id' => $this->academic_session_id,
            'class_has_product_product_id' => $this->product_id,
            'class_has_product_price' => $this->price,
        ]);
        Notification::alert($this, 'success', 'Success!', 'Assigned!');
        $this->dispatch('model_assign_hide');
    }
}
