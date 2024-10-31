<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Orders',
            'DataO' => DB::table('orders')
                ->join('products', 'orders.product_orders', '=', 'products.code_products')
                ->select(
                    'orders.*',
                    'products.code_products',
                    'products.name_products',
                )
                ->latest('orders.created_at')
                ->get(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.order', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'New Order',
            'ListP' => Product::latest()->get(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.order_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Name'      => 'required|max:45',
            'Email'     => 'required|email|max:255',
            'Phone'     => 'required|numeric|max_digits:20',
            'Address'   => 'required',
            'Product'   => 'required|exists:products,code_products',
            'Quantity'  => 'required|integer|min:0',
            'Total'     => 'required|numeric|min:0',
            'Method'    => 'max:255',
            'ImageP'    => 'mimes:jpeg,jpg,png,pdf|max:3072',
            'Tracking'  => 'max:255',
            'Notes'     => 'max:25',
        ]);

        // Upload images
        if ($request->hasFile('ImageP')) {
            $imageP = $request->file('ImageP');
            $imagePName = time().'Receipt'.Str::random(17) . '.' . $imageP->getClientOriginalExtension();
            $imageP->move('assets1/img/Payment', $imagePName);
        } else {
            $imagePName = NULL;
        }

        // Get product from database
        $product = Product::where('code_products', $request->Product)->first();

        // Check if stock is sufficient
        if ($product->stock_products < $request->Quantity) {
            return redirect()->route('order.add')->withErrors(['error' => 'Stock is not sufficient.']);
        }

        // Reduce stock based on ordered quantity
        $product->stock_products -= $request->Quantity;
        $product->save();

        // Create order
        Order::create([
            'id_orders'         => 'Order'.Str::random(33),
            'order_number'      => strtoupper(Str::random(19)),
            'name_orders'       => $request->Name,
            'email_orders'      => $request->Email,
            'phone_orders'      => $request->Phone,
            'product_orders'    => $request->Product,
            'qty_orders'        => $request->Quantity,
            'total_orders'      => $request->Total,
            'payment_method'    => $request->Method,
            'status_orders'     => $request->OrderStatus,
            'payment_status'    => $request->PaymentStatus,
            'proof_of_payment'  => $imagePName,
            'shipping_address'  => $request->Address,
            'tracking_number'   => $request->Tracking,
            'notes'             => $request->Notes,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email,
        ]);

        // Redirect to index with success message
        return redirect()->route('order.add')->with(['success' => 'Order has been Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        $product = Product::where('code_products', $order->product_orders)->first();
        $data = [
            'judul' => 'Order Details',
            'DetailOrder' => $order,
            'DetailProduk' => $product,
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.order_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        $product = Product::where('code_products', $order->product_orders)->first();
        $data = [
            'judul' => 'Edit Order',
            'EditOrder' => $order,
            'DetailProduk' => $product,
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.order_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'Name'      => 'required|max:45',
            'Email'     => 'required|email|max:255',
            'Phone'     => 'required|numeric|max_digits:20',
            'Address'   => 'required',
            'Method'    => 'max:255',
            'ImageP'    => 'mimes:jpeg,jpg,png,pdf|max:3072',
            'Tracking'  => 'max:255',
            'Notes'     => 'max:25',
        ]);

        $order = Order::findOrFail($id);

        if ($request->hasFile('ImageP')) {
            if (!is_null($order->proof_of_payment)) {
                $imagePPath = 'assets1/img/Payment/' . $order->proof_of_payment;
                if (file_exists($imagePPath)) {
                    unlink($imagePPath);
                }
            }
            $imageP = $request->file('ImageP');
            $imagePName = time().'Receipt'.Str::random(17) . '.' . $imageP->getClientOriginalExtension();
            $imageP->move('assets1/img/Payment', $imagePName);
        } else {
            $imagePName = $order->proof_of_payment;
        }

        $order->update([
            'name_orders'       => $request->Name,
            'email_orders'      => $request->Email,
            'phone_orders'      => $request->Phone,
            'payment_method'    => $request->Method,
            'status_orders'     => $request->OrderStatus,
            'payment_status'    => $request->PaymentStatus,
            'proof_of_payment'  => $imagePName,
            'shipping_address'  => $request->Address,
            'tracking_number'   => $request->Tracking,
            'notes'             => $request->Notes,
            'modified_by'      => Auth::user()->email,
        ]);

        return redirect()->route('order.data')->with(['success' => 'Order has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::where('order_number', $id)->firstOrFail();
        if (!is_null($order->proof_of_payment)) {
            $imagePPath = 'assets1/img/Payment/' . $order->proof_of_payment;
            if (file_exists($imagePPath)) {
                unlink($imagePPath);
            }
        }
        $order->delete();

        //redirect to index
        return redirect()->route('order.data')->with(['success' => 'Order has been Deleted!']);
    }
}
