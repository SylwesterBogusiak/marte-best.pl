<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'image_path',
        'name',
        'description',
        'amount',
        'price',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orders(): BelongsToMany
    {

        return $this->belongsToMAny(Order::class);
    }

    public function isSelectedCategory(int $category_id): bool
{
    return $this->hasCategory() && ($this->category->id == $category_id);
}

public function hasCategory(): bool
{
    return !is_null($this->category);
}

}
