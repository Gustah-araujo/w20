<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardsController extends Controller
{
    public function index()
    {
        $sales_by_month = json_encode( $this->get_sales_by_month_data() );

        $top_products_data = json_encode($this->get_top_products_data());

        return view('index', compact(
            'sales_by_month',
            'top_products_data',
        ));
    }

    public function sales_by_month($year)
    {
        $data = $this->get_sales_by_month_data($year);

        return response()->json($data);
    }

    private function get_sales_by_month_data($year = null)
    {
        $year = $year ? $year : Carbon::now()->year;
        $sales_by_month = [];

        $products = StockMovement::groupBy('product_id')
        ->where('amount', '<', 0)->orderBy('total_amount', 'ASC')->limit(10)
        ->select('product_id', DB::raw('SUM(amount) as total_amount'))->get()->pluck('product_id')->toArray();

        foreach ($products as $product_id) {

            $product = Product::find($product_id);
            $date = Carbon::createFromFormat('Y', $year)->startOfYear();
            $color = 'rgb(' . fake()->rgbColor() . ')';

            $sales_by_month[$product_id] = [
                'label'            => $product->name,
                'fill'             => false,
                'borderColor'      => $color,
                'backgroundColor' => $color,
                'tension'          => 0.1,
                'data'             => [],
            ];

            while ($date->year == Carbon::now()->year) {

                if (!isset( $sales_by_month[$product_id]['data'][$date->month] )) {

                    $sales_by_month[$product_id]['data'][$date->month] = 0;

                    $stock_movements = StockMovement::groupBy('product_id')
                    ->where('product_id', '=', $product_id)->where('amount', '<', 0)
                    ->where('date', '>=', $date->startOfMonth()->toDateTimeString())->where('date', '<=', $date->endOfMonth()->toDateTimeString())
                    ->select('product_id', DB::raw('SUM(amount) as total_amount'))->get()->toArray();

                    if ( $stock_movements ) {
                        $sales_by_month[$product_id]['data'][$date->month] = - $stock_movements[0]['total_amount'];
                    }
                }

                $date->addDays(10);
            }

            $sales_by_month[$product_id]['data'] = array_values( $sales_by_month[$product_id]['data'] );

        }

        $sales_by_month = array_values($sales_by_month);



        return $sales_by_month;
    }

    private function get_top_products_data()
    {
        $datasets = [];
        $data = [];
        $colors = [];
        $labels  = [];

        $products = StockMovement::with('product')->groupBy('product_id')
        ->where('amount', '<', 0)->orderBy('total_amount', 'ASC')->limit(10)
        ->select('product_id', DB::raw('SUM(amount) as total_amount'))->get();

        foreach ($products as $product) {
            $data[] = - $product->total_amount;
            $labels[] = $product->product->name;
            $colors[] = 'rgb(' . fake()->rgbColor() . ')';
        }

        $datasets[] = [
            'data' => $data,
            'backgroundColor' => $colors,
            'borderWidth' => 1
        ];

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }
}
