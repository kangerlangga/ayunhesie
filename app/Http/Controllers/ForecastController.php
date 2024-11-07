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
            'Alpha' => 'required|numeric|min:0|max:1',
            'ForecastPeriod' => 'required|integer|min:1'
        ]);

        $startDate = Carbon::parse($request->DateStart);
        $alpha = $request->Alpha;
        $forecastPeriod = 1 + $request->ForecastPeriod;

        $products = Stock::where('date_stocks', '<', $startDate)
                        ->select('product_stocks')
                        ->distinct()
                        ->get();

        $forecastData = [];
        $chartData = [];

        foreach ($products as $product) {
            $productCode = $product->product_stocks;
            $productName = Product::where('code_products', $productCode)->first()->name_products ?? 'Unknown Product';

            $lastStockBeforeStart = Stock::where('product_stocks', $productCode)
                                        ->where('date_stocks', '<', $startDate)
                                        ->orderBy('date_stocks', 'desc')
                                        ->first();

            if (!$lastStockBeforeStart) {
                continue;
            }

            $productForecastData = [];
            $labels = [];
            $forecastValues = [];
            $actualValues = [];
            $calculationDetails = [];

            $previousForecast = $lastStockBeforeStart->monthly_stocks;
            $previousStock = $previousForecast;
            $nextDate = $startDate->copy();

            for ($i = 0; $i < $forecastPeriod; $i++) {
                $actualStock = Stock::where('product_stocks', $productCode)
                                    ->whereYear('date_stocks', $nextDate->year)
                                    ->whereMonth('date_stocks', $nextDate->month)
                                    ->first();

                if ($i == 0 && $actualStock) {
                    $currentForecast = $actualStock->monthly_stocks;
                } else {
                    $currentForecast = round(($alpha * $previousStock) + ((1 - $alpha) * $previousForecast));
                }

                $currentForecastR = ($alpha * $previousStock) + ((1 - $alpha) * $previousForecast);

                if ($i == 0) {
                    $calculationDetails[] = "Forecast = Actual ({$nextDate->format('M Y')} = {$currentForecast})";
                } else {
                    $previousMonth = $nextDate->copy()->subMonth()->format('M Y');
                    $calculationDetails[] = "{$alpha} * {$previousStock} ({$previousMonth}) + (1 - {$alpha}) * {$previousForecast} = {$currentForecastR}";
                }

                $labels[] = $nextDate->format('M Y');
                $forecastValues[] = $currentForecast;
                $actualValues[] = $actualStock ? $actualStock->monthly_stocks : 0;

                $productForecastData[] = [
                    'date' => $nextDate->format('M Y'),
                    'forecast' => $currentForecast,
                    'actual' => $actualStock ? $actualStock->monthly_stocks : 0,
                    'calculationDetail' => $calculationDetails[$i]
                ];

                $previousForecast = $currentForecast;
                $previousStock = $actualStock ? $actualStock->monthly_stocks : $previousForecast;
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
