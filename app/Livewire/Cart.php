<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        return view('livewire.cart');
    }

    public function addToCart($id)
    {
        $product = \App\Models\Inventory\Product\ClassHasProduct::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()
            ->back()
            ->with('success', 'Product added to cart successfully!');
    }

    public function updateToCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
