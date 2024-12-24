<?php
namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function getSalesAnalytics(): array
    {
        $salesByDate = Sale::select('sale_date', DB::raw('SUM(sale_lines.quantity * COALESCE(sale_lines.override_price, recipes.selling_price)) as total_amount'))
            ->join('sale_lines', 'sales.id', '=', 'sale_lines.sale_id')
            ->join('recipes', 'sale_lines.recipe_id', '=', 'recipes.id')
            ->groupBy('sale_date')
            ->get();

        $highestSaleDay = $salesByDate->sortByDesc('total_amount')->first();
        $lowestSaleDay = $salesByDate->sortBy('total_amount')->first();

        return [
            'highest_sales_day' => [
                'date' => $highestSaleDay?->sale_date,
                'amount' => $highestSaleDay?->total_amount,
            ],
            'lowest_sales_day' => [
                'date' => $lowestSaleDay?->sale_date,
                'amount' => $lowestSaleDay?->total_amount,
            ]
        ];
    }
}
?>