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
        $topProductsDatasets = json_encode( $this->get_top_product_chart_data() );

        return view('index', compact(
            'topProductsDatasets'
        ));
    }

    public function top_products_sales($year)
    {
        $data = $this->get_top_product_chart_data($year);

        return response()->json($data);
    }

    private function get_top_product_chart_data($year = null)
    {
        $year = $year ? $year : Carbon::now()->year;
        $topProductsDatasets = [];

        $products = StockMovement::groupBy('product_id')
        ->where('amount', '<', 0)->orderBy('total_amount', 'ASC')->limit(10)
        ->select('product_id', DB::raw('SUM(amount) as total_amount'))->get()->pluck('product_id')->toArray();

        foreach ($products as $product_id) {

            $product = Product::find($product_id);
            $date = Carbon::createFromFormat('Y', $year)->startOfYear();

            $topProductsDatasets[$product_id] = [
                'label'       => $product->name,
                'fill'        => false,
                'borderColor' => 'rgb(' . fake()->rgbColor() . ')',
                'tension'     => 0.1,
                'data'        => []
            ];

            while ($date->year == Carbon::now()->year) {

                if (!isset( $topProductsDatasets[$product_id]['data'][$date->month] )) {

                    $topProductsDatasets[$product_id]['data'][$date->month] = 0;

                    $stock_movements = StockMovement::groupBy('product_id')
                    ->where('product_id', '=', $product_id)->where('amount', '<', 0)
                    ->where('date', '>=', $date->startOfMonth()->toDateTimeString())->where('date', '<=', $date->endOfMonth()->toDateTimeString())
                    ->select('product_id', DB::raw('SUM(amount) as total_amount'))->get()->toArray();

                    if ( $stock_movements ) {
                        $topProductsDatasets[$product_id]['data'][$date->month] = - $stock_movements[0]['total_amount'];
                    }
                }

                $date->addDays(10);
            }

            $topProductsDatasets[$product_id]['data'] = array_values( $topProductsDatasets[$product_id]['data'] );

        }

        $topProductsDatasets = array_values($topProductsDatasets);



        return $topProductsDatasets;
    }
}
