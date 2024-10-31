<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\HomeSlider;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PublikController extends Controller
{
    //Fungsi untuk halaman home
    public function home()
    {
        return view('pages.public.home', [
            'judul' => 'Home',
            'cHS' => HomeSlider::where('visib_home_sliders', 'Showing')->count(),
            'HomeSlider' => HomeSlider::where('visib_home_sliders', 'Showing')->latest()->get(),
            'cP' => Product::where('stock_products', '>', 0)->count(),
            'Product' => Product::where('stock_products', '>', 0)->latest()->limit(4)->get(),
            'cC' => Comment::where('visib_comments', 'Showing')->count(),
            'Comment' => Comment::where('visib_comments', 'Showing')->latest()->limit(3)->get(),
            'cB' => Blog::where('visib_blog', 'Showing')->count(),
            'Blog' => Blog::where('visib_blog', 'Showing')->latest()->limit(2)->get(),
        ]);
    }

    //Fungsi untuk halaman about
    public function about()
    {
        return view('pages.public.about', [
            'judul' => 'About Us',

        ]);
    }

    //Fungsi untuk halaman collection
    public function collection()
    {
        return view('pages.public.collection', [
            'judul' => 'Our Collections',
            'cP' => Product::where('stock_products', '>', 0)->count(),
            'Product' => Product::where('stock_products', '>', 0)->latest()->get(),
        ]);
    }

    //Fungsi untuk halaman blog
    public function blog()
    {
        return view('pages.public.blog', [
            'judul' => 'Blog',
            'cB' => Blog::where('visib_blog', 'Showing')->count(),
            'Blog' => Blog::where('visib_blog', 'Showing')->latest()->get(),
        ]);
    }

    public function buy(string $id)
    {
        $productData = Product::where('code_products', $id)->firstOrFail();

        $data = [
            'judul' => 'Order Form',
            'DetailProduct' => $productData,
        ];
        return view('pages.public.collection_buy', $data);
    }

    public function cstore(Request $request): RedirectResponse
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
            'Notes'     => 'max:25',
        ]);

        $ordernum = strtoupper(Str::random(19));

        // Get product from database
        $product = Product::where('code_products', $request->Product)->first();

        // Check if stock is sufficient
        if ($product->stock_products < $request->Quantity) {
            return redirect()->route('collection.publik')->withErrors(['error' => 'Stock is not sufficient.']);
        }

        // Reduce stock based on ordered quantity
        $product->stock_products -= $request->Quantity;
        $product->save();

        // Create order
        Order::create([
            'id_orders'         => 'Order'.Str::random(33),
            'order_number'      => $ordernum,
            'name_orders'       => $request->Name,
            'email_orders'      => $request->Email,
            'phone_orders'      => $request->Phone,
            'product_orders'    => $request->Product,
            'qty_orders'        => $request->Quantity,
            'total_orders'      => $request->Total,
            'payment_method'    => $request->Method,
            'status_orders'     => 'Pending',
            'payment_status'    => 'Pending',
            'shipping_address'  => $request->Address,
            'notes'             => $request->Notes,
            'created_by'        => $request->Email.' (Customer)',
            'modified_by'       => $request->Email.' (Customer)',
        ]);

        // Redirect to index with success message
        return redirect()->route('collection.publik')->with(['success' => 'Thanks for your order!', 'id' => $ordernum]);
    }


    public function checkOrder(string $id)
    {
        $order = Order::where('order_number', $id)->firstOrFail();
        $productData = Product::where('code_products', $order->product_orders)->firstOrFail();

        $data = [
            'judul' => 'Order Status',
            'DetailProduct' => $productData,
            'DetailOrder' => $order,
        ];
        return view('pages.public.checkorder', $data);
    }

    public function checkReceipt(string $id)
    {
        $payment = Order::where('order_number', $id)->firstOrFail();
        $productData = Product::where('code_products', $payment->product_orders)->firstOrFail();

        $data = [
            'judul' => 'Payment Status',
            'DetailProduct' => $productData,
            'DetailPayment' => $payment,
        ];
        return view('pages.public.checkpayment', $data);
    }

    public function editReceipt(string $id)
    {
        $order = Order::where('order_number', $id)->firstOrFail();
        if ($order->payment_status != 'Paid') {
            $productData = Product::where('code_products', $order->product_orders)->firstOrFail();
            $data = [
                'judul' => 'Order Status',
                'DetailProduct' => $productData,
                'DetailOrder' => $order,
            ];
            return view('pages.public.editreceipt', $data);
        }else{
            return redirect()->route('check.receipt', $id);
        }
    }

    public function updateReceipt(Request $request, string $id): RedirectResponse
    {
        $order = Order::where('order_number', $id)->firstOrFail();
        if ($order->payment_status != 'Paid') {
            $request->validate([
                'Email'     => 'required|email|max:255',
                'ImageP'    => 'required|mimes:jpeg,jpg,png,pdf|max:3072',
            ]);
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
            }
            $order->update([
                'proof_of_payment'  => $imagePName,
                'modified_by'      => $request->Email.' (Customer Upload)',
            ]);
            return redirect()->route('collection.publik')->with(['success' => 'Thanks for uploading your receipt!','id' => $id]);
        }else{
            return redirect()->route('check.receipt', $id);
        }
    }
}
