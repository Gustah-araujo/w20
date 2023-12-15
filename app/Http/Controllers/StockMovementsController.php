<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Rules\HasStock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StockMovementsController extends Controller
{
    public function index(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('stock_movements.index', compact(
            'product'
        ));
    }

    public function create(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('stock_movements.create', compact(
            'product'
        ));
    }

    public function store(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $request->validate([
            'amount' => [
                'required',
                'integer',
                'gt:0',
                new HasStock($id),
            ],
            'date' => [
                'required',
                'date',
            ],
            'type' => [
                'required',
                Rule::in(['in', 'out'])
            ]
        ]);

        $data = $request->all();
        $data['product_id'] = $id;

        // Se usuário registrou saída
        if ($request->type == 'out') {
            $data['amount'] = intval($data['amount']) * -1;
        }

        $new_stock = $product->stock + $data['amount'];

        $data['previous_stock'] = $product->stock;
        $data['new_stock'] = $new_stock;

        $stock_movement = StockMovement::create($data);

        $product->update([
            'stock' => $new_stock
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
