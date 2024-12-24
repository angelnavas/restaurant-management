<?php
namespace App\Services;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;

class RecipeService
{
    public function getRecipeAnalytics(): array
    {
        $recipes = Recipe::all();
        
        $highestCost = $recipes->sortByDesc(fn($recipe) => $recipe->getCost())->first();
        $lowestCost = $recipes->sortBy(fn($recipe) => $recipe->getCost())->first();
        $highestMargin = $recipes->sortByDesc(fn($recipe) => $recipe->getProfitMargin())->first();
        $lowestMargin = $recipes->sortBy(fn($recipe) => $recipe->getProfitMargin())->first();

        return [
            'highest_cost' => [
                'recipe' => $highestCost->name,
                'cost' => $highestCost->getCost()
            ],
            'lowest_cost' => [
                'recipe' => $lowestCost->name,
                'cost' => $lowestCost->getCost()
            ],
            'highest_margin' => [
                'recipe' => $highestMargin->name,
                'margin' => $highestMargin->getProfitMargin()
            ],
            'lowest_margin' => [
                'recipe' => $lowestMargin->name,
                'margin' => $lowestMargin->getProfitMargin()
            ]
        ];
    }
}
?>