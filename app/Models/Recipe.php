<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'selling_price',
    ];

    protected $casts = [
        'selling_price' => 'decimal:2',
    ];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'recipe_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function subRecipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_sub_recipes', 'recipe_id', 'sub_recipe_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function sales(): HasMany
    {
        return $this->hasMany(SaleLine::class);
    }

    public function getCost(): float
    {
        $ingredientsCost = $this->ingredients->sum(function ($ingredient) {
            return $ingredient->cost * $ingredient->pivot->quantity;
        });

        $subRecipesCost = $this->subRecipes->sum(function ($recipe) {
            return $recipe->getCost() * $recipe->pivot->quantity;
        });

        return $ingredientsCost + $subRecipesCost;
    }

    public function getProfitMargin(): float
    {
        $cost = $this->getCost();
        if ($cost == 0 || $this->selling_price == 0) {
            return 0;
        }
        return (($this->selling_price - $cost) / $this->selling_price) * 100;
    }
}
?>