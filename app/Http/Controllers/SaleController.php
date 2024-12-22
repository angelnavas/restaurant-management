<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_date' => 'required|date',
            'lines' => 'required|array',
            'lines.*.recipe_id' => 'required|exists:recipes,id',
            'lines.*.quantity' => 'required|integer|min:1',
            'lines.*.override_price' => 'nullable|numeric|min:0',
        ]);

        $sale = Sale::create([
            'sale_date' => $validated['sale_date'],
            'number' => uniqid(), // Simple unique number generation
        ]);

        foreach ($validated['lines'] as $line) {
            $sale->saleLines()->create([
                'recipe_id' => $line['recipe_id'],
                'quantity' => $line['quantity'],
                'override_price' => $line['override_price'] ?? null,
            ]);
        }

        return response()->json(['data' => $sale->load('saleLines')], 201);
    }

    public function analytics()
    {
        return response()->json($this->saleService->getSalesAnalytics());
    }
}