<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index(): View
    {
        $data = [
            'judul' => 'Forecasting',
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.forecast', $data);
    }

    public function calculateForecast(Request $request)
    {
        $request->validate([
            'DateStart' => 'required|date',
            'DateFinish' => 'required|date|after_or_equal:DateStart',
            'Alpha' => 'required|numeric|min:0|max:1',
            'ForecastPeriod' => 'required|integer|min:1|max:12'
        ]);

        $startDate = Carbon::parse($request->DateStart);
        $endDate = Carbon::parse($request->DateFinish);
        $alpha = $request->Alpha;
        $forecastPeriod = $request->ForecastPeriod;

        $products = Stock::whereBetween('date_stocks', [$startDate, $endDate])
                        ->select('product_stocks')
                        ->distinct()
                        ->get();

        $forecastData = [];
        $chartData = [];

        foreach ($products as $product) {
            $productCode = $product->product_stocks;

            $productName = Product::where('code_products', $productCode)->first()->name_products ?? 'Unknown Product';

            $stocks = Stock::where('product_stocks', $productCode)
                        ->whereBetween('date_stocks', [$startDate, $endDate])
                        ->orderBy('date_stocks', 'asc')
                        ->get();

            if ($stocks->isEmpty()) {
                continue;
            }

            $productForecastData = [];
            $previousForecast = $stocks->first()->monthly_stocks;

            $nextDate = $endDate->copy()->addMonth();
            $labels = [];
            $forecastValues = [];
            $actualValues = [];

            for ($i = 0; $i < $forecastPeriod; $i++) {
                $currentForecast = round(($alpha * $stocks->last()->monthly_stocks) + ((1 - $alpha) * $previousForecast));

                $actualStock = Stock::where('product_stocks', $productCode)
                                    ->whereYear('date_stocks', $nextDate->year)
                                    ->whereMonth('date_stocks', $nextDate->month)
                                    ->first();

                $labels[] = $nextDate->format('M Y');
                $forecastValues[] = $currentForecast;
                $actualValues[] = $actualStock ? $actualStock->monthly_stocks : 0;

                $productForecastData[] = [
                    'date' => $nextDate->format('M Y'),
                    'forecast' => $currentForecast,
                    'actual' => $actualStock ? $actualStock->monthly_stocks : 0
                ];

                $previousForecast = $currentForecast;
                $nextDate = $nextDate->addMonth();
            }

            $forecastData[$productCode] = [
                'productName' => $productName,
                'forecastData' => $productForecastData
            ];

            $chartData[$productCode] = [
                'labels' => $labels,
                'forecast' => $forecastValues,
                'actual' => $actualValues,
            ];
        }

        $data = [
            'judul' => 'Forecasting Results',
            'forecastData' => $forecastData,
            'chartData' => $chartData,
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];

        return view('pages.admin.forecast_result', $data);
    }
}
