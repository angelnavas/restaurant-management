<?php 
namespace App\Services; 
 
use App\Models\Recipe; 
 
class RecipeService 
{ 
    public function getRecipeAnalytics(): array 
    { 
        $recipes = Recipe::all(); 
 
        $highestCost = $recipes->sortByDesc(fn($recipe) => $recipe->getCost())->first(); 
        $lowestCost = $recipes->sortBy(fn($recipe) => $recipe->getCost())->first(); 
 
        return [ 
            'highest_cost' => [ 
                'recipe' => $highestCost->name, 
                'cost' => $highestCost->getCost() 
            ], 
            'lowest_cost' => [ 
                'recipe' => $lowestCost->name, 
                'cost' => $lowestCost->getCost() 
            ] 
        ]; 
    } 
} 
