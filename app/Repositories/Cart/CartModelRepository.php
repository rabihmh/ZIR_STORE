<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(): Collection
    {
        // TODO: Implement get() method.
        if (!$this->items->count()) {
            $this->items = Cart::with('products')->get();
        }
        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {
        // TODO: Implement add() method.
        $item = Cart::where('product_id', $product->id)->first();

        if (!$item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            $this->get()->push($cart);
            return $cart;
        }
        return $item->increment('quantity', $quantity);

    }

    public function update($id, $quantity)
    {
        // TODO: Implement update() method.
        Cart::where('id', '=', $id)->update([
            'quantity' => $quantity
        ]);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        Cart::where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        // TODO: Implement empty() method.
        Cart::query()->delete();
    }

    public function total(): float
    {
        // TODO: Implement total() method.
//        return (float)Cart::join('products', 'products.id', '=', 'carts.product_id')
//            ->selectRaw('SUM(products.price * carts.quantity) as total')->value('total');
        return (float)$this->get()->sum(function ($item) {
            return $item->products->price * $item->quantity;
        });
    }


}
