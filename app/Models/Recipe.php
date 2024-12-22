<?php 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 
 
class Recipe extends Model 
{ 
    protected $fillable = [ 
        'name', 
        'selling_price', 
    ]; 
 
    protected $casts = [ 
        'selling_price' => 'decimal:2', 
    ]; 
} 
