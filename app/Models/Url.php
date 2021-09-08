<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Url extends Model
{
    use HasFactory, Prunable;

    protected $fillable = [
        'url',
        'redirect_url',
        'lifetime',
        'transition'
    ];

    public function prunable()
    {
        return static::where('lifetime', '<=', Carbon::now()->addHours(3));
    }
}
