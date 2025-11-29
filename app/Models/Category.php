<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected function shortName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Str::limit($attributes['name'], 15, '...'),
        );
    }
}