<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'category',
        'product_image',
        'condition',
        'price',
    ];

    protected $casts = [
        'condition' => 'integer',
        'price' => 'integer',
    ];
}
