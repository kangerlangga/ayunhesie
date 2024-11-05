<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Stocks',
            'DataS' => Stock::with('product')->orderBy('date_stocks', 'asc')->get(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.stock', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'New Stock',
            'ListP' => Product::latest()->get(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.stock_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'MonthStock'    => 'required|string|max:255',
            'YearStock'     => 'required|integer',
            'Product'       => 'required|string',
            'Stock'         => 'required|integer|min:1',
            'DateStock'     => 'nullable|integer',
        ]);

        $dateStock = null;
        if ($request->DateStock) {
            $monthNumber = array_search($request->MonthStock, ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']) + 1; // Mendapatkan nomor bulan
            $dateStock = sprintf('%04d-%02d-%02d', $request->YearStock, $monthNumber, $request->DateStock); // Format YYYY-MM-DD
        }

        Stock::create([
            'id_stocks'         => 'Stock'.Str::random(33),
            'product_stocks'    => $request->Product,
            'date_stocks'       => $dateStock,
            'month_stocks'      => $request->MonthStock,
            'year_stocks'       => $request->YearStock,
            'monthly_stocks'    => $request->Stock,
            'type_stocks'       => $request->Type,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email
        ]);

        return redirect()->route('stock.add')->with(['success' => 'Stock has been added!']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $stock = Stock::findOrFail($id);
        $product = Product::where('code_products', $stock->product_stocks)->first();
        $data = [
            'judul' => 'Edit Stock',
            'EditStock' => $stock,
            'DetailProduk' => $product,
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.stock_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'Stock'         => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($id);

        $stock->update([
            'monthly_stocks'    => $request->Stock,
            'modified_by'       => Auth::user()->email,
        ]);

        return redirect()->route('stock.data')->with(['success' => 'Stock has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $stock = Stock::findOrFail($id);

        //delete
        $stock->delete();

        //redirect to index
        return redirect()->route('stock.data')->with(['success' => 'Stock has been Deleted!']);
    }
}
