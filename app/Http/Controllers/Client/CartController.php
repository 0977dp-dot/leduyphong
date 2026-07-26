<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('client.cart.index', compact('cart'));
    }

    // Thêm vào giỏ hàng
    public function add(Request $request, $id = null)
    {
        $id = $id ?? $request->input('product_id');

        $product = Product::select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image'
        )->findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'productid'   => $product->id,
                'productname' => $product->productname,
                'slug'        => $product->slug,
                'image'       => $product->image,
                'price'       => $product->pricediscount ?: $product->price,
                'quantity'    => 1,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm sản phẩm vào giỏ hàng.',
            'cartCount' => collect($cart)->sum('quantity'),
        ]);
    }

    // Cập nhật số lượng
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->has('quantity')) {
            foreach ($request->quantity as $productId => $qty) {
                if (isset($cart[$productId])) {
                    $qty = max(1, (int) $qty);
                    $cart[$productId]['quantity'] = $qty;
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    // Xóa sản phẩm
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        if (empty($cart)) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    // Trang thanh toán
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('client.cart.checkout', compact('cart', 'total'));
    }

    // Lưu đơn hàng
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:255',
            'phone'    => 'required|max:20',
            'address'  => 'required|max:500',
            'email'    => 'nullable|email|max:255',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        DB::beginTransaction();

        try {
            // Tìm hoặc tạo khách hàng theo số điện thoại
            $customer = Customer::where('phone', $request->phone)->first();
            if (!$customer) {
                $customer = Customer::create([
                    'fullname' => $request->fullname,
                    'phone'    => $request->phone,
                    'address'  => $request->address,
                ]);
            }

            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'customer_id' => $customer->id,
                'total'       => $total,
                'status'      => 'Pending',
            ]);

            $items = [];
            foreach ($cart as $item) {
                $items[] = [
                    'order_id'   => $order->id,
                    'product_id' => $item['productid'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            OrderItem::insert($items);

            DB::commit();

            session()->forget('cart');

            return redirect()->route('cart.index')
                ->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}