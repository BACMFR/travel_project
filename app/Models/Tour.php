<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'starting_date',
        'ending_date',
        'price',
    ];

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function setPriceAtrribute($value)
    {
        return $value * 100;
    }
}
