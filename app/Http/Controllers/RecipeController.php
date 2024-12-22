<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Services\RecipeService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index()
    {
        return response()->json(['data' => Recipe::with('ingredients')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'selling_price' => 'required|numeric|min:0',
            'ingredients' => 'required|array',
            'ingredients.*.product_id' => 'required|exists:products,id',
            'ingredients.*.quantity' => 'required|numeric|min:0',
        ]);

        $recipe = Recipe::create([
            'name' => $validated['name'],
            'selling_price' => $validated['selling_price'],
        ]);

        foreach ($validated['ingredients'] as $ingredient) {
            $recipe->ingredients()->attach($ingredient['product_id'], [
                'quantity' => $ingredient['quantity']
            ]);
        }

        return response()->json(['data' => $recipe->load('ingredients')], 201);
    }

    public function analytics()
    {
        return response()->json($this->recipeService->getRecipeAnalytics());
    }
}