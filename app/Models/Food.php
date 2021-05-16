<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $casts = [
        'categories' => 'array',
        'meals' => 'array',
        'requirements' => 'array',
        'tags' => 'array',
        'images' => 'array',
    ];

    protected $guarded = [];

    public function categories()
    {
        return $this->hasmany(Category::class);
    }
}
