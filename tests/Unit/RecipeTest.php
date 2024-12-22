<?php 
 
namespace Tests\Unit; 
 
use Tests\TestCase; 
use App\Models\Recipe; 
use App\Models\Product; 
use Illuminate\Foundation\Testing\RefreshDatabase; 
 
class RecipeTest extends TestCase 
{ 
    use RefreshDatabase; 
 
    public function test_can_calculate_recipe_cost() 
    { 
        $recipe = Recipe::factory()->create(['selling_price' => 10.00]); 
        $ingredient = Product::factory()->create(['cost' => 2.00]); 
 
        $recipe->ingredients()->attach($ingredient, ['quantity' => 2]); 
 
        $this->assertEquals(4.00, $recipe->getCost()); 
    } 
} 
