<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreate;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        $countries = Countries::getNames();
        if ($cart->get()->isEmpty()) {
            return redirect()->route('home')->with(['info' => 'Cart is empty']);
        }

        return view('front.checkout', ['cart' => $cart, 'countries' => $countries]);
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            //'addr.billing.first_name'=>['required','string','max:255']
            //'addr.billing.*' => ['required']
        ]);

        $items = $cart->get()->groupBy('products.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);
                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->products->name,
                        'price' => $item->products->price,
                        'quantity' => $item->quantity,
                    ]);
                }
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }
            DB::commit();
            //event('order.created', $order, Auth::id());
            event(new OrderCreate($order));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
       // return redirect()->route('home')->with(['success' => 'Order completed']);
    }

}
